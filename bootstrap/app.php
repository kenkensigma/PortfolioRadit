<?php

/*
|--------------------------------------------------------------------------
| bootstrap/app.php — Laravel 12.x
|--------------------------------------------------------------------------
| Laravel 12 (like L11) uses a single bootstrap file to configure the
| application instead of separate Kernel / RouteServiceProvider classes.
| Routes, middleware, and exception handling are all registered here.
|--------------------------------------------------------------------------
*/

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        // web.php handles all portfolio routes (GET / and POST /contact)
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',           // Laravel 12 built-in health-check endpoint
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // No custom middleware needed for this portfolio.
        // Add global middleware here if required, e.g.:
        // $middleware->append(\App\Http\Middleware\SomethingCustom::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Custom exception handling can be registered here.
        // Laravel 12: ValidationException returns HTTP 422 by default.
    })
    ->create();
