<?php

namespace Domain\Auth\Http\Controllers\Login;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Support\Http\Controllers\AbstractController;

final class ShowLoginController extends AbstractController
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __invoke(Request $request)
    {
        return view('app.pages.auth.login');
    }
}
