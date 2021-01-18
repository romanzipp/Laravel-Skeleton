<?php

namespace Tests\Feature\Auth;

use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

    public function testSubmitValid()
    {
        $password = self::faker()->password(8);

        $response = $this->post(route('auth.register.process'), [
            'email' => self::faker()->safeEmail,
            'name' => self::faker()->name,
            'password' => $password,
            'password_confirmation' => $password,
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
    }

    public function testSubmitInvalidPasswordConfirmation()
    {
        $response = $this->post(route('auth.register.process'), [
            'email' => self::faker()->safeEmail,
            'name' => self::faker()->name,
            'password' => self::faker()->unique()->password(8),
            'password_confirmation' => self::faker()->unique()->password(8),
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['password']);
    }

    public function testSubmitInvalidEmailTaken()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt(self::faker()->password),
        ]);

        $response = $this->post(route('auth.register.process'), [
            'email' => $user->email,
            'name' => $user->name,
            'password' => $password = self::faker()->password(8),
            'password_confirmation' => $password,
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email']);
    }
}
