<?php
namespace App\Http\Controllers\Backend\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Booking_office_answer;
use App\Models\Goods_office_answer;
use App\Models\inspectionkitchen_answer;
use App\Models\InspectionPantryCar_answer;
use App\Models\InspectionPassenger_items__answer;
use App\Models\InspectionPayUseToilets_answer;
use App\Models\inspection_tea_answer;
use App\Models\NonFare_Revenue_answer;
use App\Models\Parcel_answer;
use App\Models\PRS_office_answer;
use App\Models\Report;
use App\Models\StationCleanliness_answer;
use App\Models\Ticket_office_answer;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperadminDashboardController extends Controller
{
    public function index()
    {
        $reports           = Report::get();
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
        $reports = Report::where('duration', '1 Month')->get();
        return view('superadmin.report.1month', compact('reports'));
    }

    public function secondmonth()
    {
        $reports = Report::where('duration', '3 Month')->get();
        return view('superadmin.report.3month', compact('reports'));
    }

    public function thirdmonth()
    {
        $reports = Report::where('duration', '6 Month')->get();
        return view('superadmin.report.6month', compact('reports'));
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

        $bookingOfficeAnswers = Booking_office_answer::with('bookingOffice')
            ->where('inspection_id', $report->id)
            ->get();

        $PRS_office_answers = PRS_office_answer::with('PRS_office')
            ->where('inspection_id', $report->id)
            ->get();

        $Parcel_answer = Parcel_answer::with('parcelOffice')
            ->where('inspection_id', $report->id)
            ->get();

        $Goods_office_answer = Goods_office_answer::with('goodsOffice')
            ->where('inspection_id', $report->id)
            ->get();

        $Ticket_office_answer = Ticket_office_answer::with('ticketOffice')
            ->where('inspection_id', $report->id)
            ->get();

        $NonFare_Revenue_answer = NonFare_Revenue_answer::with('nonFareRevenueOffice')
            ->where('inspection_id', $report->id)
            ->get();

        $InspectionPassenger_items__answer = InspectionPassenger_items__answer::with('inspectionPassengerItems')
            ->where('inspection_id', $report->id)
            ->get();

        $StationCleanliness_answer = StationCleanliness_answer::with('stationCleanliness')
            ->where('inspection_id', $report->id)
            ->get();

        $InspectionPayUseToilets_answer = InspectionPayUseToilets_answer::with('inspectionPayUseToilets')
            ->where('inspection_id', $report->id)
            ->get();

        $inspection_tea_answer = inspection_tea_answer::with('inspectionTea')
            ->where('inspection_id', $report->id)
            ->get();

        $InspectionPantryCar_answer = InspectionPantryCar_answer::with('inspectionPantryCar')
            ->where('inspection_id', $report->id)
            ->get();

        $inspectionkitchen_answer = inspectionkitchen_answer::with('inspectionKitchen')
            ->where('inspection_id', $report->id)
            ->get();

        $pdf = Pdf::loadView('admin.pdf.report', compact('report', 'bookingOfficeAnswers', 'PRS_office_answers', 'Parcel_answer', 'Goods_office_answer', 'Ticket_office_answer', 'NonFare_Revenue_answer', 'InspectionPassenger_items__answer', 'StationCleanliness_answer', 'InspectionPayUseToilets_answer', 'inspection_tea_answer', 'InspectionPantryCar_answer','inspectionkitchen_answer'));

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
