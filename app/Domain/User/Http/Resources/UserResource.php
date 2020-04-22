<?php

namespace Domain\User\Http\Resources;

use Support\Http\Resources\AbstractResource;

final class UserResource extends AbstractResource
{
    public function toArray($request)
    {
        /** @var \Domain\User\Models\User $resource */
        $resource = $this->resource;

        return [

            'name' => $resource->name,

            $this->withDates(),
        ];
    }
}
