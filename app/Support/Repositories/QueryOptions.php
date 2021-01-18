<?php

namespace Support\Repositories;

use Support\Data\AbstractData;

class QueryOptions extends AbstractData
{
    public array $with = [];

    public array $withCount = [];

    public ?int $paginate = null;

    public ?int $limit = null;

    public array $orderBy = [];
}
