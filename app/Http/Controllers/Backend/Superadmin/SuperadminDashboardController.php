<?php

namespace App\Http\Controllers\Backend\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuperadminDashboardController extends Controller
{
    public function index()
    {
        return view('superadmin.dashboard');
    }

    public function onemonth()
    {
        return view('superadmin.report.1month');
    }

    public function secondmonth()
    {
        return view('superadmin.report.3month');
    }

    public function thirdmonth()
    {
        return view('superadmin.report.6month');
    }
}
