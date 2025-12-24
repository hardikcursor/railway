<?php
namespace App\Http\Controllers\Backend\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\AdminReportForward;
use App\Models\Booking_office_answer;
use App\Models\Booking_office_form;
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

    // public function coachingStore(Request $request)
    // {
    //     $request->validate([
    //         'name'                  => 'required',
    //         'station_name'          => 'required',
    //         'unreserved_passengers' => 'required|numeric',
    //         'unreserved_earning'    => 'required|numeric',
    //         'reserved_passengers'   => 'required|numeric',
    //         'reserved_earning'      => 'required|numeric',
    //         'date'                  => 'required|date',
    //     ]);
    //     Coaching::create([
    //         'Name'                  => $request->name,
    //         'Station'               => $request->station_name,
    //         'Unreserved_Passengers' => $request->unreserved_passengers,
    //         'Unreserved_Earning'    => $request->unreserved_earning,
    //         'Reserved_Passengers'   => $request->reserved_passengers,
    //         'Reserved_Earning'      => $request->reserved_earning,
    //         'Date'                  => $request->date,

    //     ]);

    //     return redirect()->route('superadmin.coachingdashboard')->with('success', 'Coaching data imported successfully.');
    // }

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
        )->value('total');

        $totalUnreservedEarning = Coaching::selectRaw(
            'SUM(CAST(Unreserved_Earning AS DECIMAL(15,2))) as total'
        )->value('total');

        $totalReservedPassengers = Coaching::selectRaw(
            'SUM(CAST(Reserved_Passengers AS UNSIGNED)) as total'
        )->value('total');

        $totalReservedEarning = Coaching::selectRaw(
            'SUM(CAST(Reserved_Earning AS DECIMAL(15,2))) as total'
        )->value('total');

        $totalPassengers = Coaching::selectRaw(
            'SUM(CAST(Total_Passengers AS UNSIGNED)) as total'
        )->value('total');

        $totalEarning = Coaching::selectRaw(
            'SUM(CAST(Total_Earning AS DECIMAL(15,2))) as total'
        )->value('total');

        $totalPassengersFormatted = $this->formatThreeWithTwoDecimal($totalUnreservedPassengers);
        $totalEarningFormatted    = $this->formatThreeWithTwoDecimal($totalUnreservedEarning);
        $totalReserved_Passengers = $this->formatThreeWithTwoDecimal($totalReservedPassengers);
        $totalReserved_Earning    = $this->formatThreeWithTwoDecimal($totalReservedEarning);
        $manualTotalPassengers    = $totalUnreservedPassengers + $totalReservedPassengers;
        $manualTotalEarning       = $totalUnreservedEarning + $totalReservedEarning;

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

        $monthlyPassengersRaw = Coaching::select(
            DB::raw('YEAR(Date) as dataYear'),
            DB::raw('MONTH(Date) as dataMonth'),
            DB::raw('SUM(CAST(Reserved_Passengers AS UNSIGNED)) as totalMonthlyPassengers')
        )
            ->groupBy('dataYear', 'dataMonth')
            ->orderBy('dataYear')
            ->orderBy('dataMonth')
            ->get();

        $passengerChartData = [];
        foreach ($monthlyPassengersRaw as $row) {
            $passengerChartData[$row->dataYear][$row->dataMonth] = (int) $row->totalMonthlyPassengers;
        }

        $monthlyEarningRaw = Coaching::select(
            DB::raw('YEAR(Date) as dataYear'),
            DB::raw('MONTH(Date) as dataMonth'),
            DB::raw('SUM(CAST(Reserved_Earning AS DECIMAL(15,2))) as totalMonthlyEarning')
        )
            ->groupBy('dataYear', 'dataMonth')
            ->orderBy('dataYear')
            ->orderBy('dataMonth')
            ->get();

        $earningChartData = [];
        foreach ($monthlyEarningRaw as $row) {
            $earningChartData[$row->dataYear][$row->dataMonth] = (float) $row->totalMonthlyEarning;
        }

        $dynamicStats = DB::table('coachings')
            ->select(
                'station as station_name',
                DB::raw('SUM(Unreserved_Passengers) / 100000 as total_pass'),
                DB::raw('SUM(Unreserved_Earning) as total_earn')
            )
            ->groupBy('station_name')
            ->orderBy('total_earn', 'desc')
            ->take(10)
            ->get();

        $unrevPassengerValues = $dynamicStats->pluck('total_pass')->toArray();
        $unrevPassengerLabels = $dynamicStats->pluck('station_name')->toArray();

        $unrevEarningValues = $dynamicStats->pluck('total_earn')->toArray();
        $unrevEarningLabels = $dynamicStats->pluck('station_name')->toArray();

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
            'passengerChartData',
            'monthlyEarningRaw',
            'earningChartData',
            'unrevPassengerValues',
            'unrevPassengerLabels',
            'unrevEarningValues',
            'unrevEarningLabels'
        ));
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

        return view('superadmin.parceldashboard', compact('revenueInCr', 'revenuePercentage', 'packageInLakh', 'packagePercentage', 'station', 'item', 'weightInTonnes', 'weightPercentage'));
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

        return view('superadmin.ticketchecking', compact('cases', 'casesInLakh', 'percentage', 'revenueInCr', 'revenuePercentage', 'cadres', 'locations'));
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

}
