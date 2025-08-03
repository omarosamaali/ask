<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // إضافة الـ middleware لكل الـ web routes
        $middleware->web(append: [
            \App\Http\Middleware\Localization::class,
        ]);

        // تسجيل alias للـ middleware
        // $middleware->alias([
        //     'localization' => \App\Http\Middleware\Localization::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
