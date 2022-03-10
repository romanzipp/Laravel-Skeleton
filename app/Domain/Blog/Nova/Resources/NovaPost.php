<?php

namespace Domain\Blog\Nova\Resources;

use App\Nova\Resources\AbstractNovaResource;
use Domain\Blog\Models\Post;
use Domain\User\Nova\Resources\NovaUser;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;

class NovaPost extends AbstractNovaResource
{
    public static string $model = Post::class;

    public static $group = 'Blog';

    public static $title = 'slug';

    public static $search = [
        'id',
    ];

    /**
     * @var \Domain\Blog\Models\Post
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

            Text::make('Title', static function (Post $post) {
                if ($content = $post->localizedContents->first()) {
                    return $content->title;
                }

                return $post->slug;
            }),

            Text::make('Tags')->hideFromIndex(),
            Text::make('Tags', fn (Post $post) => implode(', ', $post->tags))->onlyOnIndex(),

            DateTime::make('Published at'),
            DateTime::make('Created at'),

            Images::make('Thumbnail'),

            ...$this->contentFields(),

            HasMany::make('Localized Contents', 'localizedContents', NovaLocalizedPostContent::class),

            BelongsTo::make('Author', 'author', NovaUser::class),
            BelongsToMany::make('Categories', 'categories', NovaCategory::class),
        ];
    }

    public function contentFields(): array
    {
        $panels = [];

        foreach ($this->resource->localizedContents as $localizedContent) {
            $panels[] = new Panel('Content: ' . $localizedContent->getLanguage()->getTitle(), [
                Text::make('Title', fn () => $localizedContent->title)->hideFromIndex(),
                Text::make('Intro', fn () => $localizedContent->intro)->hideFromIndex(),
                Code::make('Content', fn () => $localizedContent->content)->readonly()->hideFromIndex(),
            ]);
        }

        return $panels;
    }
}
