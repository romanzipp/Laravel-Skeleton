<?php

use Illuminate\Support\Facades\Route;

Route::get('', \Domain\User\Http\Controllers\IndexController::class)->name('index');

Route::prefix('auth')->group(function () {

    Route::prefix('login')->middleware(['guest'])->group(function () {

        Route::get('', \Domain\User\Http\Controllers\Auth\Login\ShowLoginController::class)->name('auth.login.show');
        Route::post('', \Domain\User\Http\Controllers\Auth\Login\ProcessLoginController::class)->name('auth.login.process');

    });

    Route::post('logout', \Domain\User\Http\Controllers\Auth\Login\ProcessLogoutController::class)->name('auth.logout.process');

    Route::prefix('register')->middleware(['guest'])->group(function () {

        Route::get('', \Domain\User\Http\Controllers\Auth\Register\ShowRegisterController::class)->name('auth.register.show');
        Route::post('', \Domain\User\Http\Controllers\Auth\Register\ProcessRegisterController::class)->name('auth.register.process');

    });

    Route::prefix('password')->group(function () {

        Route::prefix('confirm')->middleware(['auth'])->group(function () {

            Route::get('', \Domain\User\Http\Controllers\Auth\Password\ShowConfirmPasswordController::class)->name('auth.password.confirm.show');
            Route::post('', \Domain\User\Http\Controllers\Auth\Password\ProcessConfirmPasswordController::class)->name('auth.password.confirm.process');

        });

        Route::middleware(['guest'])->group(function () {

            Route::get('reset', \Domain\User\Http\Controllers\Auth\Password\Reset\ShowSendResetEmailController::class)->name('auth.password.request');
            Route::post('email', \Domain\User\Http\Controllers\Auth\Password\Reset\ProcessSendResetEmailController::class)->name('auth.password.email');

            Route::get('reset/{token}', \Domain\User\Http\Controllers\Auth\Password\Reset\ShowResetPasswordController::class)->name('auth.password.reset');
            Route::post('reset', \Domain\User\Http\Controllers\Auth\Password\Reset\ProcessResetPasswordController::class)->name('auth.password.update');

        });

    });

    Route::prefix('email')->middleware(['auth'])->group(function () {

        Route::get('verify', \Domain\User\Http\Controllers\Auth\Verification\ShowVerificationController::class)->name('auth.verification.notice');

        Route::middleware(['signed'])->group(function () {

            Route::get('verify/{id}/{hash}', \Domain\User\Http\Controllers\Auth\Verification\ProcessVerificationController::class)->name('auth.verification.verify');

        });

        Route::middleware(['throttle:6,1'])->group(function () {

            Route::post('resend', \Domain\User\Http\Controllers\Auth\Verification\ResendVerificationController::class)->name('auth.verification.resend');

        });

    });

});
