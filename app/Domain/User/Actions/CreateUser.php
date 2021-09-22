<?php

namespace Domain\User\Actions;

use Carbon\Carbon;
use Domain\User\Data\CreateUserData;
use Domain\User\Models\User;

final class CreateUser
{
    public function execute(CreateUserData $data): User
    {
        $user = new User([
            'name' => $data->name,
            'display_name' => $data->name,
            'email' => $data->email,
            'password' => $data->password,
            'terms_accepted_at' => Carbon::now(),
        ]);

        $user->save();

        return $user;
    }
}
