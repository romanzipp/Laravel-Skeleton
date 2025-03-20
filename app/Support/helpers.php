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
    function manifest(?string $path = null, bool $absolute = false, string $manifest = 'mix-manifest.json'): ?string
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
    function carbon(?string $date = null, bool $local = false): Carbon
    {
        $tz = null;

        if (true === $local && ($user = AuthFacade::user())) {
            /** @var \Domain\User\Models\UserModel $user */
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

if ( ! function_exists('domain_path')) {
    /**
     * Get file path for a given Domain.
     *
     * @param string $domain
     * @param string $path
     *
     * @return string
     */
    function domain_path(string $domain, string $path): string
    {
        return base_path("app/Domain/$domain/$path");
    }
}
