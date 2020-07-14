<?php

namespace Support\Data\AbstractData;

use ReflectionProperty;
use Spatie\DataTransferObject\PropertyFieldValidator;

final class CustomFieldValidator extends PropertyFieldValidator
{
    public bool $isRequired;

    public function __construct(ReflectionProperty $property)
    {
        parent::__construct($property);

        $this->isRequired = $this->resolveIsRequired($property);
    }

    private function resolveIsRequired(ReflectionProperty $property): bool
    {
        if ( ! $comment = $property->getDocComment()) {
            return false;
        }

        return preg_match('/@required/', $comment);
    }
}
