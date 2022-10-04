<?php

namespace Tests\Unit\User;

use Domain\User\Models\User;
use Domain\User\Repositories\UserRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    public function testFindUserById()
    {
        $user = User::factory()->create();

        $users = new UserRepository();

        self::assertInstanceOf(User::class, $found = $users->findById($user->id));
        self::assertEquals($found->id, $user->id);
    }
}
