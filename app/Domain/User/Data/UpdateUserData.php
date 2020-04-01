<?php

namespace Domain\User\Data;

use Support\Data\AbstractData;

final class UpdateUserData extends AbstractData
{
    public ?string $name = null;

    public ?string $password = null;
}
