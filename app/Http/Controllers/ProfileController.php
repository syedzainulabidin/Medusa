<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.index');
    }


    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15|regex:/^[0-9\+]+$/',
            'address' => 'required|string|max:255',
            'password' => 'nullable|min:4|confirmed',
        ]);

        $user->update([
            'name'    => $request->name,
            'phone'   => $request->phone,
            'address' => $request->address,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return back()->with('success', 'Profile updated successfully.');
    }
}
