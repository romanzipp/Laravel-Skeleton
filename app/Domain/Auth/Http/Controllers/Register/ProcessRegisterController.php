<?php

namespace Domain\Auth\Http\Controllers\Register;

use Domain\User\Actions\CreateUser;
use Domain\User\Data\UserData;
use Domain\User\Models\User;
use Domain\User\Notifications\VerifyEmail;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Validation\Rules\Unique;
use romanzipp\PreviouslyDeleted\Rules\NotPreviouslyDeleted;
use romanzipp\Turnstile\Rules\TurnstileCaptcha;
use Support\Http\Controllers\AbstractController;
use Throwable;

final class ProcessRegisterController extends AbstractController
{
    use RegistersUsers;

    private CreateUser $createUser;

    public function __construct(CreateUser $createUser)
    {
        $this->createUser = $createUser;
    }

    public function __invoke(Request $request)
    {
        return $this->register($request);
    }

    protected function create(array $data): User
    {
        return $this->createUser->execute(
            new UserData([
                'displayName' => $data['name'],
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ])
        );
    }

    protected function registered(Request $request, $user)
    {
        try {
            $user->notify(new VerifyEmail());
        } catch (Throwable $e) {
            report($e);
        }
    }

    protected function validator(array $data): Validator
    {
        return ValidatorFacade::make($data, [
            'name' => [
                'required',
                ...self::getNameRules(),
            ],
            'email' => [
                'required',
                ...self::getEmailRules(),
            ],
            'password' => [
                'required',
                ...self::getPasswordRules(),
            ],
            'terms' => [
                'required',
                'accepted',
            ],
            'cf-turnstile-response' => [
                'required',
                'string',
                new TurnstileCaptcha(),
            ],
        ]);
    }

    public static function getNameRules(): array
    {
        return [
            'string',
            'min:3',
            'max:32',
            'regex:/^([A-z0-9-_\.]+)$/',
            new Unique(User::class, 'name'),
            new NotPreviouslyDeleted(User::class, 'name'),
        ];
    }

    public static function getEmailRules(): array
    {
        return [
            'string',
            'email',
            'max:255',
            new Unique(User::class, 'email'),
            new NotPreviouslyDeleted(User::class, 'email'),
        ];
    }

    public static function getPasswordRules(): array
    {
        return [
            'string',
            'min:8',
            'confirmed',
        ];
    }
}
