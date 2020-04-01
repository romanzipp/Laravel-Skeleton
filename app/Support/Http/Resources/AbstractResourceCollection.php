<?php

namespace Support\Http\Resources;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use stdClass;

class AbstractResourceCollection extends AnonymousResourceCollection
{
    public function toView($request): stdClass
    {
        return $this
            ->toResponse($request)
            ->getData();
    }
}
