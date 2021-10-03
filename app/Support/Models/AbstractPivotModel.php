<?php

namespace Support\Models;

use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Support\Models\Concerns\InteractsWithTable;
use Support\Models\Concerns\UsesUuidPrimaryKey;

abstract class AbstractPivotModel extends Pivot
{
    use InteractsWithTable;
    use UsesUuidPrimaryKey;
    use GeneratesUuid {
        UsesUuidPrimaryKey::uuidColumn insteadof GeneratesUuid;
    }

    public $incrementing = false;

    protected $keyType = 'string';

    final public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
