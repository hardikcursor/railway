<?php
namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking_office;
use App\Models\Booking_office_answer;
use App\Models\Goods_Shed_office;
use App\Models\INSPECTIONKITCHEN;
use App\Models\InspectionPantryCar;
use App\Models\InspectionPassenger_items;
use App\Models\InspectionPayUseToilets;
use App\Models\INSPECTION_TEA;
use App\Models\NonFare_Revenue;
use App\Models\Parcel_Office;
use App\Models\PRS_office;
use App\Models\Report;
use App\Models\StationCleanliness;
use App\Models\Ticket_Examineroffice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{

    public function index()
    {
        $reports           = Report::get();
        $totalInspections  = Report::count();
        $pendingCount      = Report::where('status', 'pending')->count();
        $forwardCount      = Report::whereIn('last_clicked_by_role', ['user', 'admin'])->count();
        $replyPendingCount = $pendingCount + $forwardCount;
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

            $post->status               = 'approved';
            $post->last_clicked_by_role = null;

            $post->save();

            return redirect()->back()->with('success', 'Report approved successfully!');
        }

        return redirect()->back()->with('info', 'Report must be in pending status to approve.');
    }

    public function send($id)
    {
        $report = Report::findOrFail($id);

        if ($report->status === 'approved') {
            return redirect()->back()->with('info', 'Report is already approved. No changes allowed.');
        }

        if (empty($report->last_clicked_by_role)) {
            $report->last_clicked_by_role = 'admin';
            $report->status               = 'sent';
            $report->save();

            return redirect()->back()->with('success', 'Report sent successfully!');
        }

        return redirect()->back()->with('info', 'Report was already sent/processed.');
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

    public function generatereport()
    {
        return view('admin.createreport');
    }

    // This function is used to Booking save the quotation report

    public function savequotationreport(Request $request)
    {
        $request->validate([
            'report_type'     => 'required',
            'daily_quotation' => 'required|string',
        ]);

        $report         = new Booking_office();
        $report->checks = $request->daily_quotation;
        $report->save();

        return response()->json(['success' => true, 'message' => 'Quotation report created successfully!']);
    }

    // This function is used to save the PRS quotation report

    public function prsSaveQuotationReport(Request $request)
    {
        $request->validate([
            'report_type'   => 'required',
            'prs_quotation' => 'required|string',
        ]);

        $report         = new PRS_office();
        $report->checks = $request->prs_quotation;
        $report->save();

        return response()->json(['success' => true, 'message' => 'Quotation report created successfully!']);
    }

    public function parcelSaveQuotationReport(Request $request)
    {
        $request->validate([
            'report_type'      => 'required',
            'parcel_quotation' => 'required|string',
        ]);

        $report         = new Parcel_Office();
        $report->checks = $request->parcel_quotation;
        $report->save();

        return response()->json(['success' => true, 'message' => 'Quotation report created successfully!']);
    }

    public function goodsSaveQuotationReport(Request $request)
    {

        $request->validate([
            'report_type'     => 'required',
            'goods_quotation' => 'required|string',
        ]);

        $report         = new Goods_Shed_office();
        $report->checks = $request->goods_quotation;
        $report->save();

        return response()->json(['success' => true, 'message' => 'Quotation report created successfully!']);
    }

    public function ticketSaveQuotationReport(Request $request)
    {

        $request->validate([
            'report_type'      => 'required',
            'ticket_quotation' => 'required|string',
        ]);

        $report         = new Ticket_Examineroffice();
        $report->checks = $request->ticket_quotation;
        $report->save();

        return response()->json(['success' => true, 'message' => 'Quotation report created successfully!']);
    }

    public function nonfareSaveQuotationReport(Request $request)
    {

        $request->validate([
            'report_type'       => 'required',
            'nonfare_quotation' => 'required|string',
        ]);

        $report         = new NonFare_Revenue();
        $report->checks = $request->nonfare_quotation;
        $report->save();

        return response()->json(['success' => true, 'message' => 'Quotation report created successfully!']);
    }

    public function inspectionPassengerSaveQuotationReport(Request $request)
    {

        $request->validate([
            'report_type'         => 'required',
            'passenger_quotation' => 'required|string',
        ]);

        $report        = new InspectionPassenger_items();
        $report->items = $request->passenger_quotation;
        $report->save();

        return response()->json(['success' => true, 'message' => 'Quotation report created successfully!']);
    }

    public function stationCleanlinessSaveQuotationReport(Request $request)
    {

        $request->validate([
            'report_type'                  => 'required',
            'stationcleanliness_quotation' => 'required|string',
        ]);

        $report        = new StationCleanliness();
        $report->items = $request->stationcleanliness_quotation;
        $report->save();

        return response()->json(['success' => true, 'message' => 'Quotation report created successfully!']);
    }

    public function inspectionPayUseSaveQuotationReport(Request $request)
    {

        $request->validate([
            'report_type'      => 'required',
            'payuse_quotation' => 'required|string',
        ]);

        $report              = new InspectionPayUseToilets();
        $report->Particulars = $request->payuse_quotation;
        $report->save();

        return response()->json(['success' => true, 'message' => 'Quotation report created successfully!']);
    }

    public function inspectionTeaRefreshmentSaveQuotationReport(Request $request)
    {

        $request->validate([
            'report_type'   => 'required',
            'tea_quotation' => 'required|string',
        ]);

        $report              = new INSPECTION_TEA();
        $report->Particulars = $request->tea_quotation;
        $report->save();

        return response()->json(['success' => true, 'message' => 'Quotation report created successfully!']);
    }

    public function inspectionPantryCarSaveQuotationReport(Request $request)
    {

        $request->validate([
            'report_type'      => 'required',
            'pantry_quotation' => 'required|string',
        ]);

        $report        = new InspectionPantryCar();
        $report->items = $request->pantry_quotation;
        $report->save();

        return response()->json(['success' => true, 'message' => 'Quotation report created successfully!']);
    }

    public function inspectionKitchenSaveQuotationReport(Request $request)
    {

        $request->validate([
            'report_type'    => 'required',
            'base_quotation' => 'required|string',
        ]);

        $report              = new INSPECTIONKITCHEN();
        $report->Particulars = $request->base_quotation;
        $report->save();

        return response()->json(['success' => true, 'message' => 'Quotation report created successfully!']);
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

        return redirect()->route('admin.dashboard')->with('success', 'Post created successfully!');
    }
}
