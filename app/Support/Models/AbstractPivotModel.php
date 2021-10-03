<?php

namespace Support\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Support\Models\Concerns\InteractsWithTable;
use Support\Models\Concerns\UsesUuid;

abstract class AbstractPivotModel extends Pivot
{
    use InteractsWithTable;
    use UsesUuid;

    public $incrementing = false;

    protected $keyType = 'string';

    final public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
