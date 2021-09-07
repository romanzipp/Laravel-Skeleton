<?php

namespace Domain\Auth\Http\Controllers\Password\Reset;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

final class ProcessResetPasswordController
{
    use ResetsPasswords;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __invoke(Request $request)
    {
        return $this->reset($request);
    }
}
