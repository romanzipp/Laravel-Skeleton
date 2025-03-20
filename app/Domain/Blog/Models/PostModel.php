<?php

namespace Domain\Blog\Models;

use Carbon\Carbon;
use Domain\User\Models\UserModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Support\Enums\TableName;
use Support\Models\AbstractModel;

/**
 * @property string $id
 * @property string $slug
 * @property array|null $tags
 * @property string|null $author_id
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Domain\User\Models\UserModel|null $author
 * @property int|null $authors_count
 * @property \Illuminate\Database\Eloquent\Collection|\Domain\Blog\Models\CategoryModel[] $categories
 * @property int|null $categories_count
 * @property \Illuminate\Database\Eloquent\Collection|\Domain\Blog\Models\LocalizedPostContentModel[] $localizedContents
 * @property int|null $localized_contents_count
 * @property \Illuminate\Database\Eloquent\Collection|\Support\Vendor\MediaLibrary\Media[] $media
 * @property int|null $media_count
 */
final class PostModel extends AbstractModel implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = TableName::BLOG_POSTS;

    protected $casts = [
        'published_at' => 'datetime',
        'tags' => 'array',
    ];

    /*
     *--------------------------------------------------------------------------
     * Relations
     *--------------------------------------------------------------------------
     */

    public function author(): BelongsTo
    {
        return $this->belongsTo(UserModel::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(CategoryModel::class, PostCategoryModel::class);
    }

    public function localizedContents(): HasMany
    {
        return $this->hasMany(LocalizedPostContentModel::class);
    }

    /*
     *--------------------------------------------------------------------------
     * Methods
     *--------------------------------------------------------------------------
     */

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('thumbnail')
            ->singleFile()
            ->useDisk('blog');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('thumb')
            ->withResponsiveImages();
    }

    public function getLanguages(): array
    {
        return array_map(fn (LocalizedPostContentModel $content) => $content->language, [...$this->localizedContents]);
    }

    public function getContent(?string $lang = null): ?LocalizedPostContentModel
    {
        foreach ($this->localizedContents as $localizedContent) {
            if ($localizedContent->language === $lang) {
                return $localizedContent;
            }
        }

        return $this->localizedContents->first();
    }

    public function getThumbnail(): ?Media
    {
        return $this->getFirstMedia('thumbnail');
    }

    public function isPublished(): bool
    {
        if ($this->published_at->isAfter(Carbon::now())) {
            return false;
        }

        return $this->localizedContents->count() > 0;
    }

    protected static function newFactory()
    {
        return new \Database\Factories\Blog\PostFactory();
    }
}
