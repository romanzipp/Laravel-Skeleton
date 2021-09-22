<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function testShow()
    {
        $response = $this->get(route('auth.register.show'));

        $response->assertStatus(200);
        $response->assertViewIs('app.pages.auth.register');
    }

    public function testValidation()
    {
        $this->execute([
            RegisterAttempt::create(null, null, null, null, null)->errors(['email', 'name', 'password', 'terms']),
            RegisterAttempt::create('', '', '', '', '')->errors(['email', 'name', 'password', 'terms']),
            RegisterAttempt::create('john@doe.com', null, '', '', '')->errors(['name', 'password', 'terms']),
            RegisterAttempt::create('johndoe.com', null, '', '', '')->errors(['email', 'name', 'password', 'terms']),
            RegisterAttempt::create('', null, '', '', 'y')->errors(['name', 'password', 'terms']),
            RegisterAttempt::create('', null, '', '', 'yes')->errors(['name', 'password']),
            RegisterAttempt::create('', null, '123456789', '', '')->errors(['email', 'name', 'password', 'terms']),
            RegisterAttempt::create('', null, '123456789', '123456789', '')->errors(['email', 'name', 'terms']),
            RegisterAttempt::create('', null, '123456789', '000000000', '')->errors(['email', 'name', 'password', 'terms']),
            RegisterAttempt::create('', null, '1234567', '1234567', '')->errors(['email', 'name', 'password', 'terms']),
            RegisterAttempt::create('john@doe.com', null, '123456789', '123456789', '')->errors(['name', 'terms']),
            RegisterAttempt::create('john@doe.com', 'johndoe', '123456789', '123456789', '')->errors(['terms']),
            RegisterAttempt::create('john@doe.com', 'jh', '123456789', '123456789', 'yes')->errors(['name']),
            RegisterAttempt::create('john@doe.com', 'johndoe#', '123456789', '123456789', 'yes')->errors(['name']),
            RegisterAttempt::create('john@doe.com', str_repeat('a', 40), '123456789', '123456789', 'yes')->errors(['name']),
        ]);
    }

    public function testTakenEmail()
    {
        $this->execute([
            RegisterAttempt::create('john@doe.com', 'johndoe', '123456789', '123456789', 'yes')->errors([]),
            RegisterAttempt::create('john@doe.com', 'johndoe1', '123456789', '123456789', 'yes')->errors(['email']),
        ]);
    }

    private function execute(array $attempts)
    {
        foreach ($attempts as $attempt) {
            $response = $this->post('/auth/register', $attempt->toRequest());
            $response->assertStatus(302);

            if ( ! empty($attempt->assertErrors)) {
                $response->assertInvalid($attempt->assertErrors);
            } else {
                $response->assertSessionHasNoErrors();
            }

            Auth::logout();
        }
    }
}
