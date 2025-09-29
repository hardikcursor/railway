<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Station;
use Illuminate\Http\Request;

class stationController extends Controller
{
    public function create() {
           return view('admin.station.create');
    }


}
