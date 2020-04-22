<?php

namespace Domain\User\Models;

use Domain\User\Notifications\ResetPasswordNotification;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Support\Enums\TableName;
use Support\Models\AbstractModel;

final class User extends AbstractModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Notifiable;
    use Authenticatable;
    use Authorizable;
    use CanResetPassword;
    use MustVerifyEmail;

    protected $table = TableName::USER_USERS;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Send the password reset notification.
     *
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
