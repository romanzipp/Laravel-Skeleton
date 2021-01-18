<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth as AuthFacade;
use Support\Services\Manifest\Manifest;

if ( ! function_exists('manifest')) {
    /**
     * Get the versioned asset URL from the app manifest.
     *
     * @param string|null $path
     * @param bool $absolute
     * @param string $manifest
     *
     * @return string|null
     */
    function manifest(string $path = null, bool $absolute = false, string $manifest = 'mix-manifest.json'): ?string
    {
        return Manifest::make()->manifest($manifest)->url($path, $absolute);
    }
}

if ( ! function_exists('carbon')) {
    /**
     * Convert a given string date to user timezone adjusted carbon date instance.
     * This is used among blade templates that don't feature frontend javascript date parsing.
     *
     * @param string|null $date
     * @param bool $local
     *
     * @return \Carbon\Carbon
     */
    function carbon(string $date = null, bool $local = false): Carbon
    {
        $tz = null;

        /** @var \Domain\User\Models\User $user */
        if (true === $local && ($user = AuthFacade::user())) {
            $tz = $user->getTimezone();
        }

        if (null === $date) {
            $carbon = Carbon::now();
        } else {
            $carbon = Carbon::make($date);
        }

        if (null !== $tz) {
            return $carbon->setTimezone($tz);
        }

        return $carbon;
    }
}
