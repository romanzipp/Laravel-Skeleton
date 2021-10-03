<?php

namespace Support\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

trait UsesUuid
{
    /**
     * Boot the trait, adding a creating observer.
     *
     * When persisting a new model instance, we resolve the UUID field, then set
     * a fresh UUID, taking into account if we need to cast to binary or not.
     *
     * @return void
     */
    public static function bootUsesUuid(): void
    {
        static::creating(function ($model) {
            /* @var \Illuminate\Database\Eloquent\Model|static $model */
            $uuid = self::resolveUuid();

            foreach ($model->uuidColumns() as $item) {
                if (isset($model->attributes[$item]) && ! is_null($model->attributes[$item])) {
                    /* @var \Ramsey\Uuid\Uuid $uuid */
                    $uuid = Uuid::fromString(strtolower($model->attributes[$item]));
                }

                $model->attributes[$item] = $model->hasCast($item, 'uuid') ? $uuid->getBytes() : $uuid->toString();
            }
        });
    }

    /**
     * The name of the column that should be used for the UUID.
     *
     * @return string
     */
    public function uuidColumn(): string
    {
        return 'id';
    }

    /**
     * The names of the columns that should be used for the UUID.
     *
     * @return array
     */
    public function uuidColumns(): array
    {
        return [$this->uuidColumn()];
    }

    /**
     * Resolve a UUID instance for the configured version.
     *
     * @return \Ramsey\Uuid\UuidInterface
     */
    public static function resolveUuid(): UuidInterface
    {
        if ('ordered' === ($version = self::resolveUuidVersion())) {
            return Str::orderedUuid();
        }

        return call_user_func([Uuid::class, $version]);
    }

    /**
     * Find by id.
     *
     * @param string|int $id
     *
     * @return static
     */
    public static function uuid($id): ?self
    {
        return static::query()->find($id);
    }

    /**
     * Resolve the UUID version to use when setting the UUID value. Default to uuid4.
     *
     * @return string
     */
    public static function resolveUuidVersion(): string
    {
        return 'uuid4';
    }

    /**
     * Scope queries to find by UUID.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $uuid
     * @param string $uuidColumn
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereUuid($query, $uuid, $uuidColumn = null): Builder
    {
        $uuidColumn = null !== $uuidColumn && in_array($uuidColumn, $this->uuidColumns())
            ? $uuidColumn
            : $this->uuidColumns()[0];

        return $query->whereIn($uuidColumn, Arr::wrap($uuid));
    }
}
