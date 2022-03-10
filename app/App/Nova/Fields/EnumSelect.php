<?php

namespace App\Nova\Fields;

use Laravel\Nova\Fields\Select;
use Support\Enums\AbstractEnum;

final class EnumSelect extends Select
{
    private string $enumClass;

    public function __construct($name, $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->displayUsing(fn ($value) => (new $this->enumClass($value))->getTitle());
    }

    public function enum(string $class): self
    {
        $this->enumClass = $class;

        /** @var \Support\Enums\AbstractEnum $class */
        $this->options(
            array_combine(
                $class::toArray(),
                array_map(fn (AbstractEnum $enum) => $enum->getTitle(), $class::values())
            ),
        );

        return $this;
    }
}
