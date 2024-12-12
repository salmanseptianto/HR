<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MmController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GmController;
use App\Http\Controllers\MhController;
use App\Http\Controllers\ResetPasswordController;
use App\Models\Kpi;

// use Illuminate\Support\Facades\Password;
// use Illuminate\Support\Facades\Mail; //test email
// use App\Mail\TestEmail; //test email

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

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index')->name('login')->middleware('guest');
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('dologin', 'dologin')->middleware('guest');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(ResetPasswordController::class)->group(function () {
    Route::get('/forgot-password', 'requestForm')->name('password.request');
    Route::post('/forgot-password', 'sendResetLink')->name('password.email');
    Route::get('/reset-password/{token}', 'resetForm')->name('password.reset');
    Route::post('/reset-password', 'updatePassword')->name('password.update');
});

Route::middleware('role:admin')->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('admin', 'index')->name('admin');
        Route::get('admin/dashboard', 'index');
        Route::get('admin/laporan-manager', 'manager');
        Route::get('admin/laporan-marketing/laporan-harian/{type}', 'laporanMmHarian')->name('laporanHarian');
        Route::get('admin/laporan-marketing/laporan-mingguan/{type}', 'laporanMmMingguan')->name('laporanMingguan');
        Route::get('admin/add-user', 'adduser');
        Route::post('doadduser', 'doadduser')->name('doadduser');
    });
});

Route::middleware('role:gm')->group(function () {
    Route::controller(GmController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('general-manager', 'index')->name('general-manager');
        Route::get('general-manager/dashboard', 'index');
        Route::get('general-manager/print', 'print');

        Route::get('general-manager/kpi', 'viewkpi')->name('kpi');
        Route::get('general-manager/add-kpi', 'kpi');
        Route::post('general-manager/add', 'add_kpi')->name('add');
        Route::get('general-manager/kpi/{id}/edit', 'kpiedit')->name('kpi.edit');
        Route::put('general-manager/kpi/{id}', 'kpiupdate')->name('kpi.update');
        Route::delete('general-manager/kpi/{id}', 'kpidestroy')->name('kpi.destroy');

        Route::get('general-manager/add-user', 'adduser')->name('add.user');
        Route::post('doadduser', 'doadduser')->name('doadduser');
    });
});

Route::middleware('role:mh')->group(function () {
    Route::controller(MhController::class)->group(function () {
        // Dashboard and General Routes
        Route::get('/', 'index');
        Route::get('manager-hrd', 'index')->name('mh');
        Route::get('manager-hrd/dashboard', 'index');
        Route::get('manager-hrd/print', 'print');

        Route::get('manager-hrd/kinerja', 'kinerjaIndex')->name('kinerja.index');
        Route::get('manager-hrd/add-kinerja', 'addkinerja')->name('add.kinerja');
        Route::post('manager-hrd/add-kinerja', 'storekinerja')->name('add.kinerja.submit');
        Route::get('manager-hrd/edit-kinerja/{id}', 'editkinerja')->name('edit.kinerja');
        Route::put('manager-hrd/edit-kinerja/{id}', 'updatekinerja')->name('update.kinerja');
        Route::delete('manager-hrd/delete-kinerja/{id}', 'deletekinerja')->name('delete.kinerja');

        // Manage KPI Routes
        Route::get('manager-hrd/kpi', 'viewkpi')->name('kpi');
        Route::get('manager-hrd/add-kpi', 'kpi')->name('add.kpi'); // Add KPI form
        Route::get('manager-hrd/kpi-by-jabatan', 'getKpisByJabatan')->name('kpi.by.jabatan'); // AJAX KPI by jabatan
        Route::post('manager-hrd/add', 'add_kpi')->name('add');
        Route::get('manager-hrd/kpi/{id}/edit', 'kpiedit')->name('kpi.edit');
        Route::put('manager-hrd/kpi/{id}', 'kpiupdate')->name('kpi.update');
        Route::delete('manager-hrd/kpi/{id}', 'kpidestroy')->name('kpi.destroy');

        // Manage User Routes
        Route::get('manager-hrd/add-user', 'adduser')->name('add.user');
        Route::get('manager-hrd/deleteuser/{id}', 'deleteuser')->name('delete.user');
        Route::post('doadduser', 'doadduser')->name('doadduser');

        Route::get('manager-hrd/kpi/export-pdf/{type}', 'KPIexportPDF')->name('kpi.export.pdf');
        Route::get('manager-hrd/kpi/export-excel/{type}', 'KPIexportExcel')->name('kpi.export.excel');
    });
});

Route::middleware('role:mm')->group(function () {
    Route::controller(MmController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('manager-marketing', 'index');
        Route::get('manager-marketing/dashboard', 'index');
        Route::get('manager-marketing/marketing', 'marketing')->name('marketing');
        Route::get('manager-marketing/laporan-marketing/laporan-harian/{type}', 'ReportHarian')->name('ReportHarian');
        Route::get('manager-marketing/laporan-marketing/laporan-mingguan/{type}', 'ReportMingguan')->name('ReportMingguan');

        Route::get('manager-marketing/laporan-harian-marketing', 'harian');
        Route::post('manager-marketing/laporan-harian-marketing/{id}/approve', 'happrove')->name('harian.approve');
        Route::post('manager-marketing/laporan-harian-marketing/{id}/reject', 'hreject')->name('harian.reject');
        Route::get('manager-marketing/laporan-harian-marketing/{project}', 'harianArea')->name('harian.area');

        Route::get('manager-marketing/laporan-mingguan-marketing', 'mingguan');
        Route::post('manager-marketing/laporan-mingguan-marketing/{id}/approve', 'mapprove')->name('mingguan.approve');
        Route::post('manager-marketing/laporan-mingguan-marketing/{id}/reject', 'mreject')->name('mingguan.reject');
        Route::get('manager-marketing/laporan-mingguan-marketing/{project}', 'mingguanArea')->name('mingguan.area');
    });
});

Route::middleware('role:marketing')->group(function () {
    Route::controller(MarketingController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('marketing', 'index')->name('marketing');
        Route::get('marketing/dashboard', 'index');

        Route::get('marketing/harian', 'harian')->name('harian');
        Route::post('marketing/addharian', 'addharian')->name('addharian');
        Route::get('marketing/harian/{id}/edit', 'harianedit')->name('harian.edit');
        Route::put('marketing/harian/{id}', 'harianupdate')->name('harian.update');
        Route::delete('marketing/harian/{id}', 'hariandestroy')->name('harian.destroy');

        Route::get('marketing/mingguan', 'mingguan')->name('mingguan');
        Route::post('marketing/addmingguan', 'addmingguan')->name('addmingguan');
        Route::get('marketing/mingguan/{id}/edit', 'mingguanedit')->name('mingguan.edit');
        Route::put('marketing/mingguan/{id}', 'mingguanupdate')->name('mingguan.update');
        Route::delete('marketing/mingguan/{id}', 'mingguandestroy')->name('mingguan.destroy');
    });
});

Route::middleware('role:admin,mm, mh')->group(function () {
    Route::controller(ExportController::class)->group(function () {
        Route::get('laporan-marketing/laporan-harian/export-excel/{type}', 'exportExcelH')->name('harian.export.excel');
        Route::get('laporan-marketing/laporan-harian/export-pdf/{type}', 'exportPDFH')->name('harian.export.pdf');
        Route::get('laporan-marketing/laporan-mingguan/export-excel/{type}', 'exportExcelM')->name('mingguan.export.excel');
        Route::get('laporan-marketing/laporan-mingguan/export-pdf/{type}', 'exportPDFM')->name('mingguan.export.pdf');
    });
});



// Route::get('/test.email', function (){
//     Mail::to('112umarshahib@general-managerail.com')
//     ->send(new TestEmail());
// });
