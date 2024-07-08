<?php

namespace Support\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Support\Models\Concerns\InteractsWithTable;

abstract class AbstractModel extends Eloquent
{
    use InteractsWithTable;
    use HasUlids;

    protected $guarded = [];

    final public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
