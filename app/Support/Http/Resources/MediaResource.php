<?php

namespace Support\Http\Resources;

class MediaResource extends AbstractResource
{
    public function toArray($request)
    {
        /**
         * @var \Spatie\MediaLibrary\MediaCollections\Models\Media $media
         */
        $media = $this->resource;

        return [
            'url' => $media->getFullUrl(),
            'responsive_url' => $media->getResponsiveImageUrls(),
            'name' => $media->name, /** @phpstan-ignore-line */
            'size' => $media->size, /** @phpstan-ignore-line */
        ];
    }
}
