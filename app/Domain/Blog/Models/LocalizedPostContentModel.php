<?php

namespace Domain\Blog\Models;

use Domain\Blog\Enums\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\MarkdownConverter;
use Support\Enums\TableName;
use Support\Models\AbstractModel;
use Support\Vendor\CommonMark\ImageExtension;

/**
 * @property string $id
 * @property string $language
 * @property string $title
 * @property string $intro
 * @property string $content
 * @property string $post_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Domain\Blog\Models\PostModel|null $post
 * @property int|null $posts_count
 */
final class LocalizedPostContentModel extends AbstractModel
{
    use HasFactory;

    protected $table = TableName::BLOG_POST_LOCALIZED_CONTENTS;

    /*
     *--------------------------------------------------------------------------
     * Relations
     *--------------------------------------------------------------------------
     */

    public function post(): BelongsTo
    {
        return $this->belongsTo(PostModel::class);
    }

    public function getParsedContent(): string
    {
        $environment = new Environment([]);
        $environment
            ->addExtension(new CommonMarkCoreExtension())
            ->addExtension(new ImageExtension());

        $converter = new MarkdownConverter($environment);

        return $converter->convert($this->content);
    }

    /*
     *--------------------------------------------------------------------------
     * Methods
     *--------------------------------------------------------------------------
     */

    protected static function newFactory()
    {
        return new \Database\Factories\Blog\LocalizedPostContentFactory();
    }

    public function getLanguage(): Language
    {
        return Language::from($this->language);
    }
}
