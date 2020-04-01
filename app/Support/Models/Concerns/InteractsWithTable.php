<?php

namespace Support\Models\Concerns;

trait InteractsWithTable
{
    public static function getTableName(): string
    {
        return (new static)->getTable();
    }

    public static function primaryColumn(bool $full = true): string
    {
        return sprintf('%s.%s', static::getTableName(), (new static)->getKeyName());
    }
}
