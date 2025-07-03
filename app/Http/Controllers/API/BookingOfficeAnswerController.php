<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking_office;
use App\Models\Booking_office_answer;
use App\Models\Goods_Shed_office;
use App\Models\INSPECTION_TEA;
use App\Models\INSPECTIONKITCHEN;
use App\Models\InspectionPantryCar;
use App\Models\InspectionPassenger_items;
use App\Models\InspectionPayUseToilets;
use App\Models\NonFare_Revenue;
use App\Models\Parcel_Office;
use App\Models\PRS_office;
use App\Models\StationCleanliness;
use App\Models\Ticket_Examineroffice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingOfficeAnswerController extends Controller
{
    public function store(Request $request)
    {
        // This is optional now because middleware will already block unauthenticated users.
        if (! Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: Please login first.',
            ], 401);
        }

        $request->validate([
            'booking_office_id' => 'required|exists:booking_offices,id',
            'remarks'           => 'required|string',
        ]);

        $answer                    = new Booking_office_answer();
        $answer->booking_office_id = $request->booking_office_id;
        $answer->remarks           = $request->remarks;
        $answer->save();

        return response()->json([
            'success' => true,
            'message' => 'Answer saved successfully!',
            'data'    => $answer,
        ]);
    }

    public function index()
    {
        $answers = Booking_office_answer::with('bookingOffice')->get();

        return response()->json([
            'success' => true,
            'data'    => $answers,
        ]);
    }

    public function bookingquotionshow()
    {
        $quotations = Booking_office::get();

        return response()->json([
            'success' => true,
            'data'    => $quotations,
        ]);
    }

    //  public function show($id)
    // {
    //     $answer = Booking_office_answer::with('bookingOffice')->findOrFail($id);

    //     return response()->json([
    //         'success' => true,
    //         'data' => $answer,
    //     ]);
    // }

    // This function retrieves all PRS quotations

    public function prsgquotionshow()
    {
        $quotations = PRS_office::get();

        return response()->json([
            'success' => true,
            'data'    => $quotations,
        ]);
    }


   public function parcelgquotionshow()
    {
        $quotations = Parcel_Office::get();

        return response()->json([
            'success' => true,
            'data'    => $quotations,
        ]);
    }

    public function goodshedoffice()  {
        $quotations = Goods_Shed_office::get();

        return response()->json([
            'success' => true,
            'data'    => $quotations,
        ]);
    }

    public function ticketexaminerquotionshow()  {
        $quotations = Ticket_Examineroffice::get();

        return response()->json([
            'success' => true,
            'data'    => $quotations,
        ]);
    }

    public function nonfarequotionshow()  {
        $quotations = NonFare_Revenue::get();

        return response()->json([
            'success' => true,
            'data'    => $quotations,
        ]);
    }

       public function inspectionOfPassengerAmenitiesItems()  {
        $quotations = InspectionPassenger_items::get();

        return response()->json([
            'success' => true,
            'data'    => $quotations,
        ]);
    }

    public function stationCleanlinessProforma() {
        $quotations = StationCleanliness::get();

        return response()->json([
            'success' => true,
            'data'    => $quotations,
        ]);
    }

    public function inspectionOfPayAndUseToilets() {

        $quotations = InspectionPayUseToilets::get();

        return response()->json([
            'success' => true,
            'data'    => $quotations,
        ]);
    }

    public function inspectionOfTeaAndLightRefreshmentStall()  {

        $quotations = INSPECTION_TEA::get();

        return response()->json([
            'success' => true,
            'data'    => $quotations,
        ]);
    }

    public function inspectionOfPantryCar()  {

        $quotations = InspectionPantryCar::get();

        return response()->json([
            'success' => true,
            'data'    => $quotations,
        ]);
    }

    public function inspectionOfBaseKitchen()  {

        $quotations = INSPECTIONKITCHEN::get();

        return response()->json([
            'success' => true,
            'data'    => $quotations,
        ]);
    }
}
