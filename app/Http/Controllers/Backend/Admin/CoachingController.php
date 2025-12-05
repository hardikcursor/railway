<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\CoachingImport;
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

        return back()->with('success', 'Excel Imported Successfully');
    }
}
