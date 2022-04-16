<?php

namespace Support\Vendor\Passport;

use Laravel\Passport\Token;
use Support\Enums\TableName;

class PassportToken extends Token
{
    protected $table = TableName::OAUTH_ACCESS_TOKENS;
}
