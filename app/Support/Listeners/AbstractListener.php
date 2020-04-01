<?php

namespace Support\Listeners;

use Illuminate\Events\Dispatcher;
use Illuminate\Support\Arr;

abstract class AbstractListener
{
    public function listen(Dispatcher $dispatcher, string $event): void
    {
        $dispatcher->listen(
            $event,
            sprintf('%s@on%s', static::class, $this->getClassFromNamespace($event))
        );
    }

    protected function getClassFromNamespace(string $namespace): string
    {
        return Arr::last(explode('\\', $namespace));
    }
}
