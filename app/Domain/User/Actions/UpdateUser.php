<?php

namespace Domain\User\Actions;

use Domain\User\Data\UpdateUserData;
use Domain\User\Models\User;

final class UpdateUser
{
    public function execute(User $user, UpdateUserData $data): User
    {
        if (isset($data->name)) {
            $user->name = $data->name;
        }

        if (isset($data->password)) {
            $user->password = $data->password;
        }

        $user->save();

        return $user;
    }
}
