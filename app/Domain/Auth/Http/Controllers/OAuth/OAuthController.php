<?php

namespace Domain\Auth\Http\Controllers\OAuth;

use Domain\Auth\Exceptions\OAuthException;
use Domain\User\Actions\CreateUser;
use Domain\User\Data\UserData;
use Domain\User\Models\Account;
use Domain\User\Models\User;
use Domain\User\Repositories\AccountRepository;
use Domain\User\Repositories\UserRepository;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\In;
use InvalidArgumentException;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Laravel\Socialite\Facades\Socialite;
use League\OAuth1\Client\Credentials\CredentialsException;
use Support\Enums\ServiceEnum;
use Throwable;

class OAuthController
{
    public const SESSION_KEY_ERROR = 'oauth_error';
    public const SESSION_KEY_INTENDED = 'oauth_return_to';
    public const SESSION_KEY_EXISTING = 'oauth_existing';

    public function redirect(Request $request, string $service)
    {
        $payload = $request->validate([
            'existing' => ['nullable'],
            'return_to' => ['nullable'],
        ]);

        if (isset($payload['existing'])) {
            $request->session()->put(self::SESSION_KEY_EXISTING, true);
        }

        if (isset($payload['return_to'])) {
            self::storeRedirectUrl($request, $payload['return_to']);
        }

        $serviceEnum = self::validateService($service);

        if (null === $serviceEnum) {
            return self::sendFailedResponse($request, __('auth.oauth_not_supported', ['service' => $service]));
        }

        try {
            /** @phpstan-ignore-next-line */
            $socialite = Socialite::driver($service)
                ->scopes(self::getScopes($service))
                ->redirect();
        } catch (CredentialsException $e) {
            return self::sendFailedResponse($request, __('auth.oauth_mismatch_config', ['service' => $serviceEnum->getTitle()]));
        } catch (Throwable $e) {
            return self::sendFailedResponse($request, $e->getMessage());
        }

        return redirect(
            $socialite->getTargetUrl()
        );
    }

    public function callback(Request $request, string $service): RedirectResponse
    {
        $serviceEnum = $this->validateService($service);
        if (null === $serviceEnum) {
            return self::sendFailedResponse($request, "The $service service is not supported");
        }

        // Redirect has errors in query params
        if ($request->filled('error') || $request->filled('error_description')) {
            return self::sendFailedResponse($request, $request->query('error_description') ?: $request->query('error'));
        }

        // All services except twitter
        if ('twitter' !== $service && ! $request->filled('code')) {
            return self::sendFailedResponse($request, 'Code not provided');
        }

        try {
            $user = $this->findOrCreateUser($request, $serviceEnum);
        } catch (OAuthException $e) {
            return self::sendFailedResponse($request, $e->getMessage());
        }

        if ( ! $user) {
            return self::sendFailedResponse($request, 'Could not create user');
        }

        $user->load(UserRepository::getCommonRelations());

        // Login the user
        self::guard()->login($user);

        // The user is connecting their current account to a new OAuth service
        // Redirect to the OAuth connect page
        if ($request->session()->pull(self::SESSION_KEY_EXISTING)) {
            return redirect()->route('auth.connect');
        }

        return self::getRedirectResponse($request);
    }

    /**
     * @throws \Domain\Auth\Exceptions\OAuthException
     */
    private function findOrCreateUser(Request $request, ServiceEnum $serviceEnum): ?User
    {
        try {
            /**
             * @var \Laravel\Socialite\Two\User $socialiteUser
             *
             * @phpstan-ignore-next-line
             */
            $socialiteUser = Socialite::driver($serviceEnum->getSocialiteServiceName())
                ->stateless()
                ->user();
        } catch (ClientException $e) {
            // Possible used or outdated code
            throw new OAuthException(__('auth.oauth_data_err', ['service' => $serviceEnum->getTitle()]));
        } catch (InvalidArgumentException $e) {
            // Service provider down
            report($e);
            throw new OAuthException(__('auth.oauth_data_invalid', ['service' => $serviceEnum->getTitle()]));
        } catch (Throwable $e) {
            report($e);
            throw new OAuthException(__('auth.oauth_data_unknown', ['service' => $serviceEnum->getTitle()]));
        }

        // Request the service email to be set
        if (empty($socialiteUser->getEmail())) {
            throw new OAuthException("No mail has been provided by {$serviceEnum->getTitle()}");
        }

        /** @var \Domain\User\Models\User|null $user */
        $user = $request->user();

        // A user is currently logged in
        if ($user) {
            // Get social account for current logged-in user  and active service
            $socialAccount = self::getAccountForUser($serviceEnum, $user);

            if (null === $socialAccount) {
                // Check if the social account with the same id is used
                // by another user than the current logged-in one

                if (null !== self::getForeignAccount($serviceEnum, $user, $socialiteUser)) {
                    throw new OAuthException(__('auth.oauth_already_used'));
                }

                // Create a new social account for current logged-in user
                $socialAccount = self::createSocialAccount($serviceEnum, $user, $socialiteUser, false);
            }

            $socialAccount->update([
                // 'name' => $socialiteUser->getNickname(),
                'display_name' => $socialiteUser->getName(),
            ]);

            return $user;
        }

        // If there is no currently logged-in user, try to fetch
        // the given social account and return the associated user

        $socialAccount = self::getExistingAccount($serviceEnum, $socialiteUser);

        if ($socialAccount && ($socialUser = $socialAccount->user)) {
            return $socialUser;
        }

        // If there is no previous social account created, check if the email
        // is already in use

        $user = UserRepository::make()->findByMail($socialiteUser->getEmail());

        if ($user) {
            /**
             * @var \Domain\User\Models\Account $socialAccount|null
             */
            $socialAccount = $user->accounts->first();

            // If there is a user with a corresponding email address check if there
            // is a mismatching social service or password used

            if ($socialAccount) {
                throw new OAuthException(__('auth.oauth_mail_in_use_acc', ['existing_service' => $socialAccount->getService()->getTitle(), 'new_service' => $serviceEnum->getTitle()]));
            }

            throw new OAuthException(__('auth.oauth_mail_in_use'));
        }

        $user = app(CreateUser::class)->execute(
            new UserData([
                'email' => $socialiteUser->getEmail(),
                'displayName' => $name = $socialiteUser->getNickname() ?: $socialiteUser->getName(),
                'name' => User::generateUniqueName($name),
            ])
        );

        self::createSocialAccount($serviceEnum, $user, $socialiteUser);

        event(new Registered($user));

        return $user;
    }

    private static function generateUsername(string $name): string
    {
        if (empty($name)) {
            $name = 'anonymous';
        }

        do {
            $i = isset($i) ? ++$i : 0;
            $findName = $name . (0 !== $i ? $i : '');
        } while (null !== AccountRepository::make()->findByName($findName));

        return $findName;
    }

    private static function createSocialAccount(ServiceEnum $serviceEnum, User $user, SocialiteUser $socialiteUser, bool $initial = true): Account
    {
        $name = self::generateUsername(
            Str::slug($displayName = $socialiteUser->getNickname() ?: $socialiteUser->getName())
        );

        /** @var \Domain\User\Models\Account|null $account */
        $account = $user
            ->accounts()
            ->save(
                new Account([
                    'service_user_id' => $socialiteUser->getId(),
                    'service_user_name' => $displayName,
                    'service' => $serviceEnum,
                    'access_token' => $socialiteUser->token, /** @phpstan-ignore-line */
                    'refresh_token' => $socialiteUser->refreshToken ?? null, /** @phpstan-ignore-line */
                    'name' => $name,
                    'display_name' => $displayName,
                ])
            );

        return $account;
    }

    private static function getExistingAccount(ServiceEnum $serviceEnum, SocialiteUser $socialiteUser): ?Account
    {
        /** @var \Domain\User\Models\Account|null $account */
        $account = Account::query()
            ->where('service', $serviceEnum)
            ->where('service_user_id', $socialiteUser->getId())
            ->first();

        return $account;
    }

    private static function getAccountForUser(ServiceEnum $serviceEnum, User $user): ?Account
    {
        /** @var \Domain\User\Models\Account|null $account */
        $account = Account::query()
            ->where('service', $serviceEnum)
            ->whereHas('users', fn (Builder $builder) => $builder->where(User::primaryColumn(), $user->id))
            ->whereNotNull('service_user_id')
            ->first();

        return $account;
    }

    private static function getForeignAccount(ServiceEnum $serviceEnum, User $user, SocialiteUser $socialiteUser): ?Account
    {
        /** @var \Domain\User\Models\Account|null $account */
        $account = Account::query()
            ->where('service', $serviceEnum)
            ->where('service_user_id', $socialiteUser->getId())
            ->whereDoesntHave('users', fn (Builder $builder) => $builder->where(User::primaryColumn(), $user->id))
            ->whereNotNull('service_user_id')
            ->first();

        return $account;
    }

    private static function validateService(string $service): ?ServiceEnum
    {
        $services = array_filter(ServiceEnum::values(), fn (ServiceEnum $enum) => $enum->canBeUsedForLogin());

        /** @var \Illuminate\Validation\Validator $validator */
        $validator = Validator::make([
            'service' => $service,
        ], [
            'service' => new In(
                array_map(fn (ServiceEnum $enum) => $enum->getSocialiteServiceName(), $services)
            ),
        ]);

        if ($validator->fails()) {
            return null;
        }

        return ServiceEnum::findFromSocialiteServiceName($validator->getData()['service']);
    }

    private static function getScopes(string $service): array
    {
        return config("services.$service.scopes") ?? [];
    }

    private static function sendFailedResponse(Request $request, string $message): RedirectResponse
    {
        /** @phpstan-ignore-next-line */
        $request->session()->flash(self::SESSION_KEY_ERROR, $message);

        return redirect()->route('auth.login.show', ['oauth_error' => $message]);
    }

    /**
     * Generates the appropiate redirect response for successfull authentication.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private static function getRedirectResponse(Request $request): RedirectResponse
    {
        $inteded = null;

        if ($request->session()->has(self::SESSION_KEY_INTENDED)) {
            $inteded = $request->session()->pull(self::SESSION_KEY_INTENDED);
        }

        return redirect()->intended($inteded);
    }

    private static function storeRedirectUrl(Request $request, string $intended): void
    {
        $allowedHosts = [
            config('app.url'),
            config('frontend.url'),
        ];

        $allowed = false;

        // Do not redirect to third party pages
        if ($host = parse_url($intended, PHP_URL_HOST)) {
            foreach ($allowedHosts as $allowedHost) {
                if (parse_url($allowedHost, PHP_URL_HOST) === $host) {
                    $allowed = true;
                    break;
                }
            }
        }

        if ( ! $allowed) {
            return;
        }

        $request->session()->put(self::SESSION_KEY_INTENDED, $intended);
    }

    private static function guard()
    {
        return Auth::guard('web');
    }
}
