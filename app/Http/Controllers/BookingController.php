<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Models\Child;
use Illuminate\Http\Request;
use App\Models\Vaccine;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index(Request $request)
{
    $user = Auth::user();
    $search = $request->search;

    $hospitals = User::where('role', 'hospital')->where('status', 'approved')->get();

    $query = Booking::with(['child', 'hospital', 'parent']);

    if ($user->role !== 'admin') {
        $query->where('parent_id', $user->id);
    }

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('vaccine', 'like', "%{$search}%")
              ->orWhere('date', 'like', "%{$search}%")
              ->orWhere('status', 'like', "%{$search}%")
              ->orWhereHas('child', function ($q2) use ($search) {
                  $q2->where('name', 'like', "%{$search}%")
                     ->orWhere('dob', 'like', "%{$search}%")
                     ->orWhere('gender', 'like', "%{$search}%");
              })
              ->orWhereHas('hospital', function ($q3) use ($search) {
                  $q3->where('name', 'like', "%{$search}%")
                     ->orWhere('email', 'like', "%{$search}%");
              });
        });
    }

    $bookings = $query->get();

    if ($user->role === 'admin') {
        return view('admin.bookings', compact('bookings', 'hospitals'));
    } else {
        $vaccines = Vaccine::all();
        return view('parent.bookings', compact('bookings', 'vaccines'));
    }
}


    public function create()
    {
        $hospitals = User::where('role', 'hospital')->where('status', 'approved')->get();
        $children = Auth::user()->children;
        $vaccines = Vaccine::where('available', true)->get();

        return view('parent.book', compact('hospitals', 'children', 'vaccines'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'child_id' => 'required|exists:children,id',
            'vaccine' => [
                'required',
                Rule::exists('vaccines', 'name')->where(function ($query) {
                    $query->where('available', 1);
                }),
            ],
            'date' => 'required|date|after:today',
            'hospital_id' => 'required|exists:users,id',
        ], [
            'child_id.exists' => 'Selected child does not exist',
            'vaccine.exists' => 'Selected vaccine is not available',
            'date.after' => 'Booking date must be in the future',
            'hospital_id.exists' => 'Selected hospital is invalid',
        ], [
            'child_id' => 'child',
            'vaccine' => 'vaccine',
            'date' => 'booking date',
            'hospital_id' => 'hospital',
        ]);

        Booking::create([
            'child_id' => $validated['child_id'],
            'parent_id' => Auth::user()->id,
            'hospital_id' => $validated['hospital_id'],
            'vaccine' => $validated['vaccine'],
            'date' => $validated['date'],
            'status' => 'pending',
        ]);

        return back()->with('success', 'Booking request submitted.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected,completed',
            'hospital_id' => 'required|exists:users,id'
        ]);

        $booking = Booking::findOrFail($id);

        $booking->update([
            'status' => $request->status,
            'hospital_id' => $request->hospital_id,
        ]);

        return back()->with('success', 'Booking updated successfully.');
    }
}
