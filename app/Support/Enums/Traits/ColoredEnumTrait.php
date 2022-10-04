<?php

namespace Support\Enums\Traits;

trait ColoredEnumTrait
{
    /**
     * @return array
     */
    abstract public static function toArray();

    public static function getColorMap(): array
    {
        return array_combine(
            array_map('strtolower', array_values(self::toArray())),
            array_map(fn (self $enum) => $enum->getHslaColor(), self::values())
        );
    }

    public function getHslaColor(float $saturationOffset = 0, float $brightnessOffset = 0, float $alphaOffset = 0): string
    {
        [$hue, $saturation, $brightness, $alpha] = $this->getHslaColorTemplate();

        return sprintf(
            'hsla(%ddeg, %d%%, %d%%, %f)',
            $hue,
            $saturation + ($saturation * $saturationOffset),
            $brightness + ($brightness * $brightnessOffset),
            $alpha + ($alpha * $alphaOffset)
        );
    }
}
