<?php

namespace Tests\Feature\Auth;

class RegisterAttempt extends AbstractAttempt
{
    public ?string $email = null;

    public ?string $name = null;

    public ?string $password = null;

    public ?string $passwordConfirmation = null;

    public ?string $terms = null;

    public static function create($email, $name, $password, $passwordConfirmation, $terms): self
    {
        return new self([
            'email' => $email,
            'name' => $name,
            'password' => $password,
            'passwordConfirmation' => $passwordConfirmation,
            'terms' => $terms,
        ]);
    }

    public function toRequest(): array
    {
        return [
            'email' => $this->email,
            'name' => $this->name,
            'password' => $this->password,
            'password_confirmation' => $this->passwordConfirmation,
            'terms' => $this->terms,
        ];
    }
}
