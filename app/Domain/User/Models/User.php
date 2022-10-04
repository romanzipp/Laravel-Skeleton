<?php

namespace Domain\User\Models;

use Database\Factories\User\UserFactory;
use DateTimeZone;
use Domain\User\Notifications\ResetPasswordNotification;
use Domain\User\Repositories\UserRepository;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Support\Enums\TableName;
use Support\Models\AbstractModel;

/**
 * @property string $id
 * @property string $email
 * @property string $name
 * @property string $display_name
 * @property string $password
 * @property string|null $timezone
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property \Illuminate\Support\Carbon|null $terms_accepted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection|\Domain\User\Models\Account[] $accounts
 * @property int|null $accounts_count
 * @property \Illuminate\Database\Eloquent\Collection|\Support\Vendor\MediaLibrary\Media[] $media
 * @property int|null $media_count
 */
final class User extends AbstractModel implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract, HasMedia
{
    use Authenticatable;
    use Authorizable;
    use CanResetPassword;
    use MustVerifyEmail;
    use Notifiable;
    use HasFactory;
    use InteractsWithMedia;

    protected $table = TableName::USER_USERS;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'email_verified_at',
        'terms_accepted_at',
    ];

    /*
     *--------------------------------------------------------------------------
     * Relations
     *--------------------------------------------------------------------------
     */

    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }

    /*
     *--------------------------------------------------------------------------
     * Methods
     *--------------------------------------------------------------------------
     */

    public static function generateUniqueName(string $name): string
    {
        if (empty($name)) {
            $name = 'anonymous';
        }

        do {
            $i = isset($i) ? ++$i : 0;
            $findName = $name . (0 !== $i ? $i : '');
        } while (null !== UserRepository::make()->findByName($findName));

        return $findName;
    }

    protected static function newFactory()
    {
        return new UserFactory();
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('avatar')
            ->singleFile()
            ->useDisk('avatars');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        /** @phpstan-ignore-next-line */
        $this
            ->addMediaConversion('crop')
            ->performOnCollections('avatar')
            ->withResponsiveImages()
            ->optimize()
            ->nonQueued()
            ->fit(Manipulations::FIT_CROP, 300, 300);
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function getTimezone(): DateTimeZone
    {
        return new DateTimeZone($this->timezone ?? config('app.timezone'));
    }
}
