<?php

namespace Domain\User\Actions;

use Carbon\Carbon;
use Domain\User\Data\CreateUserData;
use Domain\User\Models\User;
use Spatie\MediaLibrary\MediaCollections\Exceptions\UnreachableUrl;

final class CreateUser
{
    public function execute(CreateUserData $data): User
    {
        $user = new User([
            'name' => $data->name,
            'display_name' => $data->isset('displayName') ? $data->displayName : $data->name,
            'email' => $data->email,
            'password' => $data->password,
            'terms_accepted_at' => Carbon::now(),
        ]);

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
