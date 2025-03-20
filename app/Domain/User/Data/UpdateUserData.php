<?php

namespace Domain\User\Data;

use Domain\User\Models\UserModel;
use romanzipp\LaravelDTO\Attributes\ForModel;
use romanzipp\LaravelDTO\Attributes\ModelAttribute;

#[ForModel(UserModel::class)]
final class UpdateUserData extends UserData
{
    #[ModelAttribute('display_name')]
    public string $displayName;

    #[ModelAttribute]
    public string $email;

    #[ModelAttribute]
    public string $password;
}
