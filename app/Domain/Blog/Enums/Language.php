<?php

namespace Domain\Blog\Enums;

use Support\Enums\AbstractEnum;

class Language extends AbstractEnum
{
    public const EN = 'en';
    public const DE = 'de';

    public function getTitle(): string
    {
        return [
            self::DE => '🇩🇪 German',
            self::EN => '🇺🇸 English',
        ][$this->value] ?? '?';
    }
}
