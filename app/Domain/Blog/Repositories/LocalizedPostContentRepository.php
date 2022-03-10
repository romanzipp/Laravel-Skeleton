<?php

namespace Domain\Blog\Repositories;

use Support\Repositories\AbstractRepository;

class LocalizedPostContentRepository extends AbstractRepository
{
    public function getModelClass(): string
    {
        return \Domain\Blog\Models\LocalizedPostContent::class;
    }

    public function getResourceClass(): string
    {
        return \Domain\Blog\Http\Resources\LocalizedPostContentResource::class;
    }
}
