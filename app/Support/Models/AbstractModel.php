<?php

namespace Support\Models;

use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Support\Models\Concerns\InteractsWithTable;
use Support\Models\Concerns\UsesUuidPrimaryKey;

abstract class AbstractModel extends Eloquent
{
    use InteractsWithTable;
    use UsesUuidPrimaryKey;
    use GeneratesUuid {
        UsesUuidPrimaryKey::uuidColumn insteadof GeneratesUuid;
        UsesUuidPrimaryKey::resolveUuidVersion insteadof GeneratesUuid;
    }

    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];

    final public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
