<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChildController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $userId = Auth::id();

        $query = Child::where('user_id', $userId);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('dob', 'like', "%{$search}%")
                    ->orWhere('gender', 'like', "%{$search}%");
            });
        }

        $children = $query->get();

        return view('parent.child', compact('children'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'parent-child-add-name' => 'required|string|max:255',
            'parent-child-add-dob' => 'required|date|before_or_equal:today',
            'parent-child-add-gender' => 'required|in:male,female,other',
        ], [
            'parent-child-add-name.required' => 'The child name is required.',
            'parent-child-add-dob.before_or_equal' => 'Date of birth cannot be in the future.',
            'parent-child-add-gender.in' => 'Please select a valid gender option.',
        ], [

            'parent-child-add-name' => 'child name',
            'parent-child-add-dob' => 'date of birth',
            'parent-child-add-gender' => 'gender',
        ]);

        Auth::user()->children()->create([
            'user_id' => Auth::id(),
            'name' => $validated['parent-child-add-name'],
            'dob' => $validated['parent-child-add-dob'],
            'gender' => $validated['parent-child-add-gender']
        ]);

        return back()->with('success', 'Child added successfully.');
    }
    public function update(Request $request, $id)
    {
        $child = Auth::user()->children()->findOrFail($id);

        $validated = $request->validate([
            'parent-child-edit-name' => 'required|string|max:255',
            'parent-child-edit-gender' => 'required|in:male,female,other',
            'parent-child-edit-dob' => 'required|date|before:today',
        ], [
            'parent-child-edit-name.required' => 'The child name is required.',
            'parent-child-edit-gender.in' => 'Please select a valid gender option.',
            'parent-child-edit-dob.before' => 'Date of birth must be in the past.',
        ], [
            'parent-child-edit-name' => 'child name',
            'parent-child-edit-gender' => 'gender',
            'parent-child-edit-dob' => 'date of birth',
        ]);

        $child->update([
            'name' => $validated['parent-child-edit-name'],
            'dob' => $validated['parent-child-edit-dob'],
            'gender' => $validated['parent-child-edit-gender']
        ]);

        return redirect()->route('child.index')->with('success', 'Child information updated successfully.');
    }
    public function destroy($id)
    {
        $child = Auth::user()->children()->findOrFail($id);
        $child->delete();

        return back()->with('success', 'Child removed.');
    }
}
