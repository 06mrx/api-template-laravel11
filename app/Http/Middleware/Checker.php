<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Middleware\MiddlewareHelper;
use Symfony\Component\HttpFoundation\Response;

class Checker extends MiddlewareHelper
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd($request->header('host'));
        // dd(strpos(env('APP_URL'), $request->header('host')));
        if(env("APP_ENV") == "production") {
            if(
                strpos($request->header('User-agent'), "Mozilla" ) == true) return $next($request);
        } else {
            return $next($request);
        }
        return $this->sendError("You doesn't have access 🔥",['error'=>'Unauthorised']);   ;
    }
}
