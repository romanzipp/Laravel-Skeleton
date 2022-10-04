<?php

namespace Support\Enums;

use Support\Enums\Interfaces\ColoredEnum;
use Support\Enums\Traits\ColoredEnumTrait;

class ServiceEnum extends AbstractEnum implements ColoredEnum
{
    use ColoredEnumTrait;

    public const APPLE = 0;
    public const GOOGLE = 1;
    public const TWITTER = 2;

    public function getTitle(): string
    {
        return match ($this->getValue()) {
            self::APPLE => 'Apple',
            self::GOOGLE => 'Google',
            self::TWITTER => 'Twitter',
        };
    }

    public function getSocialiteServiceName(): string
    {
        return match ($this->getValue()) {
            self::APPLE => 'apple',
            self::GOOGLE => 'google',
            self::TWITTER => 'google',
        };
    }

    public function canBeUsedForLogin(): bool
    {
        return match ($this->getValue()) {
            self::APPLE => true,
            self::GOOGLE => true,
            self::TWITTER => true,
            default => false
        };
    }

    public function getHslaColorTemplate(): array
    {
        return match ($this->getValue()) {
            self::APPLE => [0, 0, 0, 1],
            self::GOOGLE => [5, 81, 56, 1],
            self::TWITTER => [203, 89, 53, 1],
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
            self::TWITTER => 'https://twitter.com/{name}',
            default => null
        };
    }

    public function getIconName(): string
    {
        return match ($this->getValue()) {
            self::APPLE => 'apple',
            self::GOOGLE => 'google',
            default => strtolower($this->getTitle())
        };
    }

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
}
