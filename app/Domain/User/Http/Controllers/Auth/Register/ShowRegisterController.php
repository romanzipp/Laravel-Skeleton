<?php

namespace Domain\User\Http\Controllers\Auth\Register;

use Illuminate\Foundation\Auth\RegistersUsers;
use Support\Http\Controllers\AbstractController;

final class ShowRegisterController extends AbstractController
{
    use RegistersUsers;

    public function __invoke()
    {
        return view('app.pages.auth.register');
    }
}
