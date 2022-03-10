<?php

namespace Database\Seeders;

use Domain\User\Actions\CreateUser;
use Domain\User\Data\CreateUserData;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DevelopmentSeeder extends Seeder
{
    public function run(): void
    {
        $user = app(CreateUser::class)->execute(new CreateUserData([
            'name' => 'Roman',
            'email' => 'ich@ich.wtf',
            'password' => Hash::make('password'),
        ]));

        $user
            ->addMedia(database_path('seeders/files/avatar.jpg'))
            ->preservingOriginal()
            ->toMediaCollection('avatar');
    }
}
