<?php

namespace Domain\Blog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Support\Enums\TableName;
use Support\Models\AbstractModel;

/**
 * @property string $id
 * @property string $title
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection|\Domain\Blog\Models\Post[] $posts
 * @property int|null $posts_count
 */
class Category extends AbstractModel
{
    use HasFactory;

    protected $table = TableName::BLOG_CATEGORIES;

    protected static function newFactory()
    {
        return new \Database\Factories\Blog\CategoryFactory();
    }

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, PostCategory::class);
    }
}
