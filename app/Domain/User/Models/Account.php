<?php

namespace Domain\User\Models;

use Database\Factories\User\AccountFactory;
use Domain\User\Repositories\AccountRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Support\Enums\ServiceEnum;
use Support\Enums\TableName;
use Support\Models\AbstractModel;

/**
 * @property string $id
 * @property string $name
 * @property string $display_name
 * @property string|null $user_id
 * @property int $service
 * @property string $service_user_id
 * @property string $service_user_name
 * @property string|null $access_token
 * @property string|null $refresh_token
 * @property string|null $scopes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Domain\User\Models\User|null $user
 * @property int|null $users_count
 * @property \Illuminate\Database\Eloquent\Collection|\Support\Vendor\MediaLibrary\Media[] $media
 * @property int|null $media_count
 */
class Account extends AbstractModel implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = TableName::USER_ACCOUNTS;

    protected $casts = [
        'access_token' => 'encrypted',
        'refresh_token' => 'encrypted',
        'enable_monitoring' => 'boolean',
        'is_public' => 'boolean',
    ];

    /*
     *--------------------------------------------------------------------------
     * Relations
     *--------------------------------------------------------------------------
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /*
     *--------------------------------------------------------------------------
     * Methods
     *--------------------------------------------------------------------------
     */

    public static function generateName(string $name): string
    {
        if (empty($name)) {
            $name = 'anonymous';
        }

        do {
            $i = isset($i) ? ++$i : 0;
            $findName = $name . (0 !== $i ? $i : '');
        } while (null !== AccountRepository::make()->findByName($findName));

        return $findName;
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

    public function getService(): ServiceEnum
    {
        if ($this->service instanceof ServiceEnum) {
            return $this->service;
        }

        return new ServiceEnum((int) $this->service);
    }

    public function getExternalServiceUrl(): ?string
    {
        $pattern = $this->getService()->getUserUrlPattern();
        if (null === $pattern) {
            return null;
        }

        return str_replace(
            ['{name}', '{id}'],
            [$this->service_user_name, $this->service_user_id],
            $pattern
        );
    }

    protected static function newFactory()
    {
        return new AccountFactory();
    }
}