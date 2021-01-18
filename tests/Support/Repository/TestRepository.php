<?php

namespace Tests\Support\Repository;

use Support\Repositories\AbstractRepository;

class TestRepository extends AbstractRepository
{
    public function getModelClass(): string
    {
        return RepositoryTestModel::class;
    }

    public function getResourceClass(): string
    {
        return RepositoryTestResource::class;
    }
}
