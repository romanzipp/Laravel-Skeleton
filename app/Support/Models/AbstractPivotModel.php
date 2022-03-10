<?php

namespace Support\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Support\Models\Concerns\InteractsWithTable;

abstract class AbstractPivotModel extends Pivot
{
    use InteractsWithTable;

    public $incrementing = false;

    protected $keyType = 'string';

    final public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
