<?php

namespace Support\Vendor\Passport;

use Laravel\Passport\RefreshToken;
use Support\Enums\TableName;

/**
 * @property string $id
 * @property string $access_token_id
 * @property bool $revoked
 * @property \Illuminate\Support\Carbon|null $expires_at
 */
class PassportRefreshToken extends RefreshToken
{
    protected $table = TableName::OAUTH_REFRESH_TOKENS;
}
