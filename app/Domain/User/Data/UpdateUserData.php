<?php

namespace Domain\User\Data;

use Support\Data\AbstractData;

final class UpdateUserData extends AbstractData
{
    public ?string $name;

    public ?string $password;
}
