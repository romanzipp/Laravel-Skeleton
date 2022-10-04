<?php

namespace Domain\Auth\Http\Concerns;

use Support\Enums\ServiceEnum;

trait ProvidesOAuthServices
{
    /**
     * @return \Support\Enums\ServiceEnum[]
     */
    protected static function getOAuthServices(): array
    {
        return array_filter(ServiceEnum::values(), fn (ServiceEnum $service) => $service->canBeUsedForLogin());
    }
}
