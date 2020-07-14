<?php

namespace Support\Listeners;

use Illuminate\Events\Dispatcher;
use Illuminate\Support\Arr;

abstract class AbstractListener
{
    protected array $subscribe = [];

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

    public function subscribe(Dispatcher $dispatcher): void
    {
        foreach ($this->subscribe as $event => $callback) {

            if (is_array($callback)) {

                if (count($callback) === 1) {
                    $callback = [static::class, $callback[0]];
                }

                $callback = implode('@', $callback);
            }

            $dispatcher->listen($event, $callback);
        }
    }
}
