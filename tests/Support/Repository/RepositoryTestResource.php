<?php

namespace Tests\Support\Repository;

use Support\Http\Resources\AbstractResource;

class RepositoryTestResource extends AbstractResource
{
    /**
     * @var \Tests\Support\Repository\RepositoryTestModel
     */
    public $resource;

    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
        ];
    }
}
