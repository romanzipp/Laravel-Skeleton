<?php

namespace Tests\Support\Repository;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;
use Support\Models\AbstractModel;

class RepositoryTestModel extends AbstractModel
{
    protected $table = 'tests__repository_models';

    public static function migrate(Builder $builder)
    {
        if ($builder->hasTable('tests__repository_models')) {
            return;
        }

        $builder->create('tests__repository_models', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
        });
    }
}
