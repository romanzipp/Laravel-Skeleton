<?php

namespace Support\Enums\Interfaces;

interface ColoredEnum
{
    public function getTitle(): string;

    public function getHslaColorTemplate(): array;

    public function getHslaColor(float $saturationOffset = 0, float $brightnessOffset = 0, float $alphaOffset = 0): string;

    public static function getColorMap(): array;
}
