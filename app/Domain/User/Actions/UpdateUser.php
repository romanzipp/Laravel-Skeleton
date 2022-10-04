<?php

namespace Domain\User\Actions;

use Domain\User\Data\UserData;
use Domain\User\Models\User;

final class UpdateUser
{
    public function execute(User $user, UserData $data): User
    {
        $user = $data->toModel($user);
        $user->save();

        return $user;
    }
}
