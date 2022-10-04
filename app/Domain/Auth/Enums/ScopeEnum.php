<?php

namespace Domain\Auth\Enums;

use Support\Enums\AbstractEnum;

class ScopeEnum extends AbstractEnum
{
    public const USER_READ_MAIL = 'user:read:mail';

    public static function forPassport(): array
    {
        return array_combine(
            array_values(self::toArray()),
            array_map(fn (self $scope) => $scope->getDescription(), self::values())
        );
    }

    public function getDescription(): ?string
    {
        return match ($this->getValue()) {
            self::USER_READ_MAIL => 'Read user mail',
        };
    }
}
