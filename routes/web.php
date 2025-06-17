<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\Admin\AdminDashboardController;
use App\Http\Controllers\Backend\Superadmin\SuperadminDashboardController;
use App\Http\Controllers\Backend\User\UserDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;






/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'dologin'])->name('dologin');



Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'dologin'])->name('dologin');
});


Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::middleware(['auth', 'role:super-admin'])->group(function () {
    Route::get('/superadmin/dashboard', [SuperadminDashboardController::class, 'index'])->name('superadmin.dashboard');
    Route::get('/admin/onemonth', [SuperadminDashboardController::class, 'onemonth'])->name('superadmin.report.onemonth');
    Route::get('/admin/thirdmonth', [SuperadminDashboardController::class, 'secondmonth'])->name('superadmin.report.thirdmonth');
    Route::get('/admin/sixmonth', [SuperadminDashboardController::class, 'thirdmonth'])->name('superadmin.report.sixmonth');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/one-month', [AdminDashboardController::class, 'onemonth'])->name('admin.report.onemonth');
    Route::get('/admin/three-month', [AdminDashboardController::class, 'secondmonth'])->name('admin.report.threemonth');
    Route::get('/admin/six-month', [AdminDashboardController::class, 'thirdmonth'])->name('admin.report.sixmonth');
    Route::post('/record/{id}/send', [AdminDashboardController::class, 'send'])->name('admin.sendToAdmin');
    Route::get('/adminreports/{id}/download', [AdminDashboardController::class, 'downloadReport'])->name('admin.reports.download');



});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/user/onemonth', [UserDashboardController::class, 'onemonth'])->name('user.report.onemonth');
    Route::get('/user/thirdmonth', [UserDashboardController::class, 'secondmonth'])->name('user.report.thirdmonth');
    Route::get('/user/sixmonth', [UserDashboardController::class, 'thirdmonth'])->name('user.report.sixmonth');
    Route::get('/daily-report', [UserDashboardController::class, 'dailyReport'])->name('daily.report');
    Route::get('/frightdashboard', [UserDashboardController::class, 'frightdashboard'])->name('user.frightdashboard');
    Route::get('/user/form', [UserDashboardController::class, 'form'])->name('user.form');
    Route::post('/record', [UserDashboardController::class, 'store'])->name('user.store');
    Route::post('/record/{id}/approval', [UserDashboardController::class, 'sendtoapproved'])->name('admin.approval');
    Route::post('/record/{id}/send-to-admin', [UserDashboardController::class, 'sendToAdmin'])->name('posts.sendToAdmin');
    Route::get('/reports/{id}/download', [UserDashboardController::class, 'downloadReport'])->name('reports.download');
    Route::get('/user/search', [UserDashboardController::class, 'isearch'])->name('reports.index');
    Route::post('/import', [UserDashboardController::class, 'import'])->name('user.import');
    Route::get('/getuser', [UserDashboardController::class, 'userdataget'])->name('user.userdataget');
    Route::post('/chengestatus',[UserDashboardController::class,'changestatus'])->name('user.chnageStatus');


});


Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});


Route::get('/redirect-dashboard', function () {



    
    if (Auth::check()) {
        if (Auth::user()->hasRole('super-admin')) {
            return redirect()->route('superadmin.dashboard');
        } elseif (Auth::user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->hasRole('user')) {
            return redirect()->route('user.dashboard');
        } else {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }
    }
    return redirect()->route('login');
})->name('redirect.dashboard');
