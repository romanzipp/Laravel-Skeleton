<?php

namespace Support\Vendor\Passport;

use Laravel\Passport\PersonalAccessClient;
use Support\Enums\TableName;

/**
 * @property int $id
 * @property string $client_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class PassportPersonalAccessClient extends PersonalAccessClient
{
    protected $table = TableName::OAUTH_PERSONAL_ACCESS_CLIENTS;
}
