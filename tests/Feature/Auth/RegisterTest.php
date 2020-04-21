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
        $password = $this->faker()->password(8);

        $response = $this->post(route('auth.register.process'), [
            'email' => $this->faker()->safeEmail,
            'name' => $this->faker()->name,
            'password' => $password,
            'password_confirmation' => $password,
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
    }

    public function testSubmitInvalidPasswordConfirmation()
    {
        $response = $this->post(route('auth.register.process'), [
            'email' => $this->faker()->safeEmail,
            'name' => $this->faker()->name,
            'password' => $this->faker()->unique()->password(8),
            'password_confirmation' => $this->faker()->unique()->password(8),
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['password']);
    }

    public function testSubmitInvalidEmailTaken()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($this->faker()->password),
        ]);

        $response = $this->post(route('auth.register.process'), [
            'email' => $user->email,
            'name' => $user->name,
            'password' => $password = $this->faker()->password(8),
            'password_confirmation' => $password,
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email']);
    }
}
