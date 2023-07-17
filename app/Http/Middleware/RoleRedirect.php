<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()) {
            // Check the role of the authenticated user
            $role = $request->user()->role;

            // Redirect the user based on their role
            if ($role === 'User') {
                if ($request->route()->getName() !== 'user.dashboard.home') {
                    return redirect()->route('user.dashboard.home');
                }
            } else if ($role === 'Admin') {
                if ($request->route()->getName() !== 'admin.dashboard.home') {
                    return redirect()->route('admin.dashboard.home');
                }
            }
        }
        return $next($request);
    }
}
