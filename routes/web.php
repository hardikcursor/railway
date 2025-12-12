<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\Admin\AdminDashboardController;
use App\Http\Controllers\Backend\Admin\CoachingController;
use App\Http\Controllers\Backend\Superadmin\SuperadminDashboardController;
use App\Http\Controllers\Backend\User\UserDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'dologin'])->name('dologin');

    // Show forgot password form
    Route::get('forget-password', [AuthController::class, 'showForgetPasswordForm'])->name('forget.password.get');

    Route::post('forget-password', [AuthController::class, 'submitForgetPasswordForm'])->name('forget.password.post');

    Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('reset.password.get');

    Route::post('reset-password', [AuthController::class, 'submitResetPasswordForm'])->name('reset.password.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'role:super-admin'])->group(function () {
    Route::get('/superadmin/admindashboard', [SuperadminDashboardController::class, 'admindashboard'])->name('superadmin.admindashboard');
    Route::get('/superadmin/dashboard', [SuperadminDashboardController::class, 'index'])->name('superadmin.dashboard');
    Route::get('/admin/onemonth', [SuperadminDashboardController::class, 'onemonth'])->name('superadmin.report.onemonth');
    Route::get('/admin/thirdmonth', [SuperadminDashboardController::class, 'secondmonth'])->name('superadmin.report.thirdmonth');
    Route::get('/admin/sixmonth', [SuperadminDashboardController::class, 'thirdmonth'])->name('superadmin.report.sixmonth');
    Route::post('/superadmin/record/{id}/approval', [SuperadminDashboardController::class, 'sendtoapproved'])->name('superadmin.approval');
    Route::get('/superadmin/reports/{id}/download', [SuperadminDashboardController::class, 'downloadReport'])->name('superadmin.reports.download');
    Route::get('/getuser', [SuperadminDashboardController::class, 'userdataget'])->name('superadmin.userdataget');
    Route::post('/chengestatus', [SuperadminDashboardController::class, 'changestatus'])->name('admin.chnageStatus');
    Route::get('/superadmin/freightdashboard', [SuperadminDashboardController::class, 'freightdashboard'])->name('superadmin.freightdashboard');
    Route::get('/superadmin/coachingdashboard', [SuperadminDashboardController::class, 'coachingdashboard'])->name('superadmin.coachingdashboard');
        Route::get('/superadmin/parceldashboard', [SuperadminDashboardController::class, 'parceldashboard'])->name('superadmin.parceldashboard');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    Route::get('/admin/payparkdashboard', [AdminDashboardController::class, 'payparkdashboard'])->name('admin.payparkdashboard');
    Route::get('/admin/cateringdashboard', [AdminDashboardController::class, 'cateringdashboard'])->name('admin.cateringdashboard');
    Route::get('/admin/cleaningdashboard', [AdminDashboardController::class, 'cleaningdashboard'])->name('admin.cleaningdashboard');
    Route::get('/admin/one-month', [AdminDashboardController::class, 'onemonth'])->name('admin.report.onemonth');
    Route::get('/admin/three-month', [AdminDashboardController::class, 'secondmonth'])->name('admin.report.threemonth');
    Route::get('/admin/six-month', [AdminDashboardController::class, 'thirdmonth'])->name('admin.report.sixmonth');
    Route::post('/record/{id}/send', [AdminDashboardController::class, 'send'])->name('admin.sendToAdmin');
    Route::get('/adminreports/{id}/download', [AdminDashboardController::class, 'downloadReport'])->name('admin.reports.download');
    Route::post('/record/{id}/approve', [AdminDashboardController::class, 'sendToApprove'])->name('admin.sendToApprove');
    Route::get('/admin/generate-report', [AdminDashboardController::class, 'generatereport'])->name('admin.generateReport');
    Route::get('/admin/quotationshow', [AdminDashboardController::class, 'quotationshow'])->name('admin.quotationshow');
    Route::get('/admin/quotation/delete/{model}/{id}', [AdminDashboardController::class, 'remove'])->name('admin.quotation.delete');
    Route::post('/user/savequotationreport', [AdminDashboardController::class, 'savequotationreport'])->name('admin.savequotationreport');
    Route::post('/PRSanswer', [AdminDashboardController::class, 'prsSaveQuotationReport'])->name('admin.PRSanswer.store');
    Route::post('/Parcelanswer', [AdminDashboardController::class, 'parcelSaveQuotationReport'])->name('admin.Parcelanswer.store');
    Route::post('/GoodsShedanswer', [AdminDashboardController::class, 'goodsSaveQuotationReport'])->name('admin.GoodsShedanswer.store');
    Route::post('/TicketExamineranswer', [AdminDashboardController::class, 'ticketSaveQuotationReport'])->name('admin.TicketExamineranswer.store');
    Route::post('/nonfareanswer', [AdminDashboardController::class, 'nonfareSaveQuotationReport'])->name('admin.nonfareanswer.store');
    Route::post('/inspectionpassengeranswer', [AdminDashboardController::class, 'inspectionPassengerSaveQuotationReport'])->name('admin.inspectionpassengeranswer.store');
    Route::post('/stationcleanlinessanswer', [AdminDashboardController::class, 'stationCleanlinessSaveQuotationReport'])->name('admin.stationcleanlinessanswer.store');
    Route::post('/inspectionpayuseanswer', [AdminDashboardController::class, 'inspectionPayUseSaveQuotationReport'])->name('admin.inspectionpayuseanswer.store');
    Route::post('/inspectionteaanswer', [AdminDashboardController::class, 'inspectionTeaRefreshmentSaveQuotationReport'])->name('admin.inspectionteaanswer.store');
    Route::post('/inspectionpantrycaranswer', [AdminDashboardController::class, 'inspectionPantryCarSaveQuotationReport'])->name('admin.inspectionpantrycaranswer.store');
    Route::post('/inspectionkitchenanswer', [AdminDashboardController::class, 'inspectionKitchenSaveQuotationReport'])->name('admin.inspectionkitchenanswer.store');
    Route::get('/quotation/edit/{model}/{id}', [AdminDashboardController::class, 'edit'])->name('admin.quotation.edit');
    Route::post('/quotation/update/{model}/{id}', [AdminDashboardController::class, 'update'])->name('admin.quotation.update');
    Route::get('/stationcreate', [AdminDashboardController::class, 'station'])->name('admin.station.create');
    Route::post('stationstore', [AdminDashboardController::class, 'storestation'])->name('admin.station.store');
    Route::get('stations/{id}/edit', [AdminDashboardController::class, 'editstation'])->name('stations.edit');
   Route::post('stations/update/{id}', [AdminDashboardController::class, 'updatestation'])->name('stations.update');
    Route::delete('stations/{id}', [AdminDashboardController::class, 'delete'])->name('stations.destroy');

    Route::get('/freightdashboard', [AdminDashboardController::class, 'freightdashboard'])->name('admin.freightdashboard');
    Route::get('/coachingdashboard', [AdminDashboardController::class, 'coachingdashboard'])->name('admin.coachingdashboard');
    Route::get('/parceldashboard', [AdminDashboardController::class, 'parceldashboard'])->name('admin.parceldashboard');

});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/user/onemonth', [UserDashboardController::class, 'onemonth'])->name('user.report.onemonth');
    Route::get('/user/thirdmonth', [UserDashboardController::class, 'secondmonth'])->name('user.report.thirdmonth');
    Route::get('/user/sixmonth', [UserDashboardController::class, 'thirdmonth'])->name('user.report.sixmonth');
    Route::get('/daily-report', [UserDashboardController::class, 'dailyReport'])->name('daily.report');
    Route::get('/frightdashboard', [UserDashboardController::class, 'frightdashboard'])->name('user.frightdashboard');
    Route::get('/user/form', [UserDashboardController::class, 'form'])->name('user.form');
    // Route::post('/record', [UserDashboardController::class, 'store'])->name('user.store');
    Route::post('/record/{id}/approval', [UserDashboardController::class, 'sendtoapproved'])->name('admin.approval');
    Route::post('/record/{id}/send-to-admin', [UserDashboardController::class, 'sendToAdmin'])->name('posts.sendToAdmin');
    Route::get('/reports/{id}/download', [UserDashboardController::class, 'downloadReport'])->name('reports.download');
    Route::get('/user/search', [UserDashboardController::class, 'isearch'])->name('reports.index');
    Route::post('/import', [UserDashboardController::class, 'import'])->name('user.import');
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

Route::get('/coaching', [CoachingController::class, 'coaching'])->name('admin.coaching');
Route::post('/import', [CoachingController::class, 'import'])
    ->name('excel.coaching');
