<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $redirectToRoute = null): Response
    {
        if (!$request->user()) {
            return $request->expectsJson()
                ? abort(403, 'Unauthorized')
                : Redirect::guest(URL::route($redirectToRoute ?: ''));
        }
        if ($request->user()->admin) {
            return $request->expectsJson()
                ? abort(403, 'Your email address is not verified.')
                : Redirect::guest(URL::route($redirectToRoute ?: ''));
        }

        return $next($request);
    }
}
