<?php

namespace Support\Http\Resources;

class ServiceEnumResource extends AbstractResource
{
    public function toArray($request)
    {
        /** @var \Support\Enums\ServiceEnum $service */
        $service = $this->resource;

        return [
            'id' => $service->getValue(),
            'title' => $service->getTitle(),
        ];
    }
}
