<?php

namespace Domain\User\Data;

use Carbon\Carbon;
use Domain\User\Models\User;
use romanzipp\DTO\Attributes\Required;
use romanzipp\LaravelDTO\AbstractModelData;
use romanzipp\LaravelDTO\Attributes\Casts\CastToDate;
use romanzipp\LaravelDTO\Attributes\ForModel;
use romanzipp\LaravelDTO\Attributes\ModelAttribute;

/**
 * @method \Domain\User\Models\User toModel(\Support\Models\AbstractModel $model = null)
 */
#[ForModel(User::class)]
class UserData extends AbstractModelData
{
    #[Required, ModelAttribute('display_name')]
    public string $displayName;

    #[Required, ModelAttribute]
    public string $email;

    #[ModelAttribute]
    public string $password;

    #[CastToDate]
    public ?Carbon $termsAcceptedAt = null;

    #[CastToDate]
    public ?Carbon $emailVerifiedAt = null;
}
