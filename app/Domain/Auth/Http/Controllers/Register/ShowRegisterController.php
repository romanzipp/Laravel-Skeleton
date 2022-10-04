<?php

namespace Domain\Auth\Http\Controllers\Register;

use Domain\Auth\Http\Concerns\ProvidesOAuthServices;
use Illuminate\Foundation\Auth\RegistersUsers;
use Support\Http\Controllers\AbstractController;

final class ShowRegisterController extends AbstractController
{
    use RegistersUsers;
    use ProvidesOAuthServices;

    public function __invoke()
    {
        return view('app.pages.auth.register', [
            'oauthServices' => self::getOAuthServices(),
        ]);
    }
}
