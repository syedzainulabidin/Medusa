<?php

// app/Http/Middleware/RoleMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if (!in_array($user->role, $roles)) {
            return match ($user->role) {
                'admin'    => redirect()->route('admin.dashboard'),
                'hospital' => redirect()->route('hospital.dashboard'),
                default    => redirect()->route('parent.dashboard'),
            };
        }


        return $next($request);
    }
}
