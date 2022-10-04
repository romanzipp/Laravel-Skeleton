<?php

namespace Domain\User\Data;

use Domain\User\Models\User;
use romanzipp\LaravelDTO\Attributes\ForModel;
use romanzipp\LaravelDTO\Attributes\ModelAttribute;

#[ForModel(User::class)]
final class UpdateUserData extends UserData
{
    #[ModelAttribute('display_name')]
    public string $displayName;

    #[ModelAttribute]
    public string $email;

    #[ModelAttribute]
    public string $password;
}
