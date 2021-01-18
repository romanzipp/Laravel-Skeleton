<?php

namespace Tests\Feature\Auth;

use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function testShow()
    {
        $response = $this->get(route('auth.login.show'));

        $response->assertStatus(200);
        $response->assertViewIs('app.pages.auth.login');
    }

    public function testSubmitValid()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = self::faker()->password),
        ]);

        $response = $this->post(route('auth.login.show'), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
    }

    public function testSubmitInvalidEmail()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = self::faker()->password),
        ]);

        $response = $this->post(route('auth.login.show'), [
            'email' => self::faker()->email,
            'password' => $password,
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email']);
    }
}
