<?php

namespace Domain\Auth\Http\Controllers\Login;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Support\Http\Controllers\AbstractController;

final class ProcessLogoutController extends AbstractController
{
    use AuthenticatesUsers;

    public function __invoke(Request $request)
    {
        return $this->logout($request);
    }
}
