<?php

namespace Domain\Blog\Nova\Resources;

use App\Nova\Resources\AbstractNovaResource;
use Domain\Blog\Enums\Language;
use Domain\Blog\Models\LocalizedPostContent;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class NovaLocalizedPostContent extends AbstractNovaResource
{
    public static string $model = LocalizedPostContent::class;

    public static $group = 'Blog';

    public static $title = 'name';

    public static $search = [
        'id',
    ];

    public static $displayInNavigation = false;

    /**
     * @var \Domain\Blog\Models\LocalizedPostContent
     */
    public $resource;

    public function fields(Request $request): array
    {
        return [
            ID::make()->sortable(),

            Select::make('language')
                ->options(
                    array_combine(
                        array_map(fn (Language $language) => $language->getValue(), Language::values()),
                        array_map(fn (Language $language) => $language->getTitle(), Language::values())
                    )
                )
                ->displayUsingLabels()
                ->rules(['required']),

            Text::make('title')->rules(['required']),
            Markdown::make('content')->rules(['required']),

            BelongsTo::make('Post', 'post', NovaPost::class),
        ];
    }
}
