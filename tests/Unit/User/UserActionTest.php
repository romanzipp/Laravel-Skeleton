<?php

namespace Tests\Unit\User;

use Domain\User\Actions\CreateUser;
use Domain\User\Actions\UpdateUser;
use Domain\User\Data\UpdateUserData;
use Domain\User\Data\UserData;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserActionTest extends TestCase
{
    use DatabaseMigrations;

    public function testCreate()
    {
        app(CreateUser::class)->execute(
            new UserData([
                'displayName' => 'foo',
                'name' => 'foo',
                'email' => self::faker()->email,
                'password' => self::faker()->password(8),
            ])
        );

        self::assertEquals('foo', User::query()->first()->name);
    }

    public function testUpdate()
    {
        /** @var User $user */
        $user = User::factory()->create([
            'name' => 'foo',
        ]);

        self::assertEquals('foo', User::query()->first()->name);

        app(UpdateUser::class)->execute(
            $user,
            new UpdateUserData([
                'name' => 'bar',
            ])
        );

        self::assertEquals('bar', User::query()->first()->name);
    }
}
