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
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('home');
        }

        // Check admin role

        if (auth()->user()->role !== 'admin') {
            // Auth::guard('web')->logout();
            // $request->session()->invalidate();
            // $request->session()->regenerateToken();
            return redirect()
                ->route('home')
                ->with('error', 'Access denied. Please login with admin account.');
        }

        return $next($request);
    }
}
