<?php

namespace Support\Enums;

use MyCLabs\Enum\Enum;

abstract class AbstractEnum extends Enum
{
    public function getTitle(): string
    {
        return $this->getValue();
    }
}
