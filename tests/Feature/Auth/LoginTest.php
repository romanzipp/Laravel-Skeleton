<?php

namespace Tests\Feature\Auth;

use Domain\User\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseMigrations;

    public function testShow()
    {
        $response = $this->get(route('auth.login.show'));

        $response->assertStatus(200);
        $response->assertViewIs('app.pages.auth.login');
    }

    public function testValidation()
    {
        $this->createUser();

        $this->execute([
            LoginAttempt::create(null, null)->errors(['email', 'password']),
            LoginAttempt::create('', '')->errors(['email', 'password']),
            LoginAttempt::create('johndoe.com', '')->errors(['password']),
            LoginAttempt::create('john@doe.com', '')->errors(['password']),
            LoginAttempt::create('', '123456789')->errors(['email']),
        ]);
    }

    public function testWrong()
    {
        $this->createUser();

        $this->execute([
            LoginAttempt::create('john@doe.com', '12345678')->errors(['email']),
            LoginAttempt::create('john@doe.co', '123456789')->errors(['email']),
        ]);
    }

    private function execute(array $attempts)
    {
        foreach ($attempts as $attempt) {
            $response = $this->post('/auth/login', $attempt->toRequest());
            $response->assertStatus(302);

            if ( ! empty($attempt->assertErrors)) {
                $response->assertInvalid($attempt->assertErrors);
            } else {
                $response->assertSessionHasNoErrors();
            }
        }
    }

    private function createUser(array $attributes = []): User
    {
        return User::factory()->create([
            'email' => 'john@doe.com',
            'password' => bcrypt('123456789'),
        ] + $attributes);
    }
}
