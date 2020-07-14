<?php

namespace Support\Data;

use ReflectionClass;
use ReflectionProperty;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\DataTransferObjectError;
use Spatie\DataTransferObject\DTOCache;
use Support\Data\AbstractData\CustomFieldValidator;

abstract class AbstractData extends DataTransferObject
{
    public function __construct(array $parameters = [])
    {
        $validators = $this->getFieldValidators();

        $valueCaster = $this->getValueCaster();

        foreach ($validators as $field => $validator) {

            if ( ! isset($parameters[$field]) && $validator->isRequired) {
                throw DataTransferObjectError::uninitialized(
                    static::class,
                    $field
                );
            }

            $value = $parameters[$field] ?? $this->{$field} ?? null;

            $value = $this->castValue($valueCaster, $validator, $value);

            if (isset($parameters[$field]) && ! $validator->isValidType($value)) {
                throw DataTransferObjectError::invalidType(
                    static::class,
                    $field,
                    $validator->allowedTypes,
                    $value
                );
            }

            if (isset($parameters[$field])) {
                $this->{$field} = $value;
            }

            unset($parameters[$field]);
        }

        if ( ! $this->ignoreMissing && count($parameters)) {
            throw DataTransferObjectError::unknownProperties(array_keys($parameters), static::class);
        }
    }

    /**
     * @return CustomFieldValidator[]
     */
    protected function getFieldValidators(): array
    {
        return DTOCache::resolve(static::class, function () {

            $class = new ReflectionClass(static::class);

            $properties = [];

            foreach ($class->getProperties(ReflectionProperty::IS_PUBLIC) as $reflectionProperty) {

                if ($reflectionProperty->isStatic()) {
                    continue;
                }

                $field = $reflectionProperty->getName();

                $properties[$field] = new CustomFieldValidator($reflectionProperty);
            }

            return $properties;
        });
    }
}
