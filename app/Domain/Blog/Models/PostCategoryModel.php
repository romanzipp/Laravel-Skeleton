<?php

namespace Domain\Blog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Support\Enums\TableName;
use Support\Models\AbstractPivotModel;

/**
 * @property string $post_id
 * @property string $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Domain\Blog\Models\PostModel|null $post
 * @property int|null $posts_count
 * @property \Domain\Blog\Models\CategoryModel|null $category
 * @property int|null $categories_count
 */
class PostCategory extends AbstractPivotModel
{
    use HasFactory;

    protected $table = TableName::BLOG_POST_CATEGORIES;

    /*
     *--------------------------------------------------------------------------
     * Relations
     *--------------------------------------------------------------------------
     */

    public function post(): BelongsTo
    {
        return $this->belongsTo(PostModel::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryModel::class);
    }

    /*
     *--------------------------------------------------------------------------
     * Methods
     *--------------------------------------------------------------------------
     */

    protected static function newFactory()
    {
        return new \Database\Factories\Blog\PostCategoryFactory();
    }
}
