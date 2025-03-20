<?php

namespace Domain\Blog\Repositories;

use Support\Repositories\AbstractRepository;

class PostCategoryRepository extends AbstractRepository
{
    public function getModelClass(): string
    {
        return \Domain\Blog\Models\PostCategoryModel::class;
    }

    public function getResourceClass(): string
    {
        return \Domain\Blog\Http\Resources\PostCategoryResource::class;
    }
}
