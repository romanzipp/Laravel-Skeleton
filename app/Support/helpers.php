<?php

use Support\Services\Manifest\Manifest;

if ( ! function_exists('manifest')) {

    function manifest(string $path = null, bool $absolute = false, string $manifest = 'mix-manifest.json'): ?string
    {
        return Manifest::make()->manifest($manifest)->url($path, $absolute);
    }
}
