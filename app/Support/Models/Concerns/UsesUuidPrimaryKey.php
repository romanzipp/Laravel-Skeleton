<?php

namespace Support\Models\Concerns;

trait UsesUuidPrimaryKey
{
    public function uuidColumn(): string
    {
        return 'id';
    }
}
