<?php

namespace App\Providers;

use Domain\Auth\Enums\ScopeEnum;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Support\Vendor\Passport as PassportModels;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [];

    public function boot()
    {
        $this->registerPolicies();

        Passport::useClientModel(PassportModels\PassportClient::class);
        Passport::useTokenModel(PassportModels\PassportToken::class);
        Passport::useRefreshTokenModel(PassportModels\PassportRefreshToken::class);
        Passport::useAuthCodeModel(PassportModels\PassportAuthCode::class);
        Passport::usePersonalAccessClientModel(PassportModels\PassportPersonalAccessClient::class);
        Passport::tokensCan(
            ScopeEnum::forPassport()
        );

        Passport::loadKeysFrom(storage_path('passport'));

        /** @phpstan-ignore-next-line */
        if ( ! $this->app->routesAreCached()) {
            Passport::routes();
        }
    }
}
