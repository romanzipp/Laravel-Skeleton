<?php

namespace Domain\Blog\Repositories;

use Carbon\Carbon;
use Support\Repositories\AbstractRepository;

class PostRepository extends AbstractRepository
{
    public static function getCommonRelations(): array
    {
        return [
            'localizedContents',
            'media',
        ];
    }

    public function getModelClass(): string
    {
        return \Domain\Blog\Models\PostModel::class;
    }

    public function getResourceClass(): string
    {
        return \Domain\Blog\Http\Resources\PostResource::class;
    }

    public function published(): self
    {
        $this
            ->query
            ->whereHas('localizedContents')
            ->where('published_at', '<=', Carbon::now());

        return $this;
    }
}
