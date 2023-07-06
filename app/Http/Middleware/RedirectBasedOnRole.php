<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectBasedOnRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if ($request->user()) {
            // Check the role of the authenticated user
            $role = $request->user()->role; // Replace 'role' with the actual column name for role in your user table

            // Redirect the user based on their role
            if ($role === 'admin') {
                return redirect()->route('admin.dashboard.home');
            } else {
                return redirect()->route('user.dashboard.home');
            }
        }
        return $next($request);
    }
}
