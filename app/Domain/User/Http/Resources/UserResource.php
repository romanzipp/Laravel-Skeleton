<?php

namespace Domain\User\Http\Resources;

use Support\Http\Resources\AbstractResource;
use Support\Http\Resources\MediaResource;

final class UserResource extends AbstractResource
{
    public function toArray($request): array
    {
        /** @var \Domain\User\Models\UserModel $user */
        $user = $this->resource;

        return [
            'name' => $user->name,

            'avatar' => $this->whenLoaded(
                'media',
                fn () => new MediaResource($user->getFirstMedia('avatar'), 'crop')
            ),

            'accounts' => AccountResource::collection(
                $this->whenLoaded('accounts')
            ),

            $this->withDates(),
        ];
    }
}
