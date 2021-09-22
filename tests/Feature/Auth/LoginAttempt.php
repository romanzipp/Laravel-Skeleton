<?php

namespace Tests\Feature\Auth;

class LoginAttempt extends AbstractAttempt
{
    public ?string $email = null;

    public ?string $password = null;

    public static function create($email, $password): self
    {
        return new self([
            'email' => $email,
            'password' => $password,
        ]);
    }

    public function toRequest(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
