<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Support\Vendor\Passport as PassportModels;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::useClientModel(PassportModels\PassportClient::class);
        Passport::useTokenModel(PassportModels\PassportToken::class);
        Passport::useRefreshTokenModel(PassportModels\PassportRefreshToken::class);
        Passport::useAuthCodeModel(PassportModels\PassportAuthCode::class);
        Passport::usePersonalAccessClientModel(PassportModels\PassportPersonalAccessClient::class);

        /** @phpstan-ignore-next-line */
        if ( ! $this->app->routesAreCached()) {
            Passport::routes();
        }
    }
}
