<?php

namespace Support\Vendor\MediaLibrary;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\DefaultPathGenerator;

class PathGenerator extends DefaultPathGenerator
{
    private const BLOCKED_PATHS = [
        'ad', // Avoid asset path from being blocked by Ad-Blockers
    ];

    /**
     * Get the path for the given media, relative to the root storage path.
     *
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media $media
     *
     * @return string
     */
    public function getPath(Media $media): string
    {
        return $this->getBasePath($media) . '/';
    }

    /**
     * Get the path for conversions of the given media, relative to the root storage path.
     *
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media $media
     *
     * @return string
     */
    public function getPathForConversions(Media $media): string
    {
        return $this->getBasePath($media) . '/conversions/';
    }

    /**
     * Get the path for responsive images of the given media, relative to the root storage path.
     *
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media $media
     *
     * @return string
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getBasePath($media) . '/responsive/';
    }

    /**
     * Get a unique base path for the given media.
     *
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media $media
     *
     * @return string
     */
    protected function getBasePath(Media $media): string
    {
        /** @phpstan-ignore-next-line */
        $id = str_replace('-', '', $media->model->id ?? $media->uuid);

        $parts = [];

        $i = 0;
        do {
            if (in_array($part = substr($id, $i++ * 2, 2), self::BLOCKED_PATHS)) {
                continue;
            }

            $parts[] = $part;
        } while (count($parts) < 3);

        return implode('/', [
            ...$parts,
            $media->id, /** @phpstan-ignore-line */
        ]);
    }
}
