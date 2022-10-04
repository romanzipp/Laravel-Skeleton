<?php

namespace Support\Enums;

use Support\Enums\Interfaces\ColoredEnum;
use Support\Enums\Traits\ColoredEnumTrait;

class ServiceEnum extends AbstractEnum implements ColoredEnum
{
    use ColoredEnumTrait;

    public const APPLE = 0;
    public const GOOGLE = 1;

    public static function findFromSocialiteServiceName(string $serviceName): ?self
    {
        foreach (self::values() as $service) {
            if ( ! $service->canBeUsedForLogin()) {
                continue;
            }

            if ($service->getSocialiteServiceName() === $serviceName) {
                return $service;
            }
        }

        return null;
    }

    public function getTitle(): string
    {
        return match ($this->getValue()) {
            self::APPLE => 'Apple',
            self::GOOGLE => 'Google',
        };
    }

    public function getSocialiteServiceName(): string
    {
        return match ($this->getValue()) {
            self::APPLE => 'apple',
            self::GOOGLE => 'google',
        };
    }

    public function canBeUsedForLogin(): bool
    {
        return match ($this->getValue()) {
            self::APPLE => true,
            self::GOOGLE => true,
            default => false
        };
    }

    public function getHslaColorTemplate(): array
    {
        return match ($this->getValue()) {
            self::APPLE => [0, 0, 0, 1],
            self::GOOGLE => [360, 100, 50, 1],
        };
    }

    public function getOAuthRedirectUrl(): ?string
    {
        if ( ! $this->canBeUsedForLogin()) {
            return null;
        }

        return route('auth.connect.redirect', $this->getSocialiteServiceName());
    }

    public function getUserUrlPattern(): ?string
    {
        // Placeholders: {id}, {name}
        return match ($this->getValue()) {
            self::APPLE => null,
            self::GOOGLE => null,
            default => null
        };
    }

    public function getIconName(): string
    {
        return match ($this->getValue()) {
            self::APPLE => 'apple',
            self::GOOGLE => 'google',
        };
    }
}
