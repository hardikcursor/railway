<?php
namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use App\Imports\NFR_RevenueImport;
use App\Imports\Outward_Freight_RegisterImport;
use App\Imports\RecordsImport;
use App\Models\Booking_office_answer;
use App\Models\Outward_Freight_Register;
use App\Models\Report;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class UserDashboardController extends Controller
{
    public function index()
    {
        $reports           = Report::paginate(10);
        $totalInspections  = Report::count();
        $approvedReports   = Report::where('status', 'approved')->count();
        $pendingCount      = Report::where('status', 'pending')->count();
        $forwardCount      = Report::where('status', 'sent')->count();
        $replyPendingCount = Report::whereIn('status', ['pending', 'sent'])->count();

        $monthlyReports = $reports->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->created_at)->format('F');
        })->map(function ($group) {
            return $group->count();
        });

        return view('user.dashboard', compact('reports', 'totalInspections', 'approvedReports', 'pendingCount', 'forwardCount', 'replyPendingCount', 'monthlyReports'));
    }

    public function onemonth()
    {
        $reports = Report::where('duration', '1 month')->get();

        return view('user.report.1month', compact('reports'));
    }

    public function secondmonth()
    {
        $reports = Report::where('duration', '3 month')->get();
        return view('user.report.3month', compact('reports'));
    }

    public function thirdmonth()
    {
        $reports = Report::where('duration', '6 month')->get();

        return view('user.report.6month', compact('reports'));
    }

    public function form()
    {
        return view('user.form');
    }

    public function store(Request $request)
    {
        $post                   = new Report;
        $post->NameInspection   = $request->title;
        $post->NameInspector    = $request->Inspector;
        $post->Station          = $request->author;
        $post->TypeofInspection = $request->description;
        $post->Duration         = $request->category;
        $post->save();

        return redirect()->route('user.dashboard')->with('success', 'Post created successfully!');
    }

    public function sendToAdmin($id)
    {
        $report = Report::findOrFail($id);
        if (empty($report->last_clicked_by_role)) {
            $report->last_clicked_by_role = 'user';
            $report->save();

            return redirect()->back()->with('success', 'Report status updated successfully!');
        } else {
            return redirect()->back()->with('info', 'Report is already approved.');
        }
    }

    public function sendtoapproved($id)
    {
        $post = Report::findOrFail($id);

        if ($post->status === 'pending') {

            if (in_array($post->last_clicked_by_role, ['user', 'admin'])) {
                return redirect()->back()->with('error', 'Approval not allowed when last clicked by User or Admin.');
            }

            $post->status = 'approved';
            $post->last_clicked_by_role = null;
            $post->save();

            return redirect()->back()->with('success', 'Report approved successfully!');
        }

        return redirect()->back()->with('info', 'Report must be in pending status to approve.');
    }

   public function downloadReport($id)
{
    $report = Report::findOrFail($id);

    // Get all booking office answers related to this report (assuming report ID == booking_office_id)
    $bookingOfficeAnswers = Booking_office_answer::with('bookingOffice')
        ->where('booking_office_id', $report->id)
        ->get();

    $pdf = Pdf::loadView('user.pdf.report', compact('report', 'bookingOfficeAnswers'));

    return $pdf->download('report_' . $report->id . '.pdf');
}


    public function dailyReport()
    {
        return view('user.report.dailyreport');
    }

    public function isearch(Request $request)
    {
        $search = $request->input('search');
        $date   = $request->input('date');

        $reports = Report::when($search, function ($query, $search) {
            return $query->where('NameInspector', 'like', '%' . $search . '%');
        })
            ->when($date, function ($query, $date) {
                return $query->whereDate('created_at', $date);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $totalInspections  = Report::count();
        $pendingCount      = Report::where('status', 'pending')->count();
        $forwardCount      = Report::where('status', 'sent')->count();
        $replyPendingCount = Report::whereIn('status', ['pending', 'sent'])->count();

        $monthlyReports = $reports->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->created_at)->format('F');
        })->map(function ($group) {
            return $group->count();
        });

        return view('user.dashboard', compact(
            'reports', 'totalInspections', 'pendingCount', 'forwardCount', 'replyPendingCount', 'monthlyReports'
        ));
    }

    public function import(Request $request)
    {
        $request->validate([
            'revenue_file' => 'nullable|mimes:xlsx,xls,csv',
            'records_file' => 'nullable|mimes:xlsx,xls,csv',
        ]);

        try {
            if ($request->hasFile('revenue_file')) {
                Excel::import(new NFR_RevenueImport, $request->file('revenue_file'));
            }

            if ($request->hasFile('records_file')) {
                Excel::import(new RecordsImport, $request->file('records_file'));
            }

            if ($request->hasFile('fright_file')) {

                Excel::import(new Outward_Freight_RegisterImport, $request->file('fright_file'));
                $total = Outward_Freight_Register::count();
            }

            return redirect()->back()->with('success', 'Files imported successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    public function frightdashboard()
    {
        return view('user.freightdashboard');
    }

    public function userdataget()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('user.userdata', compact('users'));
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
