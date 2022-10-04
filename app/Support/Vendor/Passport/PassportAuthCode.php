<?php

namespace Support\Vendor\Passport;

use Laravel\Passport\AuthCode;
use Support\Enums\TableName;

/**
 * @property string $id
 * @property string $user_id
 * @property string $client_id
 * @property string|null $scopes
 * @property bool $revoked
 * @property \Illuminate\Support\Carbon|null $expires_at
 */
class PassportAuthCode extends AuthCode
{
    protected $table = TableName::OAUTH_AUTH_CODES;
}
