<?php

namespace Tests\Unit\User;

use Domain\User\Actions\CreateUser;
use Domain\User\Actions\UpdateUser;
use Domain\User\Data\CreateUserData;
use Domain\User\Data\UpdateUserData;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserActionTest extends TestCase
{
    use RefreshDatabase;

    public function testCreate()
    {
        app(CreateUser::class)->execute(
            new CreateUserData([
                'name' => 'foo',
                'email' => $this->faker()->email,
                'password' => $this->faker()->password(8),
            ])
        );

        $this->assertEquals('foo', User::query()->first()->name);
    }

    public function testUpdate()
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'name' => 'foo',
        ]);

        $this->assertEquals('foo', User::query()->first()->name);

        app(UpdateUser::class)->execute(
            $user,
            new UpdateUserData([
                'name' => 'bar',
            ])
        );

        $this->assertEquals('bar', User::query()->first()->name);
    }
}
