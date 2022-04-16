<?php

namespace Support\Vendor\Passport;

use Laravel\Passport\RefreshToken;
use Support\Enums\TableName;

class PassportRefreshToken extends RefreshToken
{
    protected $table = TableName::OAUTH_REFRESH_TOKENS;
}
