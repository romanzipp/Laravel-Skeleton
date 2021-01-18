<?php

namespace Domain\User\Http\Resources;

use Support\Http\Resources\AbstractResource;

final class UserResource extends AbstractResource
{
    public function toArray($request): array
    {
        /** @var \Domain\User\Models\User $user */
        $user = $this->resource;

        return [
            'name' => $user->name,

            $this->withDates(),
        ];
    }
}
