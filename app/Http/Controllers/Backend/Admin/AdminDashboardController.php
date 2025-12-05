<?php
namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking_office;
use App\Models\Booking_office_answer;
use App\Models\Coaching;
use App\Models\Goods_office_answer;
use App\Models\Goods_Shed_office;
use App\Models\Goods_Shed_office_form;
use App\Models\INSPECTIONKITCHEN;
use App\Models\inspectionkitchen_answer;
use App\Models\InspectionPantryCar;
use App\Models\InspectionPantryCar_answer;
use App\Models\InspectionPantryCar_form;
use App\Models\InspectionPassenger_items;
use App\Models\InspectionPassenger_items__answer;
use App\Models\InspectionPayUseToilets;
use App\Models\InspectionPayUseToilets_answer;
use App\Models\InspectionPayUseToilets_location_form;
use App\Models\INSPECTION_TEA;
use App\Models\inspection_tea_answer;
use App\Models\NonFare_Revenue;
use App\Models\NonFare_Revenue_answer;
use App\Models\Parcel_answer;
use App\Models\Parcel_Office;
use App\Models\Parcel_Office_form;
use App\Models\PRS_office;
use App\Models\PRS_office_answer;
use App\Models\PRS_office_form;
use App\Models\Report;
use App\Models\Station;
use App\Models\StationCleanliness;
use App\Models\StationCleanliness_answer;
use App\Models\Ticket_Examineroffice;
use App\Models\Ticket_Examineroffice_form;
use App\Models\Ticket_office_answer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{

    public function admindashboard()
    {
        $reports           = Report::orderBy('created_at', 'desc')->get();
        $totalInspections  = Report::count();
        $pendingCount      = Report::where('status', 'pending')->count();
        $forwardCount      = Report::whereIn('last_clicked_by_role', ['user', 'admin'])->count();
        $replyPendingCount = $pendingCount + $forwardCount;
        return view('admin.admindashboard', compact('reports', 'totalInspections', 'pendingCount', 'forwardCount', 'replyPendingCount'));
    }

    public function payparkdashboard()
    {
        $reports           = Report::orderBy('created_at', 'desc')->get();
        $totalInspections  = Report::count();
        $pendingCount      = Report::where('status', 'pending')->count();
        $forwardCount      = Report::whereIn('last_clicked_by_role', ['user', 'admin'])->count();
        $replyPendingCount = $pendingCount + $forwardCount;
        return view('admin.payparkdashboard', compact('reports', 'totalInspections', 'pendingCount', 'forwardCount', 'replyPendingCount'));
    }

    public function cateringdashboard()
    {
        $reports           = Report::orderBy('created_at', 'desc')->get();
        $totalInspections  = Report::count();
        $pendingCount      = Report::where('status', 'pending')->count();
        $forwardCount      = Report::whereIn('last_clicked_by_role', ['user', 'admin'])->count();
        $replyPendingCount = $pendingCount + $forwardCount;
        return view('admin.cateringdashboard', compact('reports', 'totalInspections', 'pendingCount', 'forwardCount', 'replyPendingCount'));
    }

    public function cleaningdashboard()
    {
        $reports           = Report::orderBy('created_at', 'desc')->get();
        $totalInspections  = Report::count();
        $pendingCount      = Report::where('status', 'pending')->count();
        $forwardCount      = Report::whereIn('last_clicked_by_role', ['user', 'admin'])->count();
        $replyPendingCount = $pendingCount + $forwardCount;
        return view('admin.cleaningdashboard', compact('reports', 'totalInspections', 'pendingCount', 'forwardCount', 'replyPendingCount'));
    }

    public function freightdashboard()
    {
        return view('admin.freightdashboard');
    }

    private function formatThreeWithTwoDecimal($number)
    {
        // First: format with 2 decimals
        $number = number_format($number, 2, '.', '');

        // Split integer + decimal
        $parts = explode('.', $number);

        $int = $parts[0];
        $dec = $parts[1];

        // Take only first 3 digits of integer
        $int = substr($int, 0, 3);

        // Return final formatted number
        return $int . '.' . $dec;
    }

    public function coachingdashboard()
    {
      
        $totalPassengers          = Coaching::sum('Unreserved_Passengers');
        $totalEarning             = Coaching::sum('Unreserved_Earning');
        $totalReserved_Passengers = Coaching::sum('Reserved_Passengers');
        $totalReserved_Earning    = Coaching::sum('Reserved_Earning');
        $Total_Passengers         = Coaching::sum('Total_Passengers');
        $Total_Earning            = Coaching::sum('Total_Earning');

        // Formatting totals (Keep this as is)
        $totalPassengersFormatted = $this->formatThreeWithTwoDecimal($totalPassengers);
        $totalEarningFormatted    = $this->formatThreeWithTwoDecimal($totalEarning);
        $totalReserved_Passengers = $this->formatThreeWithTwoDecimal($totalReserved_Passengers);
        $totalReserved_Earning    = $this->formatThreeWithTwoDecimal($totalReserved_Earning);
        $Total_Passengers         = $this->formatThreeWithTwoDecimal($Total_Passengers);
        $Total_Earning            = $this->formatThreeWithTwoDecimal($Total_Earning);

        // --- THIS IS THE CHANGED PART ---
        $coachoing = Coaching::select('Station')
            ->selectRaw('SUM(Total_Passengers) as Total_Passengers')
            ->selectRaw('SUM(Total_Earning) as Total_Earning')
            ->groupBy('Station')
            ->get();
        // --------------------------------

        return view('admin.​coachingdashboard', compact('totalPassengersFormatted', 'totalEarningFormatted', 'totalReserved_Passengers', 'totalReserved_Earning', 'Total_Passengers', 'Total_Earning', 'coachoing'));
    }

    public function parceldashboard()
    {
        return view('admin.parceldashboard');
    }
    public function index()
    {
        $reports           = Report::orderBy('created_at', 'desc')->get();
        $totalInspections  = Report::count();
        $pendingCount      = Report::where('status', 'pending')->count();
        $forwardCount      = Report::whereIn('last_clicked_by_role', ['user', 'admin'])->count();
        $replyPendingCount = $pendingCount + $forwardCount;

        return view('admin.dashboard', compact('reports', 'totalInspections', 'pendingCount', 'forwardCount', 'replyPendingCount'));
    }

    public function onemonth()
    {
        $reports = Report::where('duration', 'Monthly')->orderBy('created_at', 'desc')->get();
        return view('admin.report.1month', compact('reports'));
    }

    public function secondmonth()
    {
        $reports = Report::where('duration', 'Quaterly')->orderBy('created_at', 'desc')->get();
        return view('admin.report.3month', compact('reports'));
    }

    public function thirdmonth()
    {
        $reports = Report::where('duration', 'Half Yearly')->orderBy('created_at', 'desc')->get();
        return view('admin.report.6month', compact('reports'));
    }

    public function quotationshow()
    {
        $quotation                 = Booking_office::paginate(3, ['*'], 'booking_page');
        $PRS_office                = PRS_office::paginate(3, ['*'], 'prs_page');
        $Parcel_Office             = Parcel_Office::paginate(3, ['*'], 'parcel_page');
        $Goods_Shed_office         = Goods_Shed_office::paginate(3, ['*'], 'goods_shed_page');
        $Ticket_Examineroffice     = Ticket_Examineroffice::paginate(3, ['*'], 'ticket_page');
        $NonFare_Revenue           = NonFare_Revenue::paginate(3, ['*'], 'nonfare_page');
        $InspectionPassenger_items = InspectionPassenger_items::paginate(3, ['*'], 'inspection_passenger_page');
        $StationCleanliness        = StationCleanliness::paginate(3, ['*'], 'station_cleanliness_page');
        $InspectionPayUseToilets   = InspectionPayUseToilets::paginate(3, ['*'], 'inspection_payuse_page');
        $INSPECTION_TEA            = INSPECTION_TEA::paginate(3, ['*'], 'inspection_tea_page');
        $InspectionPantryCar       = InspectionPantryCar::paginate(3, ['*'], 'inspection_pantry_page');
        $INSPECTIONKITCHEN         = INSPECTIONKITCHEN::paginate(3, ['*'], 'inspection_kitchen_page');
        return view('admin.quotationdisplay', compact('quotation', 'PRS_office', 'Parcel_Office', 'Goods_Shed_office', 'Ticket_Examineroffice', 'NonFare_Revenue', 'InspectionPassenger_items', 'StationCleanliness', 'InspectionPayUseToilets', 'INSPECTION_TEA', 'InspectionPantryCar', 'INSPECTIONKITCHEN'));
    }

    public function remove($model, $id)
    {
        switch ($model) {
            case 'booking':
                $record = Booking_office::find($id);
                break;

            case 'prs':
                $record = PRS_office::find($id);
                break;

            case 'parcel':
                $record = Parcel_office::find($id);
                break;
            case 'goods_shed':
                $record = Goods_Shed_office::find($id);
                break;
            case 'ticket':
                $record = Ticket_Examineroffice::find($id);
                break;
            case 'nonfare':
                $record = NonFare_Revenue::find($id);
                break;
            case 'inspection_passenger':
                $record = InspectionPassenger_items::find($id);
                break;
            case 'station_cleanliness':
                $record = StationCleanliness::find($id);
                break;
            case 'inspection_payuse':
                $record = InspectionPayUseToilets::find($id);
                break;
            case 'inspection_tea':
                $record = INSPECTION_TEA::find($id);
                break;
            case 'inspection_pantry':
                $record = InspectionPantryCar::find($id);
                break;
            case 'inspection_kitchen':
                $record = INSPECTIONKITCHEN::find($id);
                break;

            default:
                return redirect()->back()->with('info', 'Invalid model type.');
        }

        if ($record) {
            $record->delete();
            return redirect()->route('admin.quotationshow')->with('success', ucfirst($model) . ' quotation deleted successfully!');
        }

        return redirect()->route('admin.quotationdisplay')->with('info', ucfirst($model) . ' quotation not found or already deleted.');
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

    private function imageToBase64($path)
    {
        if (! file_exists($path)) {
            return null;
        }
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        return 'data:image/' . $type . ';base64,' . base64_encode($data);
    }

    public function downloadReport($id)
    {
        $report = Report::findOrFail($id);

        // Helper function to convert images to base64
        $convertImages = function ($items, $column, $folder) {
            return $items->map(function ($item) use ($column, $folder) {
                $item->image_base64 = ! empty($item->$column)
                    ? $this->imageToBase64(public_path("uploads/$folder/" . $item->$column))
                    : null;
                return $item;
            });
        };

        // Booking Office Answers
        $bookingOfficeAnswers = $convertImages(
            Booking_office_answer::with('bookingOffice')->where('inspection_id', $id)->get(),
            'image_path',
            'booking_answers'
        );

        // PRS Office Answers
        $PRS_office_answers = $convertImages(
            PRS_office_answer::with('PRS_office')->where('inspection_id', $id)->get(),
            'image_path',
            'prs_answers'
        );
        $PRSofficedetail = PRS_office_form::where('inspection_id', $id)->get();

        // Parcel Office Answers
        $Parcel_answer = $convertImages(
            Parcel_answer::with('parcelOffice')->where('inspection_id', $id)->get(),
            'image_path',
            'parcel_answers'
        );
        $Parcelofficedetail = Parcel_Office_form::where('inspection_id', $id)->get();

        // Goods Shed Office Answers
        $Goods_office_answer = $convertImages(
            Goods_office_answer::with('goodsOffice')->where('inspection_id', $id)->get(),
            'image_path',
            'goods_answers'
        );
        $Goods_officedetail = Goods_Shed_office_form::where('inspection_id', $id)->get();

        // Ticket Examiner Office Answers
        $Ticket_office_answer = $convertImages(
            Ticket_office_answer::with('ticketOffice')->where('inspection_id', $id)->get(),
            'image_path',
            'ticket_answers'
        );
        $Ticketofficedetail = Ticket_Examineroffice_form::where('inspection_id', $id)->get();

        // Non-Fare Revenue Answers
        $NonFare_Revenue_answer = $convertImages(
            NonFare_Revenue_answer::with('nonFareRevenueOffice')->where('inspection_id', $id)->get(),
            'image_path',
            'nonfare_answers'
        );

        // Passenger Items
        $InspectionPassenger_items__answer = $convertImages(
            InspectionPassenger_items__answer::with('inspectionPassengerItems')->where('inspection_id', $id)->get(),
            'image_path',
            'passenger_items_answers'
        );

        // Station Cleanliness
        $StationCleanliness_answer = $convertImages(
            StationCleanliness_answer::with('stationCleanliness')->where('inspection_id', $id)->get(),
            'image_path',
            'station_cleanliness_answers'
        );

        // Pay Use Toilets
        $InspectionPayUseToilets_answer = $convertImages(
            InspectionPayUseToilets_answer::with('inspectionPayUseToilets')->where('inspection_id', $id)->get(),
            'image_path',
            'toilets_answers'
        );
        $InspectionPayUseToilets_detail = InspectionPayUseToilets_location_form::where('inspection_id', $id)->get();

        // Tea
        $inspection_tea_answer = $convertImages(
            inspection_tea_answer::with('inspectionTea')->where('inspection_id', $id)->get(),
            'image_path',
            'tea_answers'
        );

        // Pantry Car
        $InspectionPantryCar_answer = $convertImages(
            InspectionPantryCar_answer::with('inspectionPantryCar')->where('inspection_id', $id)->get(),
            'image_path',
            'pantrycar_answers'
        );
        $InspectionPantryCar_detail = InspectionPantryCar_form::where('inspection_id', $id)->get();

        // Kitchen
        $inspectionkitchen_answer = $convertImages(
            inspectionkitchen_answer::with('inspectionKitchen')->where('inspection_id', $id)->get(),
            'image_path',
            'kitchen_answers'
        );

        // Generate PDF
        $pdf = Pdf::loadView('admin.pdf.report', compact(
            'report',
            'bookingOfficeAnswers',
            'PRSofficedetail',
            'PRS_office_answers',
            'Parcelofficedetail',
            'Parcel_answer',
            'Goods_officedetail',
            'Goods_office_answer',
            'Ticketofficedetail',
            'Ticket_office_answer',
            'NonFare_Revenue_answer',
            'InspectionPassenger_items__answer',
            'StationCleanliness_answer',
            'InspectionPayUseToilets_detail',
            'InspectionPayUseToilets_answer',
            'inspection_tea_answer',
            'InspectionPantryCar_detail',
            'InspectionPantryCar_answer',
            'inspectionkitchen_answer'
        ));

        return $pdf->download('inspection_report_' . $report->id . '.pdf');
    }

    public function generatereport()
    {
        return view('admin.createreport');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'Inspector'   => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'description' => 'required|string',
            'category'    => 'required|string',
        ],
            [
                'title.required'       => 'The name of inspection is required.',
                'Inspector.required'   => 'The name of inspector is required.',
                'author.required'      => 'The station is required.',
                'description.required' => 'The type of inspection is required.',
                'category.required'    => 'The duration is required.',
            ]);

        $report                   = new Report();
        $report->NameInspection   = $request->title;
        $report->NameInspector    = $request->Inspector;
        $report->Station          = $request->author;
        $report->TypeofInspection = $request->description;
        $report->Duration         = $request->category;
        $report->status           = 'pending';
        $report->save();

        return redirect()->route('admin.dashboard')->with('success', 'Report created successfully!');
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

        $report         = new InspectionPassenger_items();
        $report->checks = $request->passenger_quotation;
        $report->save();

        return response()->json(['success' => true, 'message' => 'Quotation report created successfully!']);
    }

    public function stationCleanlinessSaveQuotationReport(Request $request)
    {

        $request->validate([
            'report_type'                  => 'required',
            'stationcleanliness_quotation' => 'required|string',
        ]);

        $report         = new StationCleanliness();
        $report->checks = $request->stationcleanliness_quotation;
        $report->save();

        return response()->json(['success' => true, 'message' => 'Quotation report created successfully!']);
    }

    public function inspectionPayUseSaveQuotationReport(Request $request)
    {

        $request->validate([
            'report_type'      => 'required',
            'payuse_quotation' => 'required|string',
        ]);

        $report         = new InspectionPayUseToilets();
        $report->checks = $request->payuse_quotation;
        $report->save();

        return response()->json(['success' => true, 'message' => 'Quotation report created successfully!']);
    }

    public function inspectionTeaRefreshmentSaveQuotationReport(Request $request)
    {

        $request->validate([
            'report_type'   => 'required',
            'tea_quotation' => 'required|string',
        ]);

        $report         = new INSPECTION_TEA();
        $report->checks = $request->tea_quotation;
        $report->save();

        return response()->json(['success' => true, 'message' => 'Quotation report created successfully!']);
    }

    public function inspectionPantryCarSaveQuotationReport(Request $request)
    {

        $request->validate([
            'report_type'      => 'required',
            'pantry_quotation' => 'required|string',
        ]);

        $report         = new InspectionPantryCar();
        $report->checks = $request->pantry_quotation;
        $report->save();

        return response()->json(['success' => true, 'message' => 'Quotation report created successfully!']);
    }

    public function inspectionKitchenSaveQuotationReport(Request $request)
    {

        $request->validate([
            'report_type'    => 'required',
            'base_quotation' => 'required|string',
        ]);

        $report         = new INSPECTIONKITCHEN();
        $report->checks = $request->base_quotation;
        $report->save();

        return response()->json(['success' => true, 'message' => 'Quotation report created successfully!']);
    }

    public function edit($model, $id)
    {
        $modelClass = $this->getModelClass($model);
        $quotation  = $modelClass::findOrFail($id);

        return view('admin.quotation.edit', compact('quotation', 'model'));
    }

    public function update(Request $request, $model, $id)
    {
        $modelClass = $this->getModelClass($model);
        $quotation  = $modelClass::findOrFail($id);

        $request->validate([
            'checks' => 'required|string|max:1000',
        ], [
            'checks.required' => 'The checks field is required.',
        ]);

        switch ($model) {
            case 'booking':
            case 'prs':
            case 'parcel':
            case 'goods_shed':
            case 'ticket':
            case 'nonfare':
                $quotation->checks = $request->input('checks');
                break;

            case 'inspection_passenger':
            case 'station_cleanliness':
            case 'inspection_pantry':
                $quotation->checks = $request->input('checks');
                break;

            case 'inspection_payuse':
            case 'inspection_tea':
            case 'inspection_kitchen':
                $quotation->checks = $request->input('checks');
                break;

            default:
                return back()->with('error', 'Invalid model type.');
        }

        $quotation->save();

        return redirect()->route('admin.quotationshow')->with('success', 'Quotation updated successfully.');
    }

    private function getModelClass($model)
    {
        return match ($model) {
            'booking'              => Booking_office::class,
            'prs'                  => PRS_office::class,
            'parcel'               => Parcel_Office::class,
            'goods_shed'           => Goods_Shed_office::class,
            'ticket'               => Ticket_Examineroffice::class,
            'nonfare'              => NonFare_Revenue::class,
            'inspection_passenger' => InspectionPassenger_items::class,
            'station_cleanliness'  => StationCleanliness::class,
            'inspection_payuse'    => InspectionPayUseToilets::class,
            'inspection_tea'       => INSPECTION_TEA::class,
            'inspection_pantry'    => InspectionPantryCar::class,
            'inspection_kitchen'   => INSPECTIONKITCHEN::class,
            default                => abort(404),

        };
    }

    // view station

    public function station()
    {
        $stations = Station::latest()->get();
        return view('admin.station.create', compact('stations'));
    }

    public function storestation(Request $request)
    {
        $request->validate([
            'station' => 'required|string|max:255',
        ]);

        $station          = new Station;
        $station->station = $request->station;
        $station->save();

        return redirect()->route('admin.station.create')->with('success', 'Station created successfully.');
    }

}
