<?php

namespace Domain\User\Actions;

use Domain\User\Data\CreateUserData;
use Domain\User\Models\User;

final class CreateUser
{
    public function execute(CreateUserData $data): User
    {
        /** @var User $user */
        $user = User::query()->make([
            'name' => $data->name,
            'email' => $data->email,
            'password' => $data->password,
        ]);

        $user->save();

        return $user;
    }
}
