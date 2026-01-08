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
use App\Models\PRS_office_form;
use App\Models\Report;
use App\Models\Station;
use App\Models\StationCleanliness;
use App\Models\Ticket_Examineroffice;
use App\Models\Ticket_Examineroffice_form;
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

    public function BookingOfficeDetail(Request $request)
    {
        $validated = $request->validate([
            'inspection_id'    => 'required|exists:reports,id',
            'cbs_name'         => 'required|string',
            'no_of_duty_staff' => 'required|string',
            'Sanctioned_Cadre' => 'required|string',
            'Available'        => 'required|string',
            'Vacancy'          => 'required|string',
            'UTS'              => 'required|string',
            'PRS'              => 'required|string',
            'UTS_PRS'          => 'required|string',
        ]);

        $data = Booking_office_form::create($validated);

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

        if (! is_array($allResponses)) {
            return response()->json(['error' => 'Invalid all_resp format'], 422);
        }

        foreach ($allResponses as $response) {
            $imagePath = null;

            if (! empty($response['image_path'])) {
                $base64Image = $response['image_path'];

                // Remove prefix (e.g., "data:image/jpeg;base64,")
                if (strpos($base64Image, 'base64,') !== false) {
                    $base64Image = explode('base64,', $base64Image)[1];
                }

                $base64Image = str_replace(' ', '+', $base64Image);
                $imageData   = base64_decode($base64Image);

                if ($imageData !== false) {
                    $folderPath = public_path('uploads/booking_answers');
                    if (! file_exists($folderPath)) {
                        mkdir($folderPath, 0775, true);
                    }

                    // Detect file extension from mime type
                    $extension = $this->getImageExtension($response['image_path']);
                    $imageName = 'booking_' . $userId . '_' . time() . '_' . uniqid() . '.' . $extension;

                    file_put_contents($folderPath . '/' . $imageName, $imageData);

                    // Save relative path for DB
                    $imagePath = 'uploads/booking_answers/' . $imageName;
                }
            }

            DB::table('booking_office_answers')->insert([
                'user_id'             => $userId,
                'inspection_id'       => $inspection_id,
                'booking_question_id' => $response['booking_question_id'],
                'answer'              => $response['answer'],
                'remark'              => $response['remark'],
                'image_path'          => $imagePath,
                'created_at'          => now(),
                'updated_at'          => now(),
            ]);
        }

        return response()->json(['message' => 'Responses saved successfully']);
    }

    private function getImageExtension($base64String)
    {
        if (preg_match('/^data:image\/(\w+);base64,/', $base64String, $matches)) {
            return strtolower($matches[1]); // jpg, png, bmp
        }
        return 'jpg'; // default
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
    //     $userId        = $request->input('user_id');
    //     $inspection_id = $request->input('inspection_id');
    //     $allResponses  = $request->input('all_resp');

    //     if (is_string($allResponses)) {
    //         $allResponses = json_decode($allResponses, true);
    //     }

    //     foreach ($allResponses as $response) {
    //         DB::table('p_r_s_office_answers')->insert([
    //             'user_id'         => $userId,
    //             'inspection_id'   => $inspection_id,
    //             'prs_question_id' => $response['prs_question_id'],
    //             'answer'          => $response['answer'],
    //             'remark'          => $response['remark'],
    //             'created_at'      => now(),
    //             'updated_at'      => now(),
    //         ]);
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'All answers saved successfully!',

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
            $imagePath = null;

            if (! empty($response['image_path'])) {
                $base64Image = $response['image_path'];

                if (strpos($base64Image, 'base64,') !== false) {
                    $base64Image = explode('base64,', $base64Image)[1];
                }

                $base64Image = str_replace(' ', '+', $base64Image);
                $imageData   = base64_decode($base64Image);

                if ($imageData !== false) {
                    $folderPath = public_path('uploads/prs_answers');
                    if (! file_exists($folderPath)) {
                        mkdir($folderPath, 0775, true);
                    }

                    $extension = $this->getImageExtension($response['image_path']);
                    $imageName = 'prs_' . $userId . '_' . time() . '_' . uniqid() . '.' . $extension;

                    file_put_contents($folderPath . '/' . $imageName, $imageData);

                    $imagePath = 'uploads/prs_answers/' . $imageName;
                }
            }

            DB::table('p_r_s_office_answers')->insert([
                'user_id'         => $userId,
                'inspection_id'   => $inspection_id,
                'prs_question_id' => $response['prs_question_id'],
                'answer'          => $response['answer'],
                'remark'          => $response['remark'],
                'image_path'      => $imagePath,
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

        // decode JSON string to array
        if (is_string($allResponses)) {
            $allResponses = json_decode($allResponses, true);
        }

        // check if valid array
        if (! is_array($allResponses) || empty($allResponses)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or empty all_resp provided.',
            ], 422);
        }

        foreach ($allResponses as $response) {
            $imagePath = null;

            // handle image upload
            if (! empty($response['image_path'])) {
                $base64Image = $response['image_path'];

                // remove prefix if exists
                if (strpos($base64Image, 'base64,') !== false) {
                    $base64Image = explode('base64,', $base64Image)[1];
                }

                $base64Image = str_replace(' ', '+', $base64Image);
                $imageData   = base64_decode($base64Image);

                if ($imageData !== false) {
                    $folderPath = public_path('uploads/parcel_answers');
                    if (! file_exists($folderPath)) {
                        mkdir($folderPath, 0775, true);
                    }

                    // detect extension
                    $extension = 'jpg';
                    if (preg_match('/^data:image\/(\w+);base64,/', $response['image_path'], $matches)) {
                        $extension = strtolower($matches[1]);
                    }

                    $imageName = 'parcel_' . $userId . '_' . time() . '_' . uniqid() . '.' . $extension;
                    file_put_contents($folderPath . '/' . $imageName, $imageData);

                    $imagePath = 'uploads/parcel_answers/' . $imageName;
                }
            }

            // save answer
            DB::table('parcel_answers')->insert([
                'user_id'            => $userId,
                'inspection_id'      => $inspection_id,
                'parcel_question_id' => $response['parcel_question_id'] ?? null,
                'answer'             => $response['answer'] ?? null,
                'remark'             => $response['remark'] ?? null,
                'image_path'         => $imagePath,
                'created_at'         => now(),
                'updated_at'         => now(),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Parcel answers saved successfully!',
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

            if (! is_array($allResponses) || empty($allResponses)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid or empty all_resp provided.',
                ], 422);
            }

            foreach ($allResponses as $response) {
                $imagePath = null;

                // image upload handle
                if (! empty($response['image_path'])) {
                    $base64Image = $response['image_path'];

                    // remove base64 prefix if exists
                    if (strpos($base64Image, 'base64,') !== false) {
                        $base64Image = explode('base64,', $base64Image)[1];
                    }

                    $base64Image = str_replace(' ', '+', $base64Image);
                    $imageData   = base64_decode($base64Image);

                    if ($imageData !== false) {
                        $folderPath = public_path('uploads/goods_office_answers');
                        if (! file_exists($folderPath)) {
                            mkdir($folderPath, 0775, true);
                        }

                        // detect extension
                        $extension = 'jpg';
                        if (preg_match('/^data:image\/(\w+);base64,/', $response['image_path'], $matches)) {
                            $extension = strtolower($matches[1]);
                        }

                        $imageName = 'goods_' . $userId . '_' . time() . '_' . uniqid() . '.' . $extension;
                        file_put_contents($folderPath . '/' . $imageName, $imageData);

                        $imagePath = 'uploads/goods_office_answers/' . $imageName;
                    }
                }

                DB::table('goods_office_answers')->insert([
                    'user_id'           => $userId,
                    'inspection_id'     => $inspection_id,
                    'goods_question_id' => $response['goods_question_id'] ?? null,
                    'answer'            => $response['answer'] ?? null,
                    'remark'            => $response['remark'] ?? null,
                    'image_path'        => $imagePath,
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Goods Shed answers saved successfully!',
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

            if (! is_array($allResponses) || empty($allResponses)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid or empty all_resp provided.',
                ], 422);
            }

            foreach ($allResponses as $response) {
                $imagePath = null;

                // Handle image if provided
                if (! empty($response['image_path'])) {
                    $base64Image = $response['image_path'];

                    // remove base64 prefix if exists
                    if (strpos($base64Image, 'base64,') !== false) {
                        $base64Image = explode('base64,', $base64Image)[1];
                    }

                    $base64Image = str_replace(' ', '+', $base64Image);
                    $imageData   = base64_decode($base64Image);

                    if ($imageData !== false) {
                        $folderPath = public_path('uploads/ticket_office_answers');
                        if (! file_exists($folderPath)) {
                            mkdir($folderPath, 0775, true);
                        }

                        // detect extension
                        $extension = 'jpg';
                        if (preg_match('/^data:image\/(\w+);base64,/', $response['image_path'], $matches)) {
                            $extension = strtolower($matches[1]);
                        }

                        $imageName = 'ticket_' . $userId . '_' . time() . '_' . uniqid() . '.' . $extension;
                        file_put_contents($folderPath . '/' . $imageName, $imageData);

                        $imagePath = 'uploads/ticket_office_answers/' . $imageName;
                    }
                }

                DB::table('ticket_office_answers')->insert([
                    'user_id'            => $userId,
                    'inspection_id'      => $inspection_id,
                    'ticket_question_id' => $response['ticket_question_id'] ?? null,
                    'answer'             => $response['answer'] ?? null,
                    'remark'             => $response['remark'] ?? null,
                    'image_path'         => $imagePath,
                    'created_at'         => now(),
                    'updated_at'         => now(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Ticket Examiner answers saved successfully!',
            ]);
        } catch (\Exception $e) {
            Log::error('Ticket Examiner Answer Error: ' . $e->getMessage());

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

            if (! is_array($allResponses) || empty($allResponses)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid or empty all_resp provided.',
                ], 422);
            }

            foreach ($allResponses as $response) {
                $imagePath = null;

                // Handle image if provided
                if (! empty($response['image_path'])) {
                    $base64Image = $response['image_path'];

                    // Remove base64 prefix if exists
                    if (strpos($base64Image, 'base64,') !== false) {
                        $base64Image = explode('base64,', $base64Image)[1];
                    }

                    $base64Image = str_replace(' ', '+', $base64Image);
                    $imageData   = base64_decode($base64Image);

                    if ($imageData !== false) {
                        $folderPath = public_path('uploads/nonfare_office_answers');
                        if (! file_exists($folderPath)) {
                            mkdir($folderPath, 0775, true);
                        }

                        // Detect extension
                        $extension = 'jpg';
                        if (preg_match('/^data:image\/(\w+);base64,/', $response['image_path'], $matches)) {
                            $extension = strtolower($matches[1]);
                        }

                        $imageName = 'nonfare_' . $userId . '_' . time() . '_' . uniqid() . '.' . $extension;
                        file_put_contents($folderPath . '/' . $imageName, $imageData);

                        $imagePath = 'uploads/nonfare_office_answers/' . $imageName;
                    }
                }

                DB::table('non_fare__revenue_answers')->insert([
                    'user_id'             => $userId,
                    'inspection_id'       => $inspection_id,
                    'nonfare_question_id' => $response['nonfare_question_id'] ?? null,
                    'answer'              => $response['answer'] ?? null,
                    'remark'              => $response['remark'] ?? null,
                    'image_path'          => $imagePath,
                    'created_at'          => now(),
                    'updated_at'          => now(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Non Fare Revenue answers saved successfully!',
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

            if (! is_array($allResponses) || empty($allResponses)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid or empty all_resp provided.',
                ], 422);
            }

            foreach ($allResponses as $response) {
                $imagePath = null;

                // Image handle
                if (! empty($response['image_path'])) {
                    $base64Image = $response['image_path'];

                    // remove base64 prefix if exists
                    if (strpos($base64Image, 'base64,') !== false) {
                        $base64Image = explode('base64,', $base64Image)[1];
                    }

                    $base64Image = str_replace(' ', '+', $base64Image);
                    $imageData   = base64_decode($base64Image);

                    if ($imageData !== false) {
                        $folderPath = public_path('uploads/inspection_passenger_answers');
                        if (! file_exists($folderPath)) {
                            mkdir($folderPath, 0775, true);
                        }

                        // Detect extension
                        $extension = 'jpg';
                        if (preg_match('/^data:image\/(\w+);base64,/', $response['image_path'], $matches)) {
                            $extension = strtolower($matches[1]);
                        }

                        $imageName = 'passenger_' . $userId . '_' . time() . '_' . uniqid() . '.' . $extension;
                        file_put_contents($folderPath . '/' . $imageName, $imageData);

                        $imagePath = 'uploads/inspection_passenger_answers/' . $imageName;
                    }
                }

                DB::table('inspection_passenger_items__answers')->insert([
                    'user_id'                => $userId,
                    'inspection_id'          => $inspection_id,
                    'inspection_question_id' => $response['inspection_question_id'] ?? null,
                    'yes_no'                 => $response['yes_no'] ?? null,
                    'remark'                 => $response['remark'] ?? null,
                    'image_path'             => $imagePath,
                    'created_at'             => now(),
                    'updated_at'             => now(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Passenger inspection answers saved successfully!',
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

            if (! is_array($allResponses) || empty($allResponses)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid or empty all_resp provided.',
                ], 422);
            }

            foreach ($allResponses as $response) {
                $imagePath = null;

                // ✅ Handle Image Upload (Base64 or File Path)
                if (! empty($response['image_path'])) {
                    $base64Image = $response['image_path'];

                    // Remove base64 prefix if exists
                    if (strpos($base64Image, 'base64,') !== false) {
                        $base64Image = explode('base64,', $base64Image)[1];
                    }

                    $base64Image = str_replace(' ', '+', $base64Image);
                    $imageData   = base64_decode($base64Image);

                    if ($imageData !== false) {
                        $folderPath = public_path('uploads/station_cleanliness_answers');
                        if (! file_exists($folderPath)) {
                            mkdir($folderPath, 0775, true);
                        }

                        // Detect extension (default jpg)
                        $extension = 'jpg';
                        if (preg_match('/^data:image\/(\w+);base64,/', $response['image_path'], $matches)) {
                            $extension = strtolower($matches[1]);
                        }

                        $imageName = 'station_' . $userId . '_' . time() . '_' . uniqid() . '.' . $extension;
                        file_put_contents($folderPath . '/' . $imageName, $imageData);

                        $imagePath = 'uploads/station_cleanliness_answers/' . $imageName;
                    }
                }

                DB::table('station_cleanliness_answers')->insert([
                    'user_id'                  => $userId,
                    'inspection_id'            => $inspection_id,
                    'stationclean_question_id' => $response['stationclean_question_id'] ?? null,
                    'answer'                   => $response['answer'] ?? null,
                    'Black'                    => $response['Black'] ?? null,
                    'Blue'                     => $response['Blue'] ?? null,
                    'Green'                    => $response['Green'] ?? null,
                    'remark'                   => $response['remark'] ?? null,
                    'image_path'               => $imagePath, // ✅ Store Image Path
                    'created_at'               => now(),
                    'updated_at'               => now(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Station cleanliness answers saved successfully!',
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

            if (! is_array($allResponses) || empty($allResponses)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid or empty all_resp provided.',
                ], 422);
            }

            foreach ($allResponses as $response) {
                $imagePath = null;

                // ✅ Handle Image Upload (Base64 or File Path)
                if (! empty($response['image_path'])) {
                    $base64Image = $response['image_path'];

                    // Remove base64 prefix if exists
                    if (strpos($base64Image, 'base64,') !== false) {
                        $base64Image = explode('base64,', $base64Image)[1];
                    }

                    $base64Image = str_replace(' ', '+', $base64Image);
                    $imageData   = base64_decode($base64Image);

                    if ($imageData !== false) {
                        $folderPath = public_path('uploads/inspection_pay_use_toilets');
                        if (! file_exists($folderPath)) {
                            mkdir($folderPath, 0775, true);
                        }

                        // Detect extension (default jpg)
                        $extension = 'jpg';
                        if (preg_match('/^data:image\/(\w+);base64,/', $response['image_path'], $matches)) {
                            $extension = strtolower($matches[1]);
                        }

                        $imageName = 'toilet_' . $userId . '_' . time() . '_' . uniqid() . '.' . $extension;
                        file_put_contents($folderPath . '/' . $imageName, $imageData);

                        $imagePath = 'uploads/inspection_pay_use_toilets/' . $imageName;
                    }
                }

                DB::table('inspection_pay_use_toilets_answers')->insert([
                    'user_id'                     => $userId,
                    'inspection_id'               => $inspection_id,
                    'inspection_pay_question_id'  => $response['inspection_pay_question_id'] ?? null,
                    'Remar_Observations'          => $response['Remar_Observations'] ?? null,
                    'Minor_deficiencies'          => $response['Minor_deficiencies'] ?? null,
                    'Major_deficiencies_Proposed' => $response['Major_deficiencies_Proposed'] ?? null,
                    'remark'                      => $response['remark'] ?? null,
                    'image_path'                  => $imagePath, // ✅ Store Image Path
                    'created_at'                  => now(),
                    'updated_at'                  => now(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Inspection of Pay & Use Toilets answers saved successfully!',
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

            if (! is_array($allResponses) || empty($allResponses)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid or empty all_resp provided.',
                ], 422);
            }

            $answer = [];
            foreach ($allResponses as $response) {
                $imagePath = null;

                // ✅ Handle Image Upload (Base64 or file path)
                if (! empty($response['image_path'])) {
                    $base64Image = $response['image_path'];

                    // Remove base64 prefix if exists
                    if (strpos($base64Image, 'base64,') !== false) {
                        $base64Image = explode('base64,', $base64Image)[1];
                    }

                    $base64Image = str_replace(' ', '+', $base64Image);
                    $imageData   = base64_decode($base64Image);

                    if ($imageData !== false) {
                        $folderPath = public_path('uploads/inspection_tea');
                        if (! file_exists($folderPath)) {
                            mkdir($folderPath, 0775, true);
                        }

                        // Detect extension (default jpg)
                        $extension = 'jpg';
                        if (preg_match('/^data:image\/(\w+);base64,/', $response['image_path'], $matches)) {
                            $extension = strtolower($matches[1]);
                        }

                        $imageName = 'tea_' . $userId . '_' . time() . '_' . uniqid() . '.' . $extension;
                        file_put_contents($folderPath . '/' . $imageName, $imageData);

                        $imagePath = 'uploads/inspection_tea/' . $imageName;
                    }
                }

                $answer[] = DB::table('inspection_tea_answers')->insert([
                    'user_id'                   => $userId,
                    'inspection_id'             => $inspection_id,
                    'inspectiontea_question_id' => $response['inspectiontea_question_id'] ?? null,
                    'yes_no'                    => $response['yes_no'] ?? null,
                    'answer'                    => $response['answer'] ?? null,
                    'remark'                    => $response['remark'] ?? null,
                    'image_path'                => $imagePath, // ✅ store image path
                    'created_at'                => now(),
                    'updated_at'                => now(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Inspection Tea answers saved successfully!',
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

    public function inspectionOfPantryCarAnswer(Request $request)
    {
        try {
            $userId        = $request->input('user_id');
            $inspection_id = $request->input('inspection_id');
            $allResponses  = $request->input('all_resp');

            if (is_string($allResponses)) {
                $allResponses = json_decode($allResponses, true);
            }

            if (! is_array($allResponses) || empty($allResponses)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid or empty all_resp provided.',
                ], 422);
            }

            $answer = [];
            foreach ($allResponses as $response) {
                $imagePath = null;

                // ✅ Handle Image Upload (Base64 support)
                if (! empty($response['image_path'])) {
                    $base64Image = $response['image_path'];

                    // Remove base64 prefix if exists
                    if (strpos($base64Image, 'base64,') !== false) {
                        $base64Image = explode('base64,', $base64Image)[1];
                    }

                    $base64Image = str_replace(' ', '+', $base64Image);
                    $imageData   = base64_decode($base64Image);

                    if ($imageData !== false) {
                        $folderPath = public_path('uploads/inspection_pantry_car');
                        if (! file_exists($folderPath)) {
                            mkdir($folderPath, 0775, true);
                        }

                        // Detect extension (default jpg)
                        $extension = 'jpg';
                        if (preg_match('/^data:image\/(\w+);base64,/', $response['image_path'], $matches)) {
                            $extension = strtolower($matches[1]);
                        }

                        $imageName = 'pantry_' . $userId . '_' . time() . '_' . uniqid() . '.' . $extension;
                        file_put_contents($folderPath . '/' . $imageName, $imageData);

                        $imagePath = 'uploads/inspection_pantry_car/' . $imageName;
                    }
                }

                $answer[] = DB::table('inspection_pantry_car_answers')->insert([
                    'user_id'                       => $userId,
                    'inspection_id'                 => $inspection_id,
                    'inspection_pantry_question_id' => $response['inspection_pantry_question_id'] ?? null,
                    'answer'                        => $response['answer'] ?? null,
                    'remark'                        => $response['remark'] ?? null,
                    'image_path'                    => $imagePath, // ✅ image path stored
                    'created_at'                    => now(),
                    'updated_at'                    => now(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Inspection Pantry Car answers saved successfully!',
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

            if (! is_array($allResponses) || empty($allResponses)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid or empty all_resp provided.',
                ], 422);
            }

            $inserted = [];
            foreach ($allResponses as $response) {
                $imagePath = null;

                if (! empty($response['image_path'])) {
                    $base64Image = $response['image_path'];

                    // Remove base64 prefix if exists
                    if (strpos($base64Image, 'base64,') !== false) {
                        $base64Image = explode('base64,', $base64Image)[1];
                    }

                    $base64Image = str_replace(' ', '+', $base64Image);
                    $imageData   = base64_decode($base64Image);

                    if ($imageData !== false) {
                        $folderPath = public_path('uploads/inspection_base_kitchen');
                        if (! file_exists($folderPath)) {
                            mkdir($folderPath, 0775, true);
                        }

                        // Detect extension (default jpg)
                        $extension = 'jpg';
                        if (preg_match('/^data:image\/(\w+);base64,/', $response['image_path'], $matches)) {
                            $extension = strtolower($matches[1]);
                        }

                        $imageName = 'base_kitchen_' . $userId . '_' . time() . '_' . uniqid() . '.' . $extension;
                        file_put_contents($folderPath . '/' . $imageName, $imageData);

                        $imagePath = 'uploads/inspection_base_kitchen/' . $imageName;
                    }
                }

                $inserted[] = DB::table('inspectionkitchen_answers')->insert([
                    'user_id'                       => $userId,
                    'inspection_id'                 => $inspection_id,
                    'inspectionkitchen_question_id' => $response['inspectionkitchen_question_id'] ?? null,
                    'yes_no'                        => $response['yes_no'] ?? null,
                    'answer'                        => $response['answer'] ?? null,
                    'remark'                        => $response['remark'] ?? null,
                    'image_path'                    => $imagePath, // ✅ image path stored
                    'created_at'                    => now(),
                    'updated_at'                    => now(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Inspection Base Kitchen answers saved successfully!',
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


      public function getstations()
    {
        $stations = Station::orderBy('station', 'asc')->get();

        if ($stations->isEmpty()) {
            return response()->json([
                'status'  => false,
                'message' => 'No stations found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'count'  => $stations->count(),
            'data'   => $stations,
        ], 200);
    }

}
