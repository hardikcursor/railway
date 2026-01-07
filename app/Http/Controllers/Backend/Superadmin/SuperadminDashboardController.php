<?php
namespace App\Http\Controllers\Backend\Superadmin;

use App\Exports\CoachingExport;
use App\Http\Controllers\Controller;
use App\Imports\CateringImport;
use App\Imports\CoachingImport;
use App\Imports\FreightImport;
use App\Models\AdminReportForward;
use App\Models\Booking_office_answer;
use App\Models\Booking_office_form;
use App\Models\Catering;
use App\Models\Coaching;
use App\Models\CoachingDetail;
use App\Models\Goods_office_answer;
use App\Models\Goods_Shed_office_form;
use App\Models\inspectionkitchen_answer;
use App\Models\InspectionPantryCar_answer;
use App\Models\InspectionPantryCar_form;
use App\Models\InspectionPassenger_items__answer;
use App\Models\InspectionPayUseToilets_answer;
use App\Models\InspectionPayUseToilets_location_form;
use App\Models\inspection_tea_answer;
use App\Models\NonFare_Revenue_answer;
use App\Models\Parcel;
use App\Models\Parcel_answer;
use App\Models\Parcel_Office_form;
use App\Models\PRS_office_answer;
use App\Models\PRS_office_form;
use App\Models\Report;
use App\Models\Station;
use App\Models\StationCleanliness_answer;
use App\Models\TicketChecking;
use App\Models\Ticket_Examineroffice_form;
use App\Models\Ticket_office_answer;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class SuperadminDashboardController extends Controller
{

    public function admindashboard()
    {
        return view('superadmin.admindashboard');
    }

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

    public function freightdashboard()
    {
        return view('superadmin.freightdashboard');
    }

    public function coaching()
    {
        return view('superadmin.coachingexcel');
    }

    public function coachingStore(Request $request)
    {
        $request->validate([
            'name'                  => 'required',
            'station_name'          => 'required',
            'unreserved_passengers' => 'required|numeric',
            'unreserved_earning'    => 'required|numeric',
            'reserved_passengers'   => 'required|numeric',
            'reserved_earning'      => 'required|numeric',
            'date'                  => 'required|date',
        ]);

        // 1️⃣ Store main coaching data
        $coaching = Coaching::create([
            'Name'                  => $request->name,
            'Station'               => $request->station_name,
            'Unreserved_Passengers' => $request->unreserved_passengers,
            'Unreserved_Earning'    => $request->unreserved_earning,
            'Reserved_Passengers'   => $request->reserved_passengers,
            'Reserved_Earning'      => $request->reserved_earning,
            'Date'                  => $request->date,
        ]);

        // 2️⃣ Store Unreserved Details
        if ($request->has('unreserved')) {
            foreach ($request->unreserved['class'] as $i => $class) {
                if ($class) {
                    CoachingDetail::create([
                        'coaching_id' => $coaching->id,
                        'type'        => 'unreserved',
                        'class'       => $class,
                        'passenger'   => $request->unreserved['passenger'][$i],
                        'revenue'     => $request->unreserved['revenue'][$i],
                    ]);
                }
            }
        }

        // 3️⃣ Store Reserved Details
        if ($request->has('reserved')) {
            foreach ($request->reserved['class'] as $i => $class) {
                if ($class) {
                    CoachingDetail::create([
                        'coaching_id' => $coaching->id,
                        'type'        => 'reserved',
                        'class'       => $class,
                        'passenger'   => $request->reserved['passenger'][$i],
                        'revenue'     => $request->reserved['revenue'][$i],
                    ]);
                }
            }
        }

        return redirect()
            ->route('superadmin.coachingdashboard')
            ->with('success', 'Coaching data stored successfully');
    }

    public function chingimport(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx',
        ]);

        try {
            Excel::import(new CoachingImport, $request->file('excel_file'));

            return back()->with('success', 'Excel data successfully imported!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    private function formatThreeWithTwoDecimal($value, $unit = 'lakh')
    {
        if ($unit === 'crore') {
            $number = $value / 10000000;
        } else {
            $number = $value / 100000;
        }

        $number = number_format($number, 2, '.', '');

        list($int, $dec) = explode('.', $number);

        $int = substr($int, 0, 3);

        return $int . '.' . $dec;
    }

    public function coachingdashboard()
    {
        $totalUnreservedPassengers = Coaching::selectRaw(
            'SUM(CAST(Unreserved_Passengers AS UNSIGNED)) as total'
        )->value('total') ?? 0;

        $totalUnreservedEarning = Coaching::selectRaw(
            'SUM(CAST(Unreserved_Earning AS DECIMAL(15,2))) as total'
        )->value('total') ?? 0;

        $totalReservedPassengers = Coaching::selectRaw(
            'SUM(CAST(Reserved_Passengers AS UNSIGNED)) as total'
        )->value('total') ?? 0;

        $totalReservedEarning = Coaching::selectRaw(
            'SUM(CAST(Reserved_Earning AS DECIMAL(15,2))) as total'
        )->value('total') ?? 0;

        $totalPassengersFormatted = $this->formatThreeWithTwoDecimal($totalUnreservedPassengers);
        $totalEarningFormatted    = $this->formatThreeWithTwoDecimal($totalUnreservedEarning);

        $totalReserved_Passengers = $this->formatThreeWithTwoDecimal($totalReservedPassengers);
        $totalReserved_Earning    = $this->formatThreeWithTwoDecimal($totalReservedEarning);

        $manualTotalPassengers = $totalUnreservedPassengers + $totalReservedPassengers;
        $manualTotalEarning    = $totalUnreservedEarning + $totalReservedEarning;

        $Total_Passengers = $this->formatThreeWithTwoDecimal($manualTotalPassengers);
        $Total_Earning    = $this->formatThreeWithTwoDecimal($manualTotalEarning);

        $years = Coaching::select(DB::raw('DISTINCT YEAR(Date) as year'))
            ->orderBy('year', 'DESC')
            ->pluck('year')
            ->toArray();

        $raw = Coaching::select(
            'Station',
            DB::raw('YEAR(Date) as Year'),
            DB::raw('SUM(CAST(Unreserved_Passengers AS UNSIGNED) + CAST(Reserved_Passengers AS UNSIGNED)) as Passengers'),
            DB::raw('SUM(CAST(Unreserved_Earning AS DECIMAL(15,2)) + CAST(Reserved_Earning AS DECIMAL(15,2))) as Revenue')
        )
            ->groupBy('Station', 'Year')
            ->get();

        $data = [];
        foreach ($raw as $row) {
            $data[$row->Station][$row->Year] = [
                'Passengers' => (float) $row->Passengers,
                'Revenue'    => (float) $row->Revenue,
            ];
        }

        $station = Coaching::select('Station')
            ->whereNotNull('Station')
            ->distinct()
            ->orderBy('Station')
            ->pluck('Station');

        $rawRevenueData = Coaching::select(
            DB::raw('YEAR(Date) as dataYear'),
            DB::raw('MONTH(Date) as dataMonth'),
            DB::raw('SUM(CAST(Reserved_Earning AS DECIMAL(15,2))) as totalReservedEarning')
        )
            ->groupBy('dataYear', 'dataMonth')
            ->orderBy('dataYear')
            ->orderBy('dataMonth')
            ->get();

        $earningChartData = [];
        foreach ($rawRevenueData as $row) {
            $earningChartData[$row->dataYear][$row->dataMonth] = (float) $row->totalReservedEarning;
        }

        $rawReservedPassengersData = Coaching::select(
            DB::raw('YEAR(Date) as dataYear'),
            DB::raw('MONTH(Date) as dataMonth'),
            DB::raw('SUM(CAST(Reserved_Passengers AS UNSIGNED)) as totalReservedPassengers')
        )
            ->groupBy('dataYear', 'dataMonth')
            ->orderBy('dataYear')
            ->orderBy('dataMonth')
            ->get();

        $passengerChartData = [];
        foreach ($rawReservedPassengersData as $row) {
            $passengerChartData[$row->dataYear][$row->dataMonth] =
                round($row->totalReservedPassengers / 100000, 2);
        }

        $stationSummary = Coaching::select(
            'Station',
            DB::raw('SUM(CAST(Unreserved_Passengers AS UNSIGNED)) as passengers'),
            DB::raw('SUM(CAST(Unreserved_Earning AS DECIMAL(15,2))) as earning')
        )
            ->whereNotNull('Station')
            ->groupBy('Station')
            ->orderBy('Station')
            ->get();

        $passengerLabels = [];
        $passengerValues = [];
        $revenueValues   = [];

        foreach ($stationSummary as $row) {
            $passengerLabels[] = $row->Station;
            $passengerValues[] = round($row->passengers / 100000, 2);
            $revenueValues[]   = round($row->earning / 10000000, 2);
        }

        $stationReservedSummary = Coaching::select(
            'Station',
            DB::raw('SUM(CAST(Reserved_Passengers AS UNSIGNED)) as passengers'),
            DB::raw('SUM(CAST(Reserved_Earning AS DECIMAL(15,2))) as earning')
        )
            ->whereNotNull('Station')
            ->groupBy('Station')
            ->orderBy('Station')
            ->get();

        $reservedPassengerLabels = [];
        $reservedPassengerValues = [];
        $reservedRevenueValues   = [];

        foreach ($stationReservedSummary as $row) {
            $reservedPassengerLabels[] = $row->Station;
            $reservedPassengerValues[] = round($row->passengers / 100000, 2);
            $reservedRevenueValues[]   = round($row->earning / 10000000, 2);
        }

        $records = Coaching::orderBy('id', 'desc')->paginate(10);

        return view('superadmin.​coachingdashboard', compact(
            'totalPassengersFormatted',
            'totalEarningFormatted',
            'totalReserved_Passengers',
            'totalReserved_Earning',
            'Total_Passengers',
            'Total_Earning',
            'data',
            'years',
            'station',
            'earningChartData',
            'passengerChartData',
            'passengerLabels',
            'passengerValues',
            'revenueValues',
            'reservedPassengerLabels',
            'reservedPassengerValues',
            'reservedRevenueValues',
            'records'
        ));
    }

    public function coachingexportExcel()
    {
        return Excel::download(new CoachingExport, 'coaching_data.xlsx');
    }

    public function parceldashboard()
    {
        $revenue = Parcel::sum('revenue');

        $revenueInCr = $revenue / 10000000;

        $totalRevenueTarget = 10000000;
        $revenuePercentage  = ($revenue / $totalRevenueTarget) * 100;

        $totalPackage = Parcel::sum('package');

        $packageInLakh = $totalPackage / 100000;

        $totalPackageTarget = 100000;

        $packagePercentage = $totalPackageTarget > 0
            ? ($packageInLakh / $totalPackageTarget) * 100
            : 0;

        $station = Parcel::select('station')
            ->distinct()
            ->orderBy('station')
            ->pluck('station');

        $item = Parcel::select('items')
            ->distinct()
            ->orderBy('items')
            ->pluck('items');

        $totalWeightKg = Parcel::sum('weight');

        $weightInTonnes = $totalWeightKg / 1000;

        $totalWeightTarget = 1000;

        $weightPercentage = $totalWeightTarget > 0
            ? ($weightInTonnes / $totalWeightTarget) * 100
            : 0;

        $records = Parcel::orderBy('id', 'desc')->paginate(5);

        return view('superadmin.parceldashboard', compact('revenueInCr', 'revenuePercentage', 'packageInLakh', 'packagePercentage', 'station', 'item', 'weightInTonnes', 'weightPercentage', 'records'));
    }

    public function create()
    {
        return view('superadmin.parcelform');
    }

    public function parcelstore(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'revenue' => 'required|numeric',
            'weight'  => 'required|numeric',
            'package' => 'required|integer',
            'date'    => 'required|date',
            'items'   => 'required|string',
            'station' => 'required|string',
        ]);

        Parcel::create($request->all());

        return redirect()->route('superadmin.parceldashboard')->with('success', 'Parcel data saved successfully!');
    }

    public function taskmanager()
    {

        return view('superadmin.taskmanager');
    }

    public function ticketchecking()
    {
        $cases = \App\Models\TicketChecking::sum('cases');

        $casesInLakh = $cases / 100000;

        $totalTarget = 100000;
        $percentage  = ($cases / $totalTarget) * 100;

        $revenue = TicketChecking::sum('revenue');

        $revenueInCr = $revenue / 10000000;

        $totalRevenueTarget = 10000000;
        $revenuePercentage  = ($revenue / $totalRevenueTarget) * 100;

        $cadres = TicketChecking::select('cadre')
            ->distinct()
            ->orderBy('cadre')
            ->pluck('cadre');

        $locations = TicketChecking::select('location')
            ->distinct()
            ->orderBy('location')
            ->pluck('location');

         $records = TicketChecking::orderBy('id', 'desc')->paginate(10);

        return view('superadmin.ticketchecking', compact('cases', 'casesInLakh', 'percentage', 'revenueInCr', 'revenuePercentage', 'cadres', 'locations','records'));
    }

    public function ticketcheckingmaster()
    {
        return view('superadmin.ticketcheckingmaster');
    }

    public function ticketcheckingmasterstore(Request $request)
    {
        $request->validate([
            'cadre'    => 'required|string',
            'location' => 'required|string',
            'cases'    => 'required|integer|min:0',
            'revenue'  => 'required|numeric|min:0',
        ]);

        TicketChecking::create($request->only([
            'cadre',
            'location',
            'cases',
            'revenue',
        ]));

        return redirect()->route('superadmin.ticketchecking')->with('success', 'Ticket Checking data saved successfully!');
    }

    public function cateringdashboard()
    {

        $station = Catering::select('station')
            ->distinct()
            ->orderBy('station')
            ->pluck('station');

        $category = Catering::select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        $unittype = Catering::select('unit_type')
            ->distinct()
            ->orderBy('unit_type')
            ->pluck('unit_type');

        $totalunit = Catering::count('total_units');

        $totalAnnualFee = Catering::sum('annual_license_fee');

        $revenueInCr  = round($totalAnnualFee / 10000000, 2);
        $fee_paidInCr = Catering::sum('fee_paid');

        $totalFee = Catering::sum('annual_fee');

        $lfeeInCr = round($totalFee / 10000000, 2);

        $caterings = Catering::orderBy('annual_license_fee', 'desc')->paginate(10);

        return view('superadmin.cateringdashboard', compact(
            'station',
            'category',
            'unittype',
            'totalunit',
            'revenueInCr',
            'caterings',
            'lfeeInCr'
        ));
    }

    public function cateringform()
    {
        return view('superadmin.cateringform');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:10240',
        ]);

        try {
            Excel::import(new CateringImport, $request->file('file'));
            return back()->with('success', 'સફળતાપૂર્વક ઇમ્પોર્ટ થયું! કુલ રેકોર્ડ્સ: ' . Catering::count());
        } catch (\Exception $e) {
            return back()->with('error', 'એરર: ' . $e->getMessage() . ' (Line: ' . $e->getLine() . ')');
        }
    }

    public function cateringstore(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required',
            'station'     => 'required',
            'unit_type'   => 'required',
            'total_units' => 'required|integer',
            'annual_fee'  => 'required|numeric',
            'fee_paid'    => 'required|numeric',
        ]);

        Catering::create($request->all());

        return redirect()->route('superadmin.cateringdashboard')->with('success', 'Data stored successfully!');
    }

    public function importFreightform()
    {
        return view('superadmin.freightform');
    }

    public function importExcel(Request $request)
    {
        // 🔹 Step 2.1: Validation
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            // 🔹 Step 2.2: Excel Import
            Excel::import(new FreightImport, $request->file('file'));

            // 🔹 Step 2.3: Success message
            return redirect()
                ->back()
                ->with('success', 'Freight Excel data successfully imported!');
        } catch (\Exception $e) {

            // 🔴 Error handling
            return redirect()
                ->back()
                ->with('error', 'Error while importing Excel: ' . $e->getMessage());
        }
    }

}
