<?php

namespace Domain\User\Actions;

use Domain\User\Data\UserData;
use Domain\User\Models\UserModel;

final class UpdateUser
{
    public function execute(UserModel $user, UserData $data): UserModel
    {
        $user = $data->toModel($user);
        $user->save();

        return $user;
    }
}
