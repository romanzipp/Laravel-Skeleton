<?php

namespace Domain\User\Actions;

use Domain\User\Data\UpdateUserData;
use Domain\User\Models\User;

final class UpdateUser
{
    public function execute(User $user, UpdateUserData $data): User
    {
        if ($data->name !== null) {
            $user->name = $data->name;
        }

        if ($data->password !== null) {
            $user->password = $data->password;
        }

        $user->save();

        return $user;
    }
}
