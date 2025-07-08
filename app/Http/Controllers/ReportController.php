<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Child;
use App\Models\User;
use App\Models\Vaccine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function adminReport(Request $request)
    {
        $query = Report::with(['parent', 'child', 'hospital']);

        if ($request->has('search') && $request->search !== null) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('vaccine', 'like', "%{$search}%")
                    ->orWhere('date', 'like', "%{$search}%")
                    ->orWhereHas('parent', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    })
                    ->orWhereHas('child', function ($q3) use ($search) {
                        $q3->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('hospital', function ($q4) use ($search) {
                        $q4->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        $reports = $query->get();

        return view('admin.reports', compact('reports'));
    }
   public function parentReport(Request $request)
{
    $search = $request->search;

    $query = Report::with(['child', 'hospital'])
        ->where('user_id', Auth::id());

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('vaccine', 'like', "%{$search}%")
              ->orWhere('date', 'like', "%{$search}%")
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

    $reports = $query->get();

    return view('parent.reports', compact('reports'));
}

    public function adminShow($id)
    {
        $report = Report::findOrFail($id);
        $pdf = Pdf::loadView('admin.report', ['report' => $report]);
        return $pdf->stream();
    }

    public function parentShow($id)
    {
        $report = Report::findOrFail($id);
        $pdf = Pdf::loadView('parent.report', ['report' => $report]);
        return $pdf->stream();
    }
    public function hospitalShow($id)
    {
        $report = Report::findOrFail($id);
        $pdf = Pdf::loadView('hospital.report', ['report' => $report]);
        return $pdf->stream();
    }
    public function adminDownload($id)
    {
        $report = Report::findOrFail($id);
        $pdf = Pdf::loadView('admin.report', ['report' => $report]);
        return $pdf->download('report.pdf');
    }
    public function parentDownload($id)
    {
        $report = Report::findOrFail($id);
        $pdf = Pdf::loadView('parent.report', ['report' => $report]);
        return $pdf->download('report.pdf');
    }
    public function hospitalDownload($id)
    {
        $report = Report::findOrFail($id);
        $pdf = Pdf::loadView('hospital.report', ['report' => $report]);
        return $pdf->download('report.pdf');
    }
}
