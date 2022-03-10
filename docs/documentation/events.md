# Events

Event Listeners must always extend the [AbstractListener](../../app/Support/Listeners/AbstractListener.php)

```php
<?php

namespace Domain\Example\Listeners;

use Domain\Example\Events\SomethingHappenedEvent;
use Illuminate\Events\Dispatcher;
use Support\Listeners\AbstractListener;

class ExampleListener extends AbstractListener
{
    public function subscribe(Dispatcher $dispatcher): void
    {
        $this->listen($dispatcher, SomethingHappenedEvent::class);
    }

    public function onSomethingHappenedEvent(EventFollowedEvent $event)
    {
        // Handle event
    }
}

```
