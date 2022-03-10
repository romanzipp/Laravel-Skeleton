<?php

namespace Support\Listeners;

use Illuminate\Events\Dispatcher;
use Illuminate\Support\Arr;

abstract class AbstractListener
{
    final protected function listen(Dispatcher $dispatcher, string $event): void
    {
        $dispatcher->listen(
            $event,
            [static::class, "on{$this->getClassFromNamespace($event)}"]
        );
    }

    protected function getClassFromNamespace(string $namespace): string
    {
        return Arr::last(explode('\\', $namespace));
    }

    abstract public function subscribe(Dispatcher $dispatcher): void;
}
