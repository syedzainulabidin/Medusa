<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if ($user = Auth::user()) {
            return match ($user->role) {
                'admin'    => redirect()->route('admin.dashboard'),
                'hospital' => redirect()->route('hospital.dashboard'),
                default    => redirect()->route('parent.dashboard'),
            };
        }

        return $next($request);
    }
}
