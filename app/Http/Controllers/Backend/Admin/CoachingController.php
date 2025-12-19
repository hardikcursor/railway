<?php
namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Imports\CoachingImport;
use App\Models\Coaching;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\FlareClient\View;

class CoachingController extends Controller
{
    public function coaching()
    {
        return view('admin.coachingexcel');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls',
        ]);

        Excel::import(new CoachingImport, $request->file('file'));

        return redirect()->route('admin.coaching')->with('success', 'Coaching data imported successfully.');
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
            'total_passengers'      => 'required|numeric',
            'total_earning'         => 'required|numeric',
            'date'                  => 'required|date',
            'file'                  => 'required|mimes:xls,xlsx,csv',
        ]);
        Coaching::create([
            'name'                  => $request->name,
            'station_name'          => $request->station_name,
            'unreserved_passengers' => $request->unreserved_passengers,
            'unreserved_earning'    => $request->unreserved_earning,
            'reserved_passengers'   => $request->reserved_passengers,
            'reserved_earning'      => $request->reserved_earning,
            'total_passengers'      => $request->total_passengers,
            'total_earning'         => $request->total_earning,
            'date'                  => $request->date,
        ]);

        return redirect()->route('admin.coaching')->with('success', 'Coaching data imported successfully.');
    }
}
