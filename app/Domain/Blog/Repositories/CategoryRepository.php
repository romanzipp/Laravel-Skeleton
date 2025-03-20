<?php

namespace Domain\Blog\Repositories;

use Support\Repositories\AbstractRepository;

class CategoryRepository extends AbstractRepository
{
    public function getModelClass(): string
    {
        return \Domain\Blog\Models\CategoryModel::class;
    }

    public function getResourceClass(): string
    {
        return \Domain\Blog\Http\Resources\CategoryResource::class;
    }
}
