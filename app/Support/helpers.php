<?php

use Carbon\Carbon;
use Support\Services\Manifest\Manifest;

if ( ! function_exists('manifest')) {
    function manifest(string $path = null, bool $absolute = false, string $manifest = 'mix-manifest.json'): ?string
    {
        return Manifest::make()->manifest($manifest)->url($path, $absolute);
    }
}

if ( ! function_exists('carbon')) {

    /**
     * Spawn a new Carbon date instance from a given timestamp or "now".
     *
     * @param string|null $date
     * @return \Carbon\Carbon
     */
    function carbon(string $date = null): Carbon
    {
        if (null === $date) {
            return Carbon::now();
        }

        return Carbon::make($date);
    }
}

if ( ! function_exists('property_set')) {

    /**
     * Check if a class property has been set with any value. in contrast to isset(), if set
     * with NULL this function will return FALSE.
     *
     * @param $class
     * @param string $property
     * @return bool
     */
    function property_set($class, string $property): bool
    {
        return array_key_exists($property, get_object_vars($class));
    }
}
