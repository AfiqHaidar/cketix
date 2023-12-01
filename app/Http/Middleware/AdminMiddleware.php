<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // Check if the user is an admin
            if (Auth::user()->usertype == 'admin') {
                return $next($request);
            }
        }

        // If not authenticated or not an admin, return a 403 Forbidden response
        abort(403, 'You do not have permission to access this resource.');
    }
}
