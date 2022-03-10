<?php

namespace Domain\Blog\Nova\Resources;

use App\Nova\Resources\AbstractNovaResource;
use Domain\Blog\Models\Category;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;

class NovaCategory extends AbstractNovaResource
{
    public static string $model = Category::class;

    public static $group = 'Blog';

    public static $title = 'title';

    public static $search = [
        'id',
    ];

    /**
     * @var \Domain\Blog\Models\Category
     */
    public $resource;

    public function fields(Request $request): array
    {
        $table = self::getTableName();

        return [
            ID::make()->sortable(),

            Slug::make('Slug')
                ->rules(['required'])
                ->updateRules("unique:$table,slug,{{resourceId}}"),

            Text::make('title')
                ->rules(['required']),
        ];
    }
}
