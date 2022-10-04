<?php

namespace App\Nova\Fields;

use Laravel\Nova\Fields\Text;
use Support\Models\AbstractModel;

class NovaColoredEnumField extends Text
{
    public function __construct($name, $attribute, string $enumClass)
    {
        parent::__construct($name, $attribute);

        $this
            ->displayUsing(function (mixed $value, AbstractModel $model) use ($enumClass) {
                /** @var \Support\Enums\Interfaces\ColoredEnum $enum */
                $enum = new $enumClass($value);

                return sprintf(
                    '<div class="enum-label" style="background-color: %s; color: %s;">%s</div>',
                    $enum->getHslaColor(0, .1, -.8),
                    $enum->getHslaColor(0, -.2),
                    $enum->getTitle()
                );
            })
            ->asHtml();
    }
}
