<?php

namespace Domain\User\Data;

use Support\Data\AbstractData;

final class CreateUserData extends AbstractData
{
    public string $name;

    public string $email;

    public string $password;
}
