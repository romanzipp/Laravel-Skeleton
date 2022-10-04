<?php

namespace App\Nova\Fields;

use Laravel\Nova\Fields\Select;
use Support\Enums\AbstractEnum;
use Support\Rules\EnumValue;

final class NovaEnumSelect extends Select
{
    public function __construct($name, $attribute, string $enumClass)
    {
        parent::__construct($name, $attribute);

        $this->options(function () use ($enumClass) {
            /** @var \Support\Enums\AbstractEnum $enumClass */
            return array_combine(
                $enumClass::toArray(),
                array_map(fn (AbstractEnum $enum) => $enum->getTitle(), $enumClass::values())
            );
        });

        $this->displayUsing(function (AbstractEnum $value) {
            return $value->getTitle();
        });

        $this->rules([
            new EnumValue($enumClass),
        ]);
    }
}
