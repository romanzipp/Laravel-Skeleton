<?php

namespace Domain\User\Actions;

use Carbon\Carbon;
use Domain\User\Data\UserData;
use Domain\User\Models\User;
use Spatie\MediaLibrary\MediaCollections\Exceptions\UnreachableUrl;

final class CreateUser
{
    public function execute(UserData $data): User
    {
        $data->termsAcceptedAt = Carbon::now();

        $user = $data->toModel();
        $user->save();

        try {
            $user
                ->addMediaFromUrl(sprintf('https://www.gravatar.com/avatar/%s.jpg?d=404&s=200', md5(strtolower(trim($data->email)))))
                ->toMediaCollection('avatar');
        } catch (UnreachableUrl $exception) {
            report($exception);
        }

        $user->save();

        return $user;
    }
}
