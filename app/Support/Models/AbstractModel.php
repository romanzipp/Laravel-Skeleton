<?php

namespace Support\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Support\Models\Concerns\InteractsWithTable;

abstract class AbstractModel extends Eloquent
{
    use InteractsWithTable;
    use HasUuids;

    protected $guarded = [];

    final public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
