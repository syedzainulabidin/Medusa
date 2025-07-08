<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Child;
use App\Models\Booking;
use App\Models\Report;
use App\Models\Vaccine;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $childrenCount  = Child::count();
        $vaccinesCount  = Vaccine::where('available', true)->count();
        $reportsCount   = Report::count();
        $requests = User::where('status', 'pending')->count();
        if ($user->role === 'admin') {
            $parentCount   = User::where('role', 'parent')->count();
            $hospitalCount = User::where('role', 'hospital')->count();
            $bookingCount  = Booking::count();
            $pendingBookings  = Booking::where('status', 'pending')->count();
            return view('admin.index', compact(
                'user',
                'parentCount',
                'hospitalCount',
                'childrenCount',
                'bookingCount',
                'vaccinesCount',
                'reportsCount',
                'pendingBookings',
                'requests'
            ));
        } else {
            abort(403, 'Unauthorized access');
        }
    }

    public function hospitals(Request $request)
    {
        $query = User::where('role', 'hospital')->where('status', 'approved');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%");
            });
        }

        $hospitals = $query->get();

        return view('admin.hospitals', compact('hospitals'));
    }


    public function parents(Request $request)
    {
        $query = User::where('role', 'parent')->where('status', 'approved');

        if ($request->has('search') && $request->search !== null) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%");
            });
        }

        $parents = $query->get();

        return view('admin.parents', compact('parents'));
    }

    public function children(Request $request)
    {
        $query = Child::with('parent');

        if ($request->has('search') && $request->search !== null) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('gender', 'like', "%{$search}%")
                    ->orWhereHas('parent', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        $children = $query->get();

        $parents = User::where('role', 'parent')->where('status', 'approved')->get();

        return view('admin.children', compact('children', 'parents'));
    }



    public function deleteHospital($id)
    {
        $hospital = User::where('role', 'hospital')->findOrFail($id);
        $hospital->delete();

        return back()->with('success', 'Hospital removed successfully.');
    }

    public function deleteParent($id)
    {
        $parent = User::where('role', 'parent')->findOrFail($id);
        $parent->delete();

        return back()->with('success', 'Parent removed successfully.');
    }
    public function deleteChild($id)
    {
        $child = \App\Models\Child::findOrFail($id);
        $child->delete();

        return back()->with('success', 'Child deleted successfully.');
    }

    public function requests(Request $request)
    {
        $query = User::where('status', 'pending');

        if ($request->has('search') && $request->search !== null) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%");
            });
        }

        $pendings = $query->paginate(50)->withQueryString();

        return view('admin.requests', compact('pendings'));
    }

    public function updateStatus($id, $status)
    {
        $user = User::findOrFail($id);
        $user->status = $status;
        $user->save();
        return back()->with('success', 'User status updated.');
    }

    public function updateChild(Request $request, $id)
    {
        $child = Child::findOrFail($id);

        $validated = $request->validate([
            'admin-child-edit-name' => 'required|string|max:255',
            'admin-child-edit-dob' => 'required|date|before:today',
            'admin-child-edit-gender' => 'required|in:male,female,other',
        ], [
            // Custom error messages
            'admin-child-edit-name.required' => 'The child name is required.',
            'admin-child-edit-dob.before' => 'The date of birth must be in the past.',
            'admin-child-edit-gender.in' => 'Please select a valid gender option.',
        ], [
            // Custom attribute names
            'admin-child-edit-name' => 'child name',
            'admin-child-edit-dob' => 'date of birth',
            'admin-child-edit-gender' => 'gender',
        ]);

        $child->update([
            'name' => $validated['admin-child-edit-name'],
            'dob' => $validated['admin-child-edit-dob'],
            'gender' => $validated['admin-child-edit-gender'],
        ]);

        return redirect()->route('admin.children')
            ->with('success', 'Child updated successfully.');
    }
    public function addChild(Request $request)
    {
        $validated = $request->validate([
            'admin-child-add-name' => 'required|string|max:255',
            'admin-child-add-parent' => 'required|exists:users,id',
            'admin-child-add-dob' => 'required|date|before:today',
            'admin-child-add-gender' => 'required|in:male,female,other',
        ]);

        Child::create([
            'user_id' => $validated['admin-child-add-parent'],
            'name' => $validated['admin-child-add-name'],
            'dob' => $validated['admin-child-add-dob'],
            'gender' => $validated['admin-child-add-gender']
        ]);

        return redirect()->route('admin.children')->with('success', 'Child added successfully.');
    }

    public function addParents(Request $request)
    {
        $validated = $request->validate([
            'admin-parent-add-name'     => 'required|string|max:255',
            'admin-parent-add-email'    => 'required|email|unique:users,email',
            'admin-parent-add-phone'    => 'required|string|max:15|regex:/^[0-9\+]+$/',
            'admin-parent-add-password' => 'required|string|min:4',
            'admin-parent-add-address'  => 'required|string|min:5|max:255'
        ], [
            'admin-parent-add-name.required' => 'The parent name field is required.',
            'admin-parent-add-email.unique' => 'This email is already registered.',
            'admin-parent-add-phone.regex' => 'Please enter a valid phone number (digits only).',
            'admin-parent-add-password.min' => 'Password must be at least 8 characters.',
            'admin-parent-add-address.min' => 'Address should be at least 5 characters.'
        ], [
            'admin-parent-add-name' => 'parent name',
            'admin-parent-add-email' => 'email',
            'admin-parent-add-phone' => 'phone number',
            'admin-parent-add-password' => 'password',
            'admin-parent-add-address' => 'address'
        ]);

        User::create([
            'name'     => $validated['admin-parent-add-name'],
            'email'    => $validated['admin-parent-add-email'],
            'phone'    => $validated['admin-parent-add-phone'],
            'address'  => $validated['admin-parent-add-address'],
            'status'   => 'approved',
            'role'     => 'parent',
            'password' => Hash::make($validated['admin-parent-add-password']),
            'email_verified_at' => now()
        ]);

        return redirect()
            ->route('admin.parents')
            ->with([
                'success' => 'Parent account created successfully.',
                'new_parent_email' => $validated['admin-parent-add-email']
            ]);
    }


    public function editParents(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'admin-parent-edit-name' => 'required|string|max:255',
            'admin-parent-edit-phone' => 'required|string|max:15|regex:/^[0-9]+$/',
            'admin-parent-edit-address' => 'required|string|max:255',
            'admin-parent-edit-password' => 'nullable|min:4|confirmed',
        ], [
            'admin-parent-edit-name.required' => 'The parent name is required.',
            'admin-parent-edit-phone.required' => 'The phone number is required.',
            'admin-parent-edit-phone.max' => 'The phone number must not exceed 15 digits.',
            'admin-parent-edit-phone.regex' => 'The phone number must contain only numbers.',
            'admin-parent-edit-address.required' => 'The address is required.',
            'admin-parent-edit-password.min' => 'The password must be at least 4 characters.',
            'admin-parent-edit-password.confirmed' => 'The password confirmation does not match.',
        ], [
            'admin-parent-edit-name' => 'parent name',
            'admin-parent-edit-phone' => 'phone number',
            'admin-parent-edit-address' => 'address',
            'admin-parent-edit-password' => 'password',
        ]);

        $updateData = [
            'name' => $validated['admin-parent-edit-name'],
            'phone' => $validated['admin-parent-edit-phone'],
            'address' => $validated['admin-parent-edit-address'],
        ];

        if (!empty($validated['admin-parent-edit-password'])) {
            $updateData['password'] = Hash::make($validated['admin-parent-edit-password']);
        }

        $user->update($updateData);

        return back()->with([
            'success' => 'Parent profile updated successfully.',
            'updated_fields' => array_keys($updateData)
        ]);
    }
    public function addhospital(Request $request)
    {
        $validated = $request->validate([
            'admin-hospital-add-name'     => 'required|string|max:255',
            'admin-hospital-add-email'    => 'required|email|unique:users,email',
            'admin-hospital-add-phone'    => 'required|string|max:15',
            'admin-hospital-add-password' => 'required|string|min:4',
            'admin-hospital-add-address'  => 'required|string|min:5'
        ], [
            'admin-hospital-add-name.required' => 'The hospital name field is required.',
            'admin-hospital-add-email.unique' => 'This email address is already in use.',
            'admin-hospital-add-phone.max' => 'The phone number must not exceed 15 digits.',
            'admin-hospital-add-password.min' => 'The password must be at least 4 characters.',
            'admin-hospital-add-address.min' => 'The address must be at least 5 characters long.'
        ], [
            'admin-hospital-add-name' => 'hospital name',
            'admin-hospital-add-email' => 'email address',
            'admin-hospital-add-phone' => 'phone number',
            'admin-hospital-add-password' => 'password',
            'admin-hospital-add-address' => 'address'
        ]);

        User::create([
            'name'     => $validated['admin-hospital-add-name'],
            'email'    => $validated['admin-hospital-add-email'],
            'phone'    => $validated['admin-hospital-add-phone'],
            'address'  => $validated['admin-hospital-add-address'],
            'status'   => 'approved',
            'role'     => 'hospital',
            'password' => Hash::make($validated['admin-hospital-add-password']),
        ]);

        return redirect()->route('admin.hospitals')
            ->with('success', 'Hospital added successfully.');
    }
    public function editHospitals(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'admin-hospital-edit-name' => 'required|string|max:255',
            'admin-hospital-edit-phone' => 'required|string|max:15|regex:/^[0-9]+$/',
            'admin-hospital-edit-address' => 'required|string|max:255',
            'admin-hospital-edit-password' => 'nullable|min:4|confirmed',
        ], [
            'admin-hospital-edit-phone.max' => 'The phone number must not exceed 15 digits.',
            'admin-hospital-edit-password.confirmed' => 'Password confirmation does not match.',
        ], [
            'admin-hospital-edit-name' => 'name',
            'admin-hospital-edit-phone' => 'phone number',
            'admin-hospital-edit-address' => 'address',
            'admin-hospital-edit-password' => 'password',
        ]);

        $updateData = [
            'name' => $validated['admin-hospital-edit-name'],
            'phone' => $validated['admin-hospital-edit-phone'],
            'address' => $validated['admin-hospital-edit-address'],
        ];

        if (!empty($validated['admin-hospital-edit-password'])) {
            $updateData['password'] = Hash::make($validated['admin-hospital-edit-password']);
        }

        $user->update($updateData);

        return back()->with('success', 'Hospital profile updated successfully.');
    }
}
