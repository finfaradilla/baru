<?php

namespace App;

use App\Models\Room;
use App\Models\Building;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DaftarRuangController;
use App\Http\Controllers\DaftarPinjamController;
use App\Http\Controllers\DashboardRentController;
use App\Http\Controllers\DashboardRoomController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\TemporaryRentController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardItemController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index', [
        'title' => "Home",
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/auth/google', [LoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard/overview', function () {
        return view('/dashboard/overview/index', [
            'title' => "Dashboard Admin",
        ]);
    });

    Route::middleware(['checkRole'])->group(function () {
        // Route::get('/dashboard/temporaryRents', [TemporaryRentController::class, 'index']);
        // Route::get('/dashboard/temporaryRents/{id}/acceptRents', [TemporaryRentController::class, 'acceptRents']);
        // Route::get('/dashboard/temporaryRents/{id}/declineRents', [TemporaryRentController::class, 'declineRents']);
        Route::post('/dashboard/rents/store', [DashboardRentController::class, 'store'])->name('dashboard.rents.store')->middleware('auth');
        Route::get('/dashboard/rents/export', [DashboardRentController::class, 'export'])->name('rents.export');
        Route::resource('dashboard/rents', DashboardRentController::class);
        Route::resource('dashboard/rooms', DashboardRoomController::class);
        Route::resource('dashboard/items', DashboardItemController::class);
        Route::resource('dashboard/users', DashboardUserController::class);
        Route::resource('dashboard/admin', DashboardAdminController::class);
        Route::resource('/daftarpinjam', DashboardRentController::class);
        Route::get('dashboard/rents/{id}/endTransaction', [DashboardRentController::class, 'endTransaction']);
        Route::put('/dashboard/rents/reject', [DashboardRentController::class, 'rejectRent']);
        Route::put('dashboard/rents/{id}/cancel', [DashboardRentController::class, 'cancelRent']);
        Route::get('dashboard/users/{id}/makeAdmin', [DashboardUserController::class, 'makeAdmin']);
        Route::get('dashboard/admin/{id}/removeAdmin', [DashboardAdminController::class, 'removeAdmin']);

        });
    
        Route::get('/get-bookings', [DashboardRentController::class, 'getBookings'])->name('get.bookings');
    Route::resource('/daftarpinjam', DashboardRentController::class);
    Route::get('/daftarruang', [DaftarRuangController::class, 'index']);
    Route::get('/showruang/{room:code}', [DaftarRuangController::class, 'show']);
    Route::get('/editshowruang/{room:code}', [DashboardRentController::class, 'edit']);
    Route::get('/daftarpinjam', [DaftarPinjamController::class, 'index']);
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::post('/updateshowruang/{id}', [DashboardRentController::class, 'updateshowruang']);
    Route::delete('/deleterent/{id}', [DashboardRentController::class, 'destroy'])->middleware('auth');
});


