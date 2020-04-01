<?php

namespace Support\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Support\Models\Concerns\InteractsWithTable;
use Support\Models\Concerns\UsesUuid;

abstract class AbstractModel extends Eloquent
{
    use InteractsWithTable;
    use UsesUuid;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];
}
