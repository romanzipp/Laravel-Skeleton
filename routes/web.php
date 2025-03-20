<?php

use Illuminate\Support\Facades\Route;

Route::fallback(\Support\Http\Controllers\SpaController::class)->name('root');

return;

Route::get('', \Domain\User\Http\Controllers\IndexController::class)->name('index');

Route::prefix('blog')->group(function () {
    Route::get('', \Domain\Blog\Http\Controllers\ListPostsController::class)->name('blog.index');
    Route::get('{post:slug}', \Domain\Blog\Http\Controllers\ShowPostController::class)->name('blog.show');
});

Route::prefix('auth')->group(function () {
    Route::prefix('oauth')->group(function () {
        Route::prefix('{service}')->group(function () {
            Route::get('redirect', [\Domain\Auth\Http\Controllers\OAuth\OAuthController::class, 'redirect'])->name('auth.connect.redirect');
            Route::match(['GET', 'POST'], 'callback', [\Domain\Auth\Http\Controllers\OAuth\OAuthController::class, 'callback'])->name('auth.connect.callback');
        });
    });

    Route::prefix('login')->middleware(['guest'])->group(function () {
        Route::get('', \Domain\Auth\Http\Controllers\Login\ShowLoginController::class)->name('auth.login.show');
        Route::post('', \Domain\Auth\Http\Controllers\Login\ProcessLoginController::class)->name('auth.login.process');
    });

    Route::post('logout', \Domain\Auth\Http\Controllers\Login\ProcessLogoutController::class)->name('auth.logout.process');

    Route::prefix('register')->middleware(['guest'])->group(function () {
        Route::get('', \Domain\Auth\Http\Controllers\Register\ShowRegisterController::class)->name('auth.register.show');
        Route::post('', \Domain\Auth\Http\Controllers\Register\ProcessRegisterController::class)->name('auth.register.process');
    });

    Route::prefix('password')->group(function () {
        Route::prefix('confirm')->middleware(['auth'])->group(function () {
            Route::get('', \Domain\Auth\Http\Controllers\Password\ShowConfirmPasswordController::class)->name('auth.password.confirm.show');
            Route::post('', \Domain\Auth\Http\Controllers\Password\ProcessConfirmPasswordController::class)->name('auth.password.confirm.process');
        });

        Route::middleware(['guest'])->group(function () {
            Route::get('reset', \Domain\Auth\Http\Controllers\Password\Reset\ShowSendResetEmailController::class)->name('auth.password.request');
            Route::post('email', \Domain\Auth\Http\Controllers\Password\Reset\ProcessSendResetEmailController::class)->name('auth.password.email');

            Route::get('reset/{token}', \Domain\Auth\Http\Controllers\Password\Reset\ShowResetPasswordController::class)->name('auth.password.reset');
            Route::post('reset', \Domain\Auth\Http\Controllers\Password\Reset\ProcessResetPasswordController::class)->name('auth.password.update');
        });
    });

    Route::prefix('email')->middleware(['auth'])->group(function () {
        Route::get('verify', \Domain\Auth\Http\Controllers\Verification\ShowVerificationController::class)->name('auth.verification.notice');

        Route::middleware(['signed'])->group(function () {
            Route::get('verify/{id}/{hash}', \Domain\Auth\Http\Controllers\Verification\ProcessVerificationController::class)->name('auth.verification.verify');
        });

        Route::middleware(['throttle:6,1'])->group(function () {
            Route::post('resend', \Domain\Auth\Http\Controllers\Verification\ResendVerificationController::class)->name('auth.verification.resend');
        });
    });
});
