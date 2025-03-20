<?php

namespace Support\Rules;

use Illuminate\Contracts\Validation\Rule;

class EnumValue implements Rule
{
    /**
     * @phpstan-ignore-next-line
     *
     * @var \Support\Enums\AbstractEnum
     */
    private string $enum;

    private bool $strict;

    public function __construct(string $enum, bool $strict = false)
    {
        if ( ! class_exists($enum)) {
            throw new \InvalidArgumentException('Invalid enum');
        }

        $this->strict = $strict;
        $this->enum = $enum;
    }

    public function passes($attribute, $value): bool
    {
        if ($this->strict) {
            return $this->enum::isValid($value);
        }

        return in_array($value, $this->enum::toArray(), false);
    }

    public function message(): string
    {
        return 'Invalid :attribute enum';
    }
}
