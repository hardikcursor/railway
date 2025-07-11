<?php
namespace App\Http\Controllers\Backend\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Booking_office_answer;
use App\Models\Report;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperadminDashboardController extends Controller
{
    public function index()
    {
        $reports           = Report::paginate(10);
        $totalInspections  = Report::count();
        $approvedReports   = Report::where('status', 'approved')->count();
        $pendingCount      = Report::where('status', 'pending')->count();
        $forwardCount      = Report::whereIn('last_clicked_by_role', ['user', 'admin'])->count();
        $replyPendingCount = $pendingCount + $forwardCount;

        $monthlyReports = $reports->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->created_at)->format('F');
        })->map(function ($group) {
            return $group->count();
        });
        return view('superadmin.dashboard', compact('reports', 'totalInspections', 'approvedReports', 'pendingCount', 'forwardCount', 'replyPendingCount', 'monthlyReports'));
    }

    public function onemonth()
    {
        return view('superadmin.report.1month');
    }

    public function secondmonth()
    {
        return view('superadmin.report.3month');
    }

    public function thirdmonth()
    {
        return view('superadmin.report.6month');
    }

    public function sendtoapproved($id)
    {
        $post = Report::findOrFail($id);

        if ($post->status === 'sent') {
            $post->status               = 'approved';
            $post->last_clicked_by_role = null;

            $post->save();

            return redirect()->back()->with('success', 'Report approved successfully!');
        }

        return redirect()->back()->with('info', 'Report must be in sent status to approve.');
    }

    public function downloadReport($id)
    {
        $report = Report::findOrFail($id);

        $bookingOfficeAnswers = Booking_office_answer::with('bookingOffice')->get();

        $pdf = Pdf::loadView('superadmin.pdf.report', compact('report', 'bookingOfficeAnswers'));

        return $pdf->download('report_' . $report->id . '.pdf');
    }

    public function userdataget()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('superadmin.userdata', compact('users'));
    }

    public function changestatus(Request $request)
    {
        $user = User::find($request->id);
        if ($user) {
            $user->status = $request->val;
            $user->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'User not found'], 404);
    }

  

}
