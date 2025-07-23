<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking_office;
use App\Models\Booking_office_answer;
use App\Models\Goods_office_answer;
use App\Models\Goods_Shed_office;
use App\Models\INSPECTIONKITCHEN;
use App\Models\inspectionkitchen_answer;
use App\Models\InspectionPantryCar;
use App\Models\InspectionPantryCar_answer;
use App\Models\InspectionPassenger_items;
use App\Models\InspectionPassenger_items__answer;
use App\Models\InspectionPayUseToilets;
use App\Models\InspectionPayUseToilets_answer;
use App\Models\INSPECTION_TEA;
use App\Models\inspection_tea_answer;
use App\Models\NonFare_Revenue;
use App\Models\NonFare_Revenue_answer;
use App\Models\Parcel_answer;
use App\Models\Parcel_Office;
use App\Models\PRS_office;
use App\Models\PRS_office_answer;
use App\Models\Report;
use App\Models\StationCleanliness;
use App\Models\StationCleanliness_answer;
use App\Models\Ticket_Examineroffice;
use App\Models\Ticket_office_answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BookingOfficeAnswerController extends Controller
{

    public function inspectionstore(Request $request)
    {
        try {
            // Validate the input
            $validated = $request->validate([
                'title'       => 'required|string|max:255',
                'Inspector'   => 'required|string|max:255',
                'author'      => 'required|string|max:255',
                'description' => 'required|string',
                'category'    => 'required|string',
            ], [
                'title.required'       => 'The name of inspection is required.',
                'Inspector.required'   => 'The name of inspector is required.',
                'author.required'      => 'The station is required.',
                'description.required' => 'The type of inspection is required.',
                'category.required'    => 'The duration is required.',
            ]);

            // Create report
            $report = Report::create([
                'NameInspection'   => $validated['title'],
                'NameInspector'    => $validated['Inspector'],
                'Station'          => $validated['author'],
                'TypeofInspection' => $validated['description'],
                'Duration'         => $validated['category'],
                'status'           => 'pending',
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Report created successfully!',
                'data'    => $report,
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation failed.',
                'errors'  => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong!',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'           => 'required|exists:users,id',
            'booking_office_id' => 'required|exists:booking_offices,id',
            'report_id'         => 'required|exists:reports,id',
            'answer'            => 'required|string',
            'remark'            => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $answer = Booking_office_answer::create([
            'user_id'           => $request->user_id,
            'booking_office_id' => $request->booking_office_id,
            'report_id'         => $request->report_id,
            'answer'            => $request->answer,
            'remark'            => $request->remark,
        ]);

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

    public function prsanswer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'       => 'required|exists:users,id',
            'prs_office_id' => 'required|exists:p_r_s_offices,id',
            'report_id'     => 'required|exists:reports,id',
            'answer'        => 'required|string',
            'remark'        => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $answer = PRS_office_answer::create([
            'user_id'       => $request->user_id,
            'prs_office_id' => $request->prs_office_id,
            'report_id'     => $request->report_id,
            'answer'        => $request->answer,
            'remark'        => $request->remark,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Answer saved successfully!',
            'data'    => $answer,
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

    public function ParcelOfficeAnswer(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id'          => 'required|exists:users,id',
            'parcel_office_id' => 'required|exists:parcel__offices,id',
            'report_id'        => 'required|exists:reports,id',
            'answer'           => 'required|string',
            'remark'           => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $answer = Parcel_answer::create([
            'user_id'          => $request->user_id,
            'parcel_office_id' => $request->parcel_office_id,
            'report_id'        => $request->report_id,
            'answer'           => $request->answer,
            'remark'           => $request->remark,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Answer saved successfully!',
            'data'    => $answer,
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

    public function goodsShedOfficeAnswer(Request $request)
    {
        try {
            // Validation
            $validator = Validator::make($request->all(), [
                'user_id'         => 'required|exists:users,id',
                'goods_office_id' => 'required|exists:goods__shed_offices,id',
                'report_id'       => 'required|exists:reports,id',
                'answer'          => 'required|string',
                'remark'          => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors'  => $validator->errors(),
                ], 422);
            }

            $answer = Goods_office_answer::create([
                'user_id'         => $request->user_id,
                'goods_office_id' => $request->goods_office_id,
                'report_id'       => $request->report_id,
                'answer'          => $request->answer,
                'remark'          => $request->remark,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Answer saved successfully!',
                'data'    => $answer,
            ]);
        } catch (\Exception $e) {
            Log::error('Goods Shed Answer Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function ticketexaminerquotionshow()
    {
        $quotations = Ticket_Examineroffice::get();

        return response()->json([
            'success' => true,
            'data'    => $quotations,
        ]);
    }

    public function ticketexaminerquotionAnswer(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'user_id'          => 'required|exists:users,id',
                'ticket_office_id' => 'required|exists:ticket__examineroffices,id',
                'report_id'        => 'required|exists:reports,id',
                'answer'           => 'required|string',
                'remark'           => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors'  => $validator->errors(),
                ], 422);
            }
            $answer = Ticket_office_answer::create([
                'user_id'          => $request->user_id,
                'ticket_office_id' => $request->ticket_office_id,
                'report_id'        => $request->report_id,
                'answer'           => $request->answer,
                'remark'           => $request->remark,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Answer saved successfully!',
                'data'    => $answer,
            ]);
        } catch (\Exception $e) {
            Log::error(' ticketexaminer Answer Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function nonfarequotionshow()
    {
        $quotations = NonFare_Revenue::get();

        return response()->json([
            'success' => true,
            'data'    => $quotations,
        ]);
    }

    public function nonfarequotionanswer(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'user_id'     => 'required|exists:users,id',
                'non_fare_id' => 'required|exists:non_fare__revenues,id',
                'report_id'   => 'required|exists:reports,id',
                'answer'      => 'required|string',
                'remark'      => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors'  => $validator->errors(),
                ], 422);
            }

            $answer = NonFare_Revenue_answer::create([
                'user_id'     => $request->user_id,
                'non_fare_id' => $request->non_fare_id,
                'report_id'   => $request->report_id,
                'answer'      => $request->answer,
                'remark'      => $request->remark,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Answer saved successfully!',
                'data'    => $answer,
            ]);
        } catch (\Exception $e) {
            Log::error('Non Fare Revenue Answer Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function inspectionOfPassengerAmenitiesItems()
    {
        $quotations = InspectionPassenger_items::get();

        return response()->json([
            'success' => true,
            'data'    => $quotations,
        ]);
    }

    public function inspectionOfPassengerAnswer(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'user_id'       => 'required|exists:users,id',
                'inspection_id' => 'required|exists:inspection_passenger_items,id',
                'report_id'     => 'required|exists:reports,id',
                'yes_no'        => 'required|boolean',
                'remark'        => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors'  => $validator->errors(),
                ], 422);
            }
            $answer = InspectionPassenger_items__answer::create([
                'user_id'       => $request->user_id,
                'inspection_id' => $request->inspection_id,
                'report_id'     => $request->report_id,
                'yes_no'        => $request->yes_no,
                'remark'        => $request->remark,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Answer saved successfully!',
                'data'    => $answer,
            ]);
        } catch (\Exception $e) {
            Log::error('Inspection Passenger Items Answer Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function stationCleanlinessProforma()
    {
        $quotations = StationCleanliness::get();

        return response()->json([
            'success' => true,
            'data'    => $quotations,
        ]);
    }

    public function stationCleanlinessAnswer(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'user_id'          => 'required|exists:users,id',
                'station_clean_id' => 'required|exists:station_cleanlinesses,id',
                'report_id'        => 'required|exists:reports,id',
                'answer'           => 'required|string',
                'Black'            => 'nullable|string',
                'Blue'             => 'nullable|string',
                'Green'            => 'nullable|string',
                'remark'           => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors'  => $validator->errors(),
                ], 422);
            }

            $answer = StationCleanliness_answer::create([
                'user_id'          => $request->user_id,
                'station_clean_id' => $request->station_clean_id,
                'report_id'        => $request->report_id,
                'yes_no'           => $request->yes_no,
                'answer'           => $request->answer,
                'remark'           => $request->remark,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Answer saved successfully!',
                'data'    => $answer,
            ]);
        } catch (\Exception $e) {
            Log::error('Station Cleanliness Answer Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function inspectionOfPayAndUseToilets()
    {

        $quotations = InspectionPayUseToilets::get();

        return response()->json([
            'success' => true,
            'data'    => $quotations,
        ]);
    }

    public function inspectionOfPayAndUseToiletsAnswer(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'user_id'                     => 'required|exists:users,id',
                'inspection_pay_id'           => 'required|exists:inspection_pay_use_toilets,id',
                'report_id'                   => 'required|exists:reports,id',
                'Remar_Observations'          => 'required|string',
                'Minor_deficiencies'          => 'required|string',
                'Major_deficiencies_Proposed' => 'required|string',
                'remark'                      => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors'  => $validator->errors(),
                ], 422);
            }

            $answer = InspectionPayUseToilets_answer::create([
                'user_id'                     => $request->user_id,
                'inspection_pay_id'           => $request->inspection_pay_id,
                'report_id'                   => $request->report_id,
                'Remar_Observations'          => $request->Remar_Observations,
                'Minor_deficiencies'          => $request->Minor_deficiencies,
                'Major_deficiencies_Proposed' => $request->Major_deficiencies_Proposed,
                'remark'                      => $request->remark,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Answer saved successfully!',
                'data'    => $answer,
            ]);
        } catch (\Exception $e) {
            Log::error('Inspection Pay and Use Toilets Answer Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function inspectionOfTeaAndLightRefreshmentStall()
    {

        $quotations = INSPECTION_TEA::get();

        return response()->json([
            'success' => true,
            'data'    => $quotations,
        ]);
    }

    public function inspectionTeaAnswer(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'user_id'           => 'required|exists:users,id',
                'inspection_tea_id' => 'required|exists:i_n_s_p_e_c_t_i_o_n__t_e_a_s,id',
                'report_id'         => 'required|exists:reports,id',
                'yes_no'            => 'required|boolean',
                'answer'            => 'required|string',
                'remark'            => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors'  => $validator->errors(),
                ], 422);
            }
            $answer = inspection_tea_answer::create([
                'user_id'           => $request->user_id,
                'inspection_tea_id' => $request->inspection_tea_id,
                'report_id'         => $request->report_id,
                'yes_no'            => $request->yes_no,
                'answer'            => $request->answer,
                'remark'            => $request->remark,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Answer saved successfully!',
                'data'    => $answer,
            ]);
        } catch (\Exception $e) {
            Log::error('Inspection Tea Answer Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function inspectionOfPantryCar()
    {

        $quotations = InspectionPantryCar::get();

        return response()->json([
            'success' => true,
            'data'    => $quotations,
        ]);
    }

    public function inspectionOfPantryCarAnswer(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'user_id'              => 'required|exists:users,id',
                'inspection_pantry_id' => 'required|exists:inspection_pantry_cars,id',
                'report_id'            => 'required|exists:reports,id',
                'answer'               => 'required|string',
                'remark'               => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors'  => $validator->errors(),
                ], 422);
            }

            $answer = InspectionPantryCar_answer::create([
                'user_id'              => $request->user_id,
                'inspection_pantry_id' => $request->inspection_pantry_id,
                'report_id'            => $request->report_id,
                'answer'               => $request->answer,
                'remark'               => $request->remark,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Answer saved successfully!',
                'data'    => $answer,
            ]);
        } catch (\Exception $e) {
            Log::error('Inspection Pantry Car Answer Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function inspectionOfBaseKitchen()
    {

        $quotations = INSPECTIONKITCHEN::get();

        return response()->json([
            'success' => true,
            'data'    => $quotations,
        ]);
    }

    public function inspectionBaseKitchenAnswer(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'user_id'               => 'required|exists:users,id',
                'inspection_kitchen_id' => 'required|exists:i_n_s_p_e_c_t_i_o_n_k_i_t_c_h_e_n_s,id',
                'report_id'             => 'required|exists:reports,id',
                'yes_no'                => 'required|boolean',
                'answer'                => 'required|string',
                'remark'                => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors'  => $validator->errors(),
                ], 422);
            }

            $answer = inspectionkitchen_answer::create([
                'user_id'               => $request->user_id,
                'inspection_kitchen_id' => $request->inspection_kitchen_id,
                'report_id'             => $request->report_id,
                'yes_no'                => $request->yes_no,
                'answer'                => $request->answer,
                'remark'                => $request->remark,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Answer saved successfully!',
                'data'    => $answer,
            ]);
        } catch (\Exception $e) {
            Log::error('Inspection Kitchen Answer Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
