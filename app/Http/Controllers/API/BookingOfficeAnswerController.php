<?php
namespace App\Http\Controllers\Api;

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
use App\Models\StationCleanliness;
use App\Models\Ticket_Examineroffice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingOfficeAnswerController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'booking_office_id' => 'required|exists:booking_offices,id',
            'answer'            => 'required|string',
            'remark'            => 'nullable|string',
        ]);

        $answer                    = new Booking_office_answer();
        $answer->user_id           = Auth::id();
        $answer->booking_office_id = $request->booking_office_id;
        $answer->answer            = $request->answer;
        $answer->remark            = $request->remark;
        $answer->save();

        return response()->json([
            'success' => true,
            'message' => 'Answer saved successfully!',
            'data'    => $answer,
        ]);
    }

    public function bookinganswershow()
    {
        $answers = Booking_office_answer::with('bookingOffice')->get()->map(function ($answer) {
            return [
                'id'                => $answer->id,
                'user_id'           => $answer->user_id,
                'booking_office_id' => $answer->booking_office_id,
                'answer'            => $answer->answer ?? "",
                'remark'            => $answer->remark ?? "",
                'booking_office'    => $answer->bookingOffice,
            ];
        });

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

    public function goodshedoffice()
    {
        $quotations = Goods_Shed_office::get();

        return response()->json([
            'success' => true,
            'data'    => $quotations,
        ]);
    }

    public function ticketexaminerquotionshow()
    {
        $quotations = Ticket_Examineroffice::get();

        return response()->json([
            'success' => true,
            'data'    => $quotations,
        ]);
    }

    public function nonfarequotionshow()
    {
        $quotations = NonFare_Revenue::get();

        return response()->json([
            'success' => true,
            'data'    => $quotations,
        ]);
    }

    public function inspectionOfPassengerAmenitiesItems()
    {
        $quotations = InspectionPassenger_items::get();

        return response()->json([
            'success' => true,
            'data'    => $quotations,
        ]);
    }

    public function stationCleanlinessProforma()
    {
        $quotations = StationCleanliness::get();

        return response()->json([
            'success' => true,
            'data'    => $quotations,
        ]);
    }

    public function inspectionOfPayAndUseToilets()
    {

        $quotations = InspectionPayUseToilets::get();

        return response()->json([
            'success' => true,
            'data'    => $quotations,
        ]);
    }

    public function inspectionOfTeaAndLightRefreshmentStall()
    {

        $quotations = INSPECTION_TEA::get();

        return response()->json([
            'success' => true,
            'data'    => $quotations,
        ]);
    }

    public function inspectionOfPantryCar()
    {

        $quotations = InspectionPantryCar::get();

        return response()->json([
            'success' => true,
            'data'    => $quotations,
        ]);
    }

    public function inspectionOfBaseKitchen()
    {

        $quotations = INSPECTIONKITCHEN::get();

        return response()->json([
            'success' => true,
            'data'    => $quotations,
        ]);
    }
}
