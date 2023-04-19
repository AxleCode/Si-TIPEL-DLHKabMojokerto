<?php

use App\Models\Status;
use App\Models\CategoryAduan;
use App\Http\Controllers\SendEmail;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminLaporanController;
use App\Http\Controllers\CategoryAduanController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\AdminPengumumanController;
use App\Http\Controllers\DownloadableController;
use App\Models\Downloadable;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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



Route::get('/', [MapController::class,'home']);

Route::get('/dashboard', [DashboardController::class,'index'])->middleware('auth', 'verified');

Route::get('/dashboard/profile', function(){
    return view('dashboard.profile.index');
})->name('index')->middleware('auth', 'verified');

Route::get('/dashboard/downloadable', [DownloadableController::class,'user'])->middleware('auth', 'verified');;

Route::post('/dashboard/profile',[ProfileController::class,'update'])->name('profile-update')->middleware('auth', 'verified');

Route::resource('/dashboard/laporan', LaporanController::class)->middleware('auth', 'verified');

Route::get('/dashboard/map', [MapController::class,'index'])->middleware('auth', 'verified');

Route::group(['middleware' => ['auth', 'IsAdmin']], function () {
    Route::resource('/dashboard/status', StatusController::class);
    Route::resource('/dashboard/laporanadmin', AdminLaporanController::class);
    Route::resource('/dashboard/kategori', CategoryAduanController::class);
    Route::resource('/dashboard/pengumuman', AdminPengumumanController::class);
    Route::resource('/dashboard/admindownloadable', DownloadableController::class);
});

Route::fallback(function () {
    abort(404);
});


// Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
// Route::post('/login', [LoginController::class, 'authenticate']);
// Route::post('/logout', [LoginController::class, 'logout']);

// Route::get('/registrasi', [RegisterController::class, 'index'])->middleware('guest');
// Route::post('/registrasi', [RegisterController::class, 'store']);

// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified']);
