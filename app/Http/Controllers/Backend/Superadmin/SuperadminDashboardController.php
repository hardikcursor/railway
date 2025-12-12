<?php
namespace App\Http\Controllers\Backend\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Booking_office_answer;
use App\Models\Booking_office_form;
use App\Models\Goods_office_answer;
use App\Models\Goods_Shed_office_form;
use App\Models\inspection_tea_answer;
use App\Models\inspectionkitchen_answer;
use App\Models\InspectionPantryCar_answer;
use App\Models\InspectionPantryCar_form;
use App\Models\InspectionPassenger_items__answer;
use App\Models\InspectionPayUseToilets_answer;
use App\Models\InspectionPayUseToilets_location_form;
use App\Models\NonFare_Revenue_answer;
use App\Models\Parcel_answer;
use App\Models\Parcel_Office_form;
use App\Models\PRS_office_answer;
use App\Models\PRS_office_form;
use App\Models\Report;
use App\Models\StationCleanliness_answer;
use App\Models\Ticket_Examineroffice_form;
use App\Models\Ticket_office_answer;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminReportForward;

class SuperadminDashboardController extends Controller
{

   public function index()
{
    $userId = auth()->id();

    $reports = Report::orderBy('created_at', 'desc')->get();

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

    foreach ($reports as $report) {
        $remarks = AdminReportForward::where('report_id', $report->id)
            ->where('officer_name', $userId)
            ->value('officer_remarks');

        $report->user_remarks = $remarks;  
    }

    return view('superadmin.dashboard', compact(
        'reports', 'totalInspections', 'approvedReports', 'pendingCount', 
        'forwardCount', 'replyPendingCount', 'monthlyReports', 'userId'
    ));
}

    public function onemonth()
    {
        $reports = Report::where('duration', 'Monthly')->orderBy('created_at', 'desc')->get();
        return view('superadmin.report.1month', compact('reports'));
    }

    public function secondmonth()
    {
        $reports = Report::where('duration', 'Quaterly')->orderBy('created_at', 'desc')->get();
        return view('superadmin.report.3month', compact('reports'));
    }

    public function thirdmonth()
    {
        $reports = Report::where('duration', 'Half Yearly')->orderBy('created_at', 'desc')->get();
        return view('superadmin.report.6month', compact('reports'));
    }

    // public function sendtoapproved($id)
    // {
    //     $post = Report::findOrFail($id);

    //     if ($post->status === 'sent') {
    //         $post->status               = 'approved';
    //         $post->last_clicked_by_role = null;

    //         $post->save();

    //         return redirect()->back()->with('success', 'Report approved successfully!');
    //     }

    //     return redirect()->back()->with('info', 'Report must be in sent status to approve.');
    // }

    public function sendtoapproved($id)
    {
        $post    = Report::findOrFail($id);
        $adminId = auth()->id();

        if ($post->status !== 'sent') {
            return redirect()->back()->with('info', 'Report must be in sent status to approve.');
        }

        $requiredAdmins = $post->forward_admin_id
            ? explode(',', $post->forward_admin_id)
            : [];

        $approvedAdmins = $post->approve_status
            ? explode(',', $post->approve_status)
            : [];

        if (! in_array($adminId, $approvedAdmins)) {
            $approvedAdmins[] = $adminId;
        }

        $post->approve_status = implode(',', $approvedAdmins);

        sort($requiredAdmins);
        sort($approvedAdmins);

        if ($requiredAdmins == $approvedAdmins) {
            $post->status               = 'approved';
            $post->last_clicked_by_role = null;
        }

        $checkedAdmins = $post->check_status_id
            ? explode(',', $post->check_status_id)
            : [];

        if (! in_array($adminId, $checkedAdmins)) {
            $checkedAdmins[] = $adminId;
        }

        $post->check_status_id = implode(',', $checkedAdmins);

        $post->save();

        return redirect()->back()->with('success', 'Check saved successfully!');
    }

    public function downloadReport($id)
    {
        $report = Report::findOrFail($id);

        $bookingofficedetail = Booking_office_form::where('inspection_id', $id)
            ->get();
        $bookingOfficeAnswers = Booking_office_answer::with('bookingOffice')
            ->where('inspection_id', $report->id)
            ->get();

        $PRSofficedetail = PRS_office_form::where('inspection_id', $id)
            ->get();

        $PRS_office_answers = PRS_office_answer::with('PRS_office')
            ->where('inspection_id', $report->id)
            ->get();

        $Parcelofficedetail = Parcel_Office_form::where('inspection_id', $id)
            ->get();

        $Parcel_answer = Parcel_answer::with('parcelOffice')
            ->where('inspection_id', $report->id)
            ->get();

        $Goods_officedetail = Goods_Shed_office_form::where('inspection_id', $id)
            ->get();

        $Goods_office_answer = Goods_office_answer::with('goodsOffice')
            ->where('inspection_id', $report->id)
            ->get();

        $Ticketofficedetail = Ticket_Examineroffice_form::where('inspection_id', $id)
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

        $InspectionPayUseToilets_detail = InspectionPayUseToilets_location_form::where('inspection_id', $id)
            ->get();

        $InspectionPayUseToilets_answer = InspectionPayUseToilets_answer::with('inspectionPayUseToilets')
            ->where('inspection_id', $report->id)
            ->get();

        $inspection_tea_answer = inspection_tea_answer::with('inspectionTea')
            ->where('inspection_id', $report->id)
            ->get();

        $InspectionPantryCar_detail = InspectionPantryCar_form::where('inspection_id', $id)
            ->get();

        $InspectionPantryCar_answer = InspectionPantryCar_answer::with('inspectionPantryCar')
            ->where('inspection_id', $report->id)
            ->get();

        $inspectionkitchen_answer = inspectionkitchen_answer::with('inspectionKitchen')
            ->where('inspection_id', $report->id)
            ->get();

        $pdf = Pdf::loadView('admin.pdf.report', compact('report', 'bookingofficedetail', 'bookingOfficeAnswers', 'PRSofficedetail', 'PRS_office_answers', 'Parcelofficedetail', 'Parcel_answer', 'Goods_officedetail', 'Goods_office_answer', 'Ticketofficedetail', 'Ticket_office_answer', 'NonFare_Revenue_answer', 'InspectionPassenger_items__answer', 'StationCleanliness_answer', 'InspectionPayUseToilets_detail', 'InspectionPayUseToilets_answer', 'inspection_tea_answer', 'InspectionPantryCar_detail', 'InspectionPantryCar_answer', 'inspectionkitchen_answer'));

        return $pdf->download('report_' . $report->id . '.pdf');
    }

    public function userdataget()
    {
        $users         = User::role('user')->get();
        $currentUserId = Auth::id();

        return view('superadmin.userdata', compact('users', 'currentUserId'));
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
