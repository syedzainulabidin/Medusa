<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Report;
use App\Models\Child;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index()
    {
        $hospital = Auth::user();
        $bookingCount = Booking::where('hospital_id', $hospital->id)->where('status', 'approved')->count();
        $reportCount = Report::where('hospital_id', $hospital->id)->count();
        return view('hospital.index', compact('bookingCount', 'reportCount'));
    }

    public function bookings(Request $request)
    {
        $userId = Auth::user()->id;
        $search = $request->search;

        $query = Booking::with('child')
            ->where('hospital_id', $userId)
            ->where('status', 'approved');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('vaccine', 'like', "%{$search}%")
                    ->orWhere('date', 'like', "%{$search}%")
                    ->orWhereHas('child', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%{$search}%")
                            ->orWhere('gender', 'like', "%{$search}%")
                            ->orWhere('dob', 'like', "%{$search}%");
                    })
                    ->orWhereHas('parent', function ($q3) use ($search) {
                        $q3->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }




        $bookings = $query->get();
        $children = Child::all();

        return view('hospital.bookings', compact('bookings', 'children'));
    }

    public function updateStatus($id, $status)
    {
        $booking = Booking::where('hospital_id', Auth::id())->findOrFail($id);
        if (!in_array($status, ['completed', 'rejected'])) {
            return back()->withErrors(['Invalid status value']);
        }

        if ($status == 'completed') {
            Report::create([
                'user_id' => $booking->parent_id,
                'child_id' => $booking->child_id,
                'vaccine' => $booking->vaccine,
                'hospital_id' => $booking->hospital_id,
                'date' => $booking->date,
            ]);
        }

        $booking->status = $status;
        $booking->save();

        return back()->with('success', 'Booking status updated.');
    }

    public function reports(Request $request)
    {
        $userId = Auth::user()->id;
        $search = $request->search;

        $query = Report::with(['child', 'parent', 'hospital'])
            ->where('hospital_id', $userId);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('vaccine', 'like', "%{$search}%")
                    ->orWhere('date', 'like', "%{$search}%")
                    ->orWhereHas('child', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%{$search}%")
                            ->orWhere('dob', 'like', "%{$search}%");
                    })
                    ->orWhereHas('parent', function ($q3) use ($search) {
                        $q3->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    })
                    ->orWhereHas('hospital', function ($q4) use ($search) {
                        $q4->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        $reports = $query->get();

        return view('hospital.reports', compact('reports'));
    }
}
