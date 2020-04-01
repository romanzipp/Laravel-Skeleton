<?php

namespace Support\Enums;

use MyCLabs\Enum\Enum;

class TableName extends Enum
{
    public const SUPPORT_JOBS = 'support-jobs';
    public const SUPPORT_FAILED_JOBS = 'support-failed_jobs';

    public const USER_USERS = 'user-users';
    public const USER_PASSWORD_RESETS = 'user-password_resets';
}
