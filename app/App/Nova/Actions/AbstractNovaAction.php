<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

abstract class AbstractNovaAction extends Action
{
    use InteractsWithQueue;
    use Queueable;

    abstract public function handle(ActionFields $fields, Collection $models);
}
