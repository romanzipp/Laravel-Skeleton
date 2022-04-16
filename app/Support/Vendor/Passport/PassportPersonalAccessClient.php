<?php

namespace Support\Vendor\Passport;

use Laravel\Passport\PersonalAccessClient;
use Support\Enums\TableName;

class PassportPersonalAccessClient extends PersonalAccessClient
{
    protected $table = TableName::OAUTH_PERSONAL_ACCESS_CLIENTS;
}
