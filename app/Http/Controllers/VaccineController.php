<?php

namespace App\Http\Controllers;

use App\Models\Vaccine;
use Illuminate\Http\Request;

class VaccineController extends Controller
{
    public function index(Request $request)
    {
        $query = Vaccine::query();

        if ($request->has('search') && $request->search !== null) {
            $search = $request->search;

            $query->where('name', 'like', "%{$search}%");
        }

        $vaccines = $query->get();

        return view('admin.vaccines', compact('vaccines'));
    }


    public function store(Request $request)
    {
        $request->validate(['admin-vaccine-add-name' => 'required|string|max:255']);

        \App\Models\Vaccine::create([
            'name' => $request->input('admin-vaccine-add-name'),
            'available' => true,
        ]);

        return back()->with('success', 'Vaccine added.');
    }


    public function updateAvailability($id)
    {
        $vaccine = \App\Models\Vaccine::findOrFail($id);
        $vaccine->available = !$vaccine->available;
        $vaccine->save();

        return back()->with('success', 'Vaccine availability updated.');
    }


    public function destroy($id)
    {
        $vaccine = \App\Models\Vaccine::findOrFail($id);
        $vaccine->delete();

        return back()->with('success', 'Vaccine deleted.');
    }
}
