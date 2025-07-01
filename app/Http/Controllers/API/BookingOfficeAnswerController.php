<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking_office;
use App\Models\Booking_office_answer;
use Illuminate\Http\Request;

class BookingOfficeAnswerController extends Controller
{
     public function store(Request $request)
    {
        $request->validate([
            'booking_office_id' => 'required|exists:booking_offices,id',
            'remarks' => 'required|string',
        ]);

     

        $answer = new Booking_office_answer();
        $answer->booking_office_id = $request->booking_office_id;
        $answer->remarks = $request->remarks;
        $answer->save();

        return response()->json([
            'success' => true,
            'message' => 'Answer saved successfully!',
            'data' => $answer,
        ]);
    }
    
     public function index()
    {
        $answers = Booking_office_answer::with('bookingOffice')->get();

        return response()->json([
            'success' => true,
            'data' => $answers,
        ]);
    }

    public function bookingquotionshow()
    {
        $quotations = Booking_office::get();

        return response()->json([
            'success' => true,
            'data' => $quotations,
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
}
