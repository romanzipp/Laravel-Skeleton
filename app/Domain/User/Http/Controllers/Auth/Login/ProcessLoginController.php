<?php

namespace Domain\User\Http\Controllers\Auth\Login;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Support\Http\Controllers\AbstractController;

final class ProcessLoginController extends AbstractController
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __invoke(Request $request)
    {
        return $this->login($request);
    }
}
