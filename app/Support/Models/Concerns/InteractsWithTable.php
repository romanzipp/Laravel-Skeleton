<?php

namespace Support\Models\Concerns;

trait InteractsWithTable
{
    /**
     * Get the model table name.
     *
     * @return string
     */
    public static function getTableName(): string
    {
        return (new static())->getTable();
    }

    /**
     * Get the model primary column name with table.
     *
     * @param bool $full
     *
     * @return string
     */
    public static function primaryColumn(bool $full = true): string
    {
        return sprintf('%s.%s', static::getTableName(), (new static())->getKeyName());
    }
}
