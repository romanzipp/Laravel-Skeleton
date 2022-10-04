<?php

namespace App\Providers;

use App\Nova\Dashboards\Main;
use Domain\User\Actions\CreateUser;
use Domain\User\Data\UserData;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Nova\Actions\ActionResource;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Laravel\Nova\Resource;
use ReflectionClass;
use Symfony\Component\Finder\Finder;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    public function boot()
    {
        parent::boot();

        Nova::style('nova', asset('nova.css'));

        Nova::sortResourcesBy(function (string $resource) {
            return $resource::$sidebarOrder ?? $resource::label();
        });

        Nova::createUserUsing(function ($command) {
            return [
                $command->ask('Name'),
                $command->ask('Email Address'),
                $command->secret('Password'),
            ];
        }, function ($name, $email, $password) {
            app(CreateUser::class)->execute(new UserData([
                'displayName' => $name,
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
            ]));
        });
    }

    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    protected function dashboards(): array
    {
        return [
            new Main(),
        ];
    }

    protected function resources()
    {
        self::resourcesInDomain('User');
        self::resourcesInDomain('Blog');
    }

    private static function resourcesInDomain(string $domain)
    {
        $resources = [];

        foreach ((new Finder())->in(domain_path($domain, 'Nova/Resources'))->files() as $resource) {
            $resource = str_replace(
                    ['/', '.php'],
                    ['\\', ''],
                    Str::after($resource->getPathname(), base_path('app') . DIRECTORY_SEPARATOR)
                );

            if (is_subclass_of($resource, Resource::class) &&
                ! (new ReflectionClass($resource))->isAbstract() &&
                ! (is_subclass_of($resource, ActionResource::class))) {
                $resources[] = $resource;
            }
        }

        Nova::resources(
            collect($resources)->sort()->all()
        );
    }
}
