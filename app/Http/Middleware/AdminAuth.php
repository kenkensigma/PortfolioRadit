<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Protect all /dashboard routes.
     * Redirect unauthenticated visitors to the login page.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Session::get('admin_authenticated')) {
            return redirect()->route('login')
                ->with('status', 'Please sign in to access the dashboard.');
        }

        return $next($request);
    }
}
