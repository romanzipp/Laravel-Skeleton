<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use romanzipp\Seo\Helpers\Hook;
use romanzipp\Seo\Structs;

class SeoServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Structs\Title::hook(
            Hook::make()
                ->onBody()
                ->callback(function ($body) {
                    return ($body ? $body . ' | ' : '') . config('app.name');
                })
        );

        seo()->charset();
        seo()->viewport();

        seo()->title('Home');
        seo()->description('My Description');

        seo()->addMany([
            Structs\Meta::make()->name('copyright')->content('Laravel'),

            Structs\Meta::make()->name('mobile-web-app-capable')->content('yes'),
            Structs\Meta::make()->name('theme-color')->content('#f03a17'),

            Structs\Link::make()->rel('icon')->href('/assets/images/Logo.png'),

            Structs\Meta\OpenGraph::make()->property('site_name')->content(config('app.name')),
            Structs\Meta\OpenGraph::make()->property('locale')->content(config('app.locale')),
        ]);
    }
}
