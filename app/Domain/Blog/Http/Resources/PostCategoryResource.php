<?php

namespace Domain\Blog\Http\Resources;

use Support\Http\Resources\AbstractResource;

final class PostCategoryResource extends AbstractResource
{
    public function toArray($request): array
    {
        /** @var \Domain\Blog\Models\PostCategoryModel $postCategory */
        $postCategory = $this->resource;

        return [
            $this->withDates(),
        ];
    }
}
