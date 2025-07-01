<?php
namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking_office;
use App\Models\Booking_office_answer;
use App\Models\Report;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminDashboardController extends Controller
{

    public function index()
    {
        $reports           = Report::get();
        $totalInspections  = Report::count();
        $pendingCount      = Report::where('status', 'pending')->count();
        $forwardCount      = Report::where('status', 'sent')->count();
        $replyPendingCount = Report::whereIn('status', ['pending', 'sent'])->count();
        return view('admin.dashboard', compact('reports', 'totalInspections', 'pendingCount', 'forwardCount', 'replyPendingCount'));
    }

    public function onemonth()
    {
        return view('admin.report.1month');
    }

    public function secondmonth()
    {
        return view('admin.report.3month');
    }

    public function thirdmonth()
    {
        return view('admin.report.6month');
    }

   public function sendToApprove($id)
{
    $post = Report::findOrFail($id);

    if ($post->status === 'pending') {
        if ($post->last_clicked_by_role === 'admin') {
            return redirect()->back()->with('error', 'Approval is not allowed if last clicked by admin.');
        }

        $post->status = 'approved';
        $post->last_clicked_by_role = null;

        $post->save();

        return redirect()->back()->with('success', 'Report approved successfully!');
    }

    return redirect()->back()->with('info', 'Report must be in pending status to approve.');
}


    public function send($id)
    {
        $report = Report::findOrFail($id);
        if ($report->last_clicked_by_role === 'user') {
            $report->last_clicked_by_role = 'admin';
            $report->save();

            return redirect()->back()->with('success', 'Report status updated successfully!');
        } else {
            return redirect()->back()->with('info', 'Only reports clicked by user can be approved by admin.');
        }
    }

    public function downloadReport($id)
    {
        $report = Report::findOrFail($id);

            $bookingOfficeAnswers = Booking_office_answer::with('bookingOffice')
        ->where('booking_office_id', $report->id)
        ->get();

        $pdf = Pdf::loadView('admin.pdf.report', compact('report', 'bookingOfficeAnswers'));

        return $pdf->download('report_' . $report->id . '.pdf');
    }




    public function generatereport() {
        return view('admin.createreport');
    }

public function savequotationreport(Request $request)
{
    $request->validate([
        'report_type' => 'required',
        'daily_quotation' => 'required|string',
    ]);

    $report = new Booking_office();
    $report->checks = $request->daily_quotation;
    $report->save();

    return response()->json(['success' => true, 'message' => 'Quotation report created successfully!']);
}



}
