<?php

namespace Domain\User\Http\Resources;

use Support\Http\Resources\AbstractResource;
use Support\Http\Resources\MediaResource;
use Support\Http\Resources\ServiceEnumResource;

final class AccountResource extends AbstractResource
{
    public function toArray($request): array
    {
        /** @var \Domain\User\Models\AccountModel $account */
        $account = $this->resource;

        return [
            'id' => $account->id,

            'service' => new ServiceEnumResource($account->getService()),

            'service_user_id' => $account->service_user_id,
            'service_user_name' => $account->service_user_name,

            'scopes' => $account->scopes,

            'user' => new UserResource(
                $this->whenLoaded('user')
            ),

            'avatar' => $this->whenLoaded(
                'media',
                fn () => new MediaResource($account->getFirstMedia('avatar'), 'crop')
            ),

            $this->withDates(),
        ];
    }
}
