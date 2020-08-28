<?php

namespace Domain\User\Data;

use Support\Data\AbstractData;

final class CreateUserData extends AbstractData
{
    /** @required */
    public string $name;

    /** @required */
    public string $email;

    /** @required */
    public string $password;
}
