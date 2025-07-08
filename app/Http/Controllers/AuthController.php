<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user()->role);
        }

        return view('auth.login');
    }

    public function showRegisterForm()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user()->role);
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'required|string|max:15',
            'password' => 'required|string|min:4',
            'address'  => 'required|string|min:5',
            'role'     => 'required|in:parent,hospital'
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'address'  => $request->address,
            'role'     => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attemptWhen($credentials, function ($user) {
            if ($user->status === 'pending') {
                throw ValidationException::withMessages([
                    'email' => 'Your account is pending approval.',
                ]);
            }
            if ($user->status === 'rejected') {
                throw ValidationException::withMessages([
                    'email' => 'Your account has been rejected.',
                ]);
            }
            return $user->status === 'approved';
        })) {
            $request->session()->regenerate();
            return $this->redirectByRole(Auth::user()->role);
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been logged out.');
    }

    protected function redirectByRole($role)
    {
        return match ($role) {
            'admin',            => redirect()->route('admin.dashboard'),
            'hospital'          => redirect()->route('hospital.dashboard'),
            'parent'            => redirect()->route('parent.dashboard'),
            default             => abort(403, 'Unauthorized'),
        };
    }

    public function user()
    {
        $user = Auth::user();

        if ($user->role === 'parent') {
            $children = $user->children;

            $totalBookings = $user->bookings()
                ->count();

            $completedVaccines = $user->bookings()
                ->where('status', 'completed')
                ->count();
            $upcomingBookings = $user->bookings()
                ->where('status', 'approved')->latest()->get();

            $latestReport = $user->reports()->latest()->get();

            return view('parent.index', compact(
                'user',
                'children',
                'totalBookings',
                'completedVaccines',
                'latestReport',
                'upcomingBookings'
            ));
        }

        abort(403, 'Unauthorized access.');
    }
}
