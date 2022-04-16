<?php

namespace Support\Vendor\Passport;

use Laravel\Passport\AuthCode;
use Support\Enums\TableName;

class PassportAuthCode extends AuthCode
{
    protected $table = TableName::OAUTH_AUTH_CODES;
}
