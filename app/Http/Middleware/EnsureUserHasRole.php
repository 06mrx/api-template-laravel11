<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Middleware\MiddlewareHelper;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole extends MiddlewareHelper
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ... $role): Response
    {
        // dd($request->user()->hasRole($role));
        if (! $request->user()->hasRoles($role)) {
            return $this->sendError("You doesn't have access 🔥",['error'=>'Unauthorised']);
        }
 
        return $next($request);
    }
}
