<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo(function ($request) {
            if ($request->is('admin/*') || $request->is('admin')) {
                return route('admin.login');
            }
            if ($request->is('vendor/*') || $request->is('vendor')) {
                return route('vendor.login');
            }
            return route('login');
        });

        $middleware->redirectUsersTo(fn ($request) => match (true) {
            auth('admin')->check() => route('admin.dashboard'),
            auth('vendor')->check() => route('vendor.dashboard'),
            default => route('dashboard'),
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
