<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Support\View\Components\Form\Field;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Blade::component('form-field', Field::class);
    }
}
