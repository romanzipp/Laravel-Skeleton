<?php

namespace Support\Http\Resources;

class MediaResource extends AbstractResource
{
    public ?string $conversion = null;

    public function __construct($resource, ?string $conversion = null)
    {
        parent::__construct($resource);

        $this->conversion = $conversion;
    }

    public function toArray($request)
    {
        /**
         * @var \Spatie\MediaLibrary\MediaCollections\Models\Media $media
         */
        $media = $this->resource;

        return [
            'url' => $this->conversion
                ? $media->getFullUrl($this->conversion)
                : $media->getFullUrl(),

            'responsive_url' => $this->conversion
                ? $media->getResponsiveImageUrls($this->conversion)
                : $media->getResponsiveImageUrls(),

            'name' => $media->name, /** @phpstan-ignore-line */
            'size' => $media->size, /** @phpstan-ignore-line */
        ];
    }
}
