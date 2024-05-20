<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\EnsureUserHasRole;
use App\Http\Middleware\Checker;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => EnsureUserHasRole::class,
            'must-check' => Checker::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // dd($exceptions);
        // $exceptions->render(function (HttpException $e, Request $request) {
        //     // dd(1);
        //     return view('exception.404');
        // });
    })->create();
