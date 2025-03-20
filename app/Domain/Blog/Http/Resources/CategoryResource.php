<?php

namespace Domain\Blog\Http\Resources;

use Support\Http\Resources\AbstractResource;

final class CategoryResource extends AbstractResource
{
    public function toArray($request): array
    {
        /** @var \Domain\Blog\Models\CategoryModel $category */
        $category = $this->resource;

        return [
            'id' => $category->id,

            $this->withDates(),
        ];
    }
}
