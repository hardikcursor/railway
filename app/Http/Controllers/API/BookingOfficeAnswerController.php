<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking_office;
use App\Models\Booking_office_answer;
use App\Models\Booking_office_form;
use App\Models\Goods_Shed_office;
use App\Models\Goods_Shed_office_form;
use App\Models\INSPECTION_TEA;
use App\Models\INSPECTIONKITCHEN;
use App\Models\InspectionPantryCar;
use App\Models\InspectionPantryCar_form;
use App\Models\InspectionPassenger_items;
use App\Models\InspectionPayUseToilets;
use App\Models\InspectionPayUseToilets_location_form;
use App\Models\NonFare_Revenue;
use App\Models\Parcel_Office;
use App\Models\Parcel_Office_form;
use App\Models\PRS_office;
use App\Models\PRS_office_answer;
use App\Models\PRS_office_form;
use App\Models\Report;
use App\Models\StationCleanliness;
use App\Models\Ticket_Examineroffice;
use App\Models\Ticket_Examineroffice_form;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class BookingOfficeAnswerController extends Controller
{

    public function inspectionstore(Request $request)
    {
        try {
            // Validate the input
            $validated = $request->validate([
                'NameInspector'    => 'required|string|max:255',
                'Station'          => 'required|string|max:255',
                'TypeofInspection' => 'required|string',
                'Duration'         => 'required|string',
                'date'             => 'required|date',
            ], [
                'NameInspector.required'    => 'The name of inspector is required.',
                'Station.required'          => 'The station is required.',
                'TypeofInspection.required' => 'The type of inspection is required.',
                'Duration.required'         => 'The duration is required.',
                'date.required'             => 'The date is required.',
                'date.date'                 => 'The date must be a valid date.',
            ]);

            // Create report
            $report = Report::create([
                'NameInspector'    => $validated['NameInspector'],
                'Station'          => $validated['Station'],
                'TypeofInspection' => $validated['TypeofInspection'],
                'Duration'         => $validated['Duration'],
                'date'             => $validated['date'],
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

//   public function store(Request $request)
// {
//     $validator = Validator::make($request->all(), [
//         'user_id'           => 'required|exists:users,id',
//         'booking_office_id' => 'required|exists:booking_offices,id',
//         'report_id'         => 'required|exists:reports,id',
//         'answer'            => 'required|string',
//         'remark'            => 'nullable|string',
//     ]);

//     if ($validator->fails()) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Validation errors',
//             'errors'  => $validator->errors(),
//         ], 422);
//     }

//     // Save all fields as one JSON blob
//     $answer = Booking_office_answer::create([
//         'data' => $request->all(),
//     ]);

//     return response()->json([
//         'success' => true,
//         'message' => 'Answer saved successfully!',
//         'data'    => $answer,
//     ]);
// }

    public function BookingOfficeDetail(Request $request)
    {
        $request->validate([
            'inspection_id'    => 'required|exists:reports,id',
            'cbs_name'         => 'required|string',
            'no_of_duty_staff' => 'required|string',
            'Sanctioned_Cadre' => 'required|string',
            'Available'        => 'required|string',
            'Vacancy'          => 'required|string',
            'No_of_Counters'   => 'required|string',
            'UTS'              => 'required|string',
            'UTS-cum-PRS'      => 'required|string',
        ]);

        $data = Booking_office_form::create($request->all());

        return response()->json([
            'message' => 'Booking office detail saved successfully',
            'data'    => $data,
        ]);
    }

    public function store(Request $request)
    {
        $userId        = $request->input('user_id');
        $inspection_id = $request->input('inspection_id');
        $allResponses  = $request->input('all_resp');

        if (is_string($allResponses)) {
            $allResponses = json_decode($allResponses, true);
        }

        foreach ($allResponses as $response) {
            DB::table('booking_office_answers')->insert([
                'user_id'             => $userId,
                'inspection_id'       => $inspection_id,
                'booking_question_id' => $response['booking_question_id'],
                'answer'              => $response['answer'],
                'remark'              => $response['remark'],
                'created_at'          => now(),
                'updated_at'          => now(),
            ]);
        }

        return response()->json(['message' => 'Responses saved successfully']);
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

    // This function retrieves all PRS quotations

    public function PrsOfficeDetail(Request $request)
    {
        $request->validate([
            'inspection_id'    => 'required|exists:reports,id',
            'crs_name'         => 'required|string',
            'no_of_duty_staff' => 'required|string',
            'Sanctioned_Cadre' => 'required|string',
            'Available'        => 'required|string',
            'Vacancy'          => 'required|string',
            'No_of_Counters'   => 'required|string',
        ]);

        $data = PRS_office_form::create($request->all());

        return response()->json([
            'message' => 'PRS Office detail saved successfully',
            'data'    => $data,
        ]);
    }
    public function prsgquotionshow()
    {
        $quotations = PRS_office::get();

        return response()->json([
            'success' => true,
            'data'    => $quotations,
        ]);
    }

    // public function prsanswer(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'user_id'       => 'required|exists:users,id',
    //         'prs_office_id' => 'required|exists:p_r_s_offices,id',
    //         'report_id'     => 'required|exists:reports,id',
    //         'answer'        => 'required|string',
    //         'remark'        => 'nullable|string',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Validation errors',
    //             'errors'  => $validator->errors(),
    //         ], 422);
    //     }

    //     $answer = PRS_office_answer::create([
    //         'user_id'       => $request->user_id,
    //         'prs_office_id' => $request->prs_office_id,
    //         'report_id'     => $request->report_id,
    //         'answer'        => $request->answer,
    //         'remark'        => $request->remark,
    //     ]);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Answer saved successfully!',
    //         'data'    => $answer,
    //     ]);
    // }

    public function prsanswer(Request $request)
    {
        $userId        = $request->input('user_id');
        $inspection_id = $request->input('inspection_id');
        $allResponses  = $request->input('all_resp');

        if (is_string($allResponses)) {
            $allResponses = json_decode($allResponses, true);
        }

        foreach ($allResponses as $response) {
            DB::table('p_r_s_office_answers')->insert([
                'user_id'         => $userId,
                'inspection_id'   => $inspection_id,
                'prs_question_id' => $response['prs_question_id'],
                'answer'          => $response['answer'],
                'remark'          => $response['remark'],
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'All answers saved successfully!',

        ]);
    }

    public function ParcelOfficeDetail(Request $request)
    {
        $request->validate([
            'inspection_id'    => 'required|exists:reports,id',
            'cbs_name'         => 'required|string',
            'no_of_duty_staff' => 'required|string',
            'Sanctioned_Cadre' => 'required|string',
            'Available'        => 'required|string',
            'Vacancy_Excess'   => 'required|string',
        ]);

        $data = Parcel_Office_form::create($request->all());

        return response()->json([
            'message' => 'Parcel office detail saved successfully',
            'data'    => $data,
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

        $userId        = $request->input('user_id');
        $inspection_id = $request->input('inspection_id');
        $allResponses  = $request->input('all_resp');

        if (is_string($allResponses)) {
            $allResponses = json_decode($allResponses, true);
        }

        foreach ($allResponses as $response) {
            DB::table('parcel_answers')->insert([
                'user_id'            => $userId,
                'inspection_id'      => $inspection_id,
                'parcel_question_id' => $response['parcel_question_id'],
                'answer'             => $response['answer'],
                'remark'             => $response['remark'],
                'created_at'         => now(),
                'updated_at'         => now(),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Answer saved successfully!',
        ]);
    }

    public function goodshedofficeDetail(Request $request)
    {
        $request->validate([
            'inspection_id'    => 'required|exists:reports,id',
            'cgs_name'         => 'required|string',
            'no_of_duty_staff' => 'required|string',
            'Sanctioned_Cadre' => 'required|string',
            'Available'        => 'required|string',
            'Vacancy_Excess'   => 'required|string',
        ]);

        $data = Goods_Shed_office_form::create($request->all());

        return response()->json([
            'message' => 'Goods shed office detail saved successfully',
            'data'    => $data,
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
            $userId        = $request->input('user_id');
            $inspection_id = $request->input('inspection_id');
            $allResponses  = $request->input('all_resp');

            if (is_string($allResponses)) {
                $allResponses = json_decode($allResponses, true);
            }

            foreach ($allResponses as $response) {
                DB::table('goods_office_answers')->insert([
                    'user_id'           => $userId,
                    'inspection_id'     => $inspection_id,
                    'goods_question_id' => $response['goods_question_id'],
                    'answer'            => $response['answer'],
                    'remark'            => $response['remark'],
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Answer saved successfully!',
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

    public function ticketexaminerDetail(Request $request)
    {
        $request->validate([
            'inspection_id'    => 'required|exists:reports,id',
            'cti_name'         => 'required|string',
            'no_of_duty_staff' => 'required|string',
            'Sanctioned_Cadre' => 'required|string',
            'Available'        => 'required|string',
            'Vacancy_Excess'   => 'required|string',
        ]);

        $data = Ticket_Examineroffice_form::create($request->all());

        return response()->json([
            'message' => 'Ticket examiner office detail saved successfully',
            'data'    => $data,
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

    public function ticketexaminerquotionAnswer(Request $request)
    {
        try {

            $userId        = $request->input('user_id');
            $inspection_id = $request->input('inspection_id');
            $allResponses  = $request->input('all_resp');

            if (is_string($allResponses)) {
                $allResponses = json_decode($allResponses, true);
            }

            foreach ($allResponses as $response) {
                DB::table('ticket_office_answers')->insert([
                    'user_id'            => $userId,
                    'inspection_id'      => $inspection_id,
                    'ticket_question_id' => $response['ticket_question_id'],
                    'answer'             => $response['answer'],
                    'remark'             => $response['remark'],
                    'created_at'         => now(),
                    'updated_at'         => now(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Answer saved successfully!',
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

            $userId        = $request->input('user_id');
            $inspection_id = $request->input('inspection_id');
            $allResponses  = $request->input('all_resp');

            if (is_string($allResponses)) {
                $allResponses = json_decode($allResponses, true);
            }

            foreach ($allResponses as $response) {
                DB::table('non_fare__revenue_answers')->insert([
                    'user_id'             => $userId,
                    'inspection_id'       => $inspection_id,
                    'nonfare_question_id' => $response['nonfare_question_id'],
                    'answer'              => $response['answer'],
                    'remark'              => $response['remark'],
                    'created_at'          => now(),
                    'updated_at'          => now(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Answer saved successfully!',
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

            $userId        = $request->input('user_id');
            $inspection_id = $request->input('inspection_id');
            $allResponses  = $request->input('all_resp');

            if (is_string($allResponses)) {
                $allResponses = json_decode($allResponses, true);
            }

            foreach ($allResponses as $response) {
                DB::table('inspection_passenger_items__answers')->insert([
                    'user_id'                => $userId,
                    'inspection_id'          => $inspection_id,
                    'inspection_question_id' => $response['inspection_question_id'],
                    'yes_no'                 => $response['yes_no'],
                    'remark'                 => $response['remark'],
                    'created_at'             => now(),
                    'updated_at'             => now(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Answer saved successfully!',
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

            $userId        = $request->input('user_id');
            $inspection_id = $request->input('inspection_id');
            $allResponses  = $request->input('all_resp');

            if (is_string($allResponses)) {
                $allResponses = json_decode($allResponses, true);
            }

            foreach ($allResponses as $response) {
                DB::table('station_cleanliness_answers')->insert([
                    'user_id'                  => $userId,
                    'inspection_id'            => $inspection_id,
                    'stationclean_question_id' => $response['stationclean_question_id'],
                    'answer'                   => $response['answer'],
                    'Black'                    => $response['Black'],
                    'Blue'                     => $response['Blue'],
                    'Green'                    => $response['Green'],
                    'remark'                   => $response['remark'],
                    'created_at'               => now(),
                    'updated_at'               => now(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Answer saved successfully!',
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

    public function storeToiletLocation(Request $request)
    {
         $request->validate([
            'inspection_id'  => 'required|exists:reports,id',
            'location'       => 'required|string',
            'Gents'          => 'required|string',
            'Ladies'         => 'required|string',
            'Gents_Urinals'  => 'required|string',
            'Ladies_Urinals' => 'required|string',
            'Divyang'        => 'required|string',
        ]);

        $form = InspectionPayUseToilets_location_form::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Toilet location data saved successfully!',
            'data'    => $form,
        ], 201);
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

            $userId        = $request->input('user_id');
            $inspection_id = $request->input('inspection_id');
            $allResponses  = $request->input('all_resp');

            if (is_string($allResponses)) {
                $allResponses = json_decode($allResponses, true);
            }

            foreach ($allResponses as $response) {
                DB::table('inspection_pay_use_toilets_answers')->insert([
                    'user_id'                     => $userId,
                    'inspection_id'               => $inspection_id,
                    'inspection_pay_question_id'  => $response['inspection_pay_question_id'],
                    'Remar_Observations'          => $response['Remar_Observations'],
                    'Minor_deficiencies'          => $response['Minor_deficiencies'],
                    'Major_deficiencies_Proposed' => $response['Major_deficiencies_Proposed'],
                    'remark'                      => $response['remark'],
                    'created_at'                  => now(),
                    'updated_at'                  => now(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Answer saved successfully!',
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

            $userId        = $request->input('user_id');
            $inspection_id = $request->input('inspection_id');
            $allResponses  = $request->input('all_resp');

            if (is_string($allResponses)) {
                $allResponses = json_decode($allResponses, true);
            }

            $answer = [];
            foreach ($allResponses as $response) {
                $answer[] = DB::table('inspection_tea_answers')->insert([
                    'user_id'                   => $userId,
                    'inspection_id'             => $inspection_id,
                    'inspectiontea_question_id' => $response['inspectiontea_question_id'],
                    'yes_no'                    => $response['yes_no'],
                    'answer'                    => $response['answer'],
                    'remark'                    => $response['remark'],
                    'created_at'                => now(),
                    'updated_at'                => now(),
                ]);
            }

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

    public function inspectionOfPantryCarDetail(Request $request)
    {
        $request->validate([
            'inspection_id'       => 'required|exists:reports,id',
            'train_no'            => 'required|string',
            'train_name'          => 'required|string',
            'inspecting_official' => 'required|string',
            'designation'         => 'required|string',
            'pantry_car_no'       => 'required|string',
            'pantry_car_manager'  => 'required|string',
            'contractor_name'     => 'required|string',
            'irctc_supervisor'    => 'required|string',
        ]);

        $data = InspectionPantryCar_form::create($request->all());

        return response()->json([
            'message' => 'Pantry car detail saved successfully',
            'data'    => $data,
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

    public function inspectionOfPantryCarAnswer(Request $request)
    {
        try {

            $userId        = $request->input('user_id');
            $inspection_id = $request->input('inspection_id');
            $allResponses  = $request->input('all_resp');

            if (is_string($allResponses)) {
                $allResponses = json_decode($allResponses, true);
            }

            $answer = [];
            foreach ($allResponses as $response) {
                $answer[] = DB::table('inspection_pantry_car_answers')->insert([
                    'user_id'                       => $userId,
                    'inspection_id'                 => $inspection_id,
                    'inspection_pantry_question_id' => $response['inspection_pantry_question_id'],
                    'answer'                        => $response['answer'],
                    'remark'                        => $response['remark'],
                    'created_at'                    => now(),
                    'updated_at'                    => now(),
                ]);
            }

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
            $userId        = $request->input('user_id');
            $inspection_id = $request->input('inspection_id');
            $allResponses  = $request->input('all_resp');

            if (is_string($allResponses)) {
                $allResponses = json_decode($allResponses, true);
            }

            $inserted = [];
            foreach ($allResponses as $response) {

                $inserted[] = DB::table('inspectionkitchen_answers')->insert([
                    'user_id'                       => $userId,
                    'inspection_id'                 => $inspection_id,
                    'inspectionkitchen_question_id' => $response['inspectionkitchen_question_id'],
                    'yes_no'                        => $response['yes_no'] ?? null,
                    'answer'                        => $response['answer'] ?? null,
                    'remark'                        => $response['remark'] ?? null,
                    'created_at'                    => now(),
                    'updated_at'                    => now(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Answers saved successfully!',
                'data'    => $inserted,
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
