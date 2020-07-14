<?php

namespace Support\Services\Manifest;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Manifest
{
    private $manifest = 'mix-manifest.json';

    public static function make(): Manifest
    {
        return new self;
    }

    public function manifest(string $manifest): Manifest
    {
        $this->manifest = $manifest;

        return $this;
    }

    public function fileName(string $path): ?string
    {
        if ( ! $url = $this->url($path)) {
            return null;
        }

        return Arr::last(explode('/', $url));
    }

    public function url(string $path, bool $absolute = false): ?string
    {
        $manifest = public_path($this->manifest);

        if ( ! file_exists($manifest)) {
            return $path;
        }

        $content = @json_decode(
            file_get_contents($manifest),
            true
        );

        if ( ! Str::startsWith($path, '/')) {
            $path = sprintf('/%s', $path);
        }

        $asset = $content[$path] ?? null;

        if ( ! $absolute) {
            return $asset;
        }

        return url($asset);
    }
}
