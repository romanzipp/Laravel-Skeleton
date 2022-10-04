<?php

namespace Support\Vendor\Passport;

use Laravel\Passport\Token;
use Support\Enums\TableName;

/**
 * @property string $id
 * @property string|null $user_id
 * @property string $client_id
 * @property string|null $name
 * @property array|null $scopes
 * @property bool $revoked
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property \Illuminate\Support\Carbon|null $expires_at
 */
class PassportToken extends Token
{
    protected $table = TableName::OAUTH_ACCESS_TOKENS;
}
