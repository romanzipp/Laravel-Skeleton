<?php

namespace Support\Http\Resources;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use stdClass;

class ResourceCollection extends AnonymousResourceCollection
{
    public function toView($request): stdClass
    {
        return $this
            ->toResponse($request)
            ->getData();
    }
}
