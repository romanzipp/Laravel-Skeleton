<?php

namespace Domain\User\Data;

use Support\Data\AbstractData;

final class CreateUserData extends AbstractData
{
    protected static array $required = [
        'name',
        'email',
        'password',
    ];

    public string $name;

    public string $displayName;

    public string $email;

    public string $password;
}
