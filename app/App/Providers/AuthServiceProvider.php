<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Support\Vendor\Passport\PassportAuthCode;
use Support\Vendor\Passport\PassportClient;
use Support\Vendor\Passport\PassportPersonalAccessClient;
use Support\Vendor\Passport\PassportRefreshToken;
use Support\Vendor\Passport\PassportToken;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::useClientModel(PassportClient::class);
        Passport::useTokenModel(PassportToken::class);
        Passport::useRefreshTokenModel(PassportRefreshToken::class);
        Passport::useAuthCodeModel(PassportAuthCode::class);
        Passport::usePersonalAccessClientModel(PassportPersonalAccessClient::class);

        /** @phpstan-ignore-next-line */
        if ( ! $this->app->routesAreCached()) {
            Passport::routes();
        }
    }
}
