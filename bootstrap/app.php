<?php

use App\Http\Middleware\EnsureEmailIsVerifiedWithLocale;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\MyGuest;
use App\Http\Middleware\SetLocale;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
            SetLocale::class,

        ]);
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            'verified_with_locale' => EnsureEmailIsVerifiedWithLocale::class,
            'my_guest' => MyGuest::class
            // 'setLocale' => \App\Http\Middleware\SetLocale::class,

        ]);
        $middleware->validateCsrfTokens(except: [
            'https://gorc-ka.trigger.ltd/*',
            'http://127.0.0.1:8000/*',
            'http://localhost:8000/*',

        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {

    })->create();
