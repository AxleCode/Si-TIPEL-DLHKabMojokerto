<?php

use App\Models\Status;
use App\Models\Notifikasi;
use App\Models\Downloadable;

use App\Models\CategoryAduan;
use App\Http\Controllers\SendEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\AdminLaporanController;
use App\Http\Controllers\DownloadableController;
use App\Http\Controllers\CategoryAduanController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\AdminPengumumanController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\SurveyorController;

use App\Models\Logo;
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
Route::get('/home', [MapController::class,'home']);
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::get('/nonaktif', [UserController::class, 'showDeactivated'])->name('nonaktif');

Route::get('/dashboard', [DashboardController::class,'index'])->middleware('auth', 'verified', 'active');

Route::get('/dashboard/profile', [ProfileController::class,'index'])->name('index')->middleware('auth', 'verified', 'active');
Route::get('/dashboard/downloadable', [DownloadableController::class,'user'])->middleware('auth', 'verified', 'active');
Route::get('/dashboard/notifikasi', [NotifikasiController::class,'index'])->middleware('auth', 'verified', 'active');
Route::post('/dashboard/notifikasi/{id}', [NotifikasiController::class,'update'])->name('notif-update')->middleware('auth', 'verified', 'active');
Route::post('/dashboard/notifikasi', [NotifikasiController::class,'updateall'])->name('notif-updateall')->middleware('auth', 'verified', 'active');
Route::post('/dashboard/profile',[ProfileController::class,'update'])->name('profile-update')->middleware('auth', 'verified', 'active');
Route::resource('/dashboard/laporan', LaporanController::class)->middleware('auth', 'verified', 'active');
Route::get('/dashboard/map', [MapController::class,'index'])->middleware('auth', 'verified', 'active');

Route::resource('/dashboard/petugas', PetugasController::class)->middleware('auth', 'role:petugas', 'active');
Route::resource('/dashboard/surveyor', SurveyorController::class)->middleware('auth', 'role:surveyor', 'active');
Route::resource('/dashboard/komentar', KomentarController::class)->middleware('auth', 'role:petugas', 'active');
Route::resource('/dashboard/komentar', KomentarController::class)->middleware('auth', 'role:admin', 'active');

Route::group(['middleware' => ['auth', 'role:admin', 'active']], function () {
    Route::resource('/dashboard/status', StatusController::class);
    Route::resource('/dashboard/user', UserController::class);
    Route::resource('/dashboard/laporanadmin', AdminLaporanController::class);
    Route::resource('/dashboard/kategori', CategoryAduanController::class);
    Route::resource('/dashboard/pengumuman', AdminPengumumanController::class);
    Route::resource('/dashboard/admindownloadable', DownloadableController::class);
    Route::put('/dashboard/{user}/user', [UserController::class, 'status'])->name('user.status');
    Route::get('/dashboard/website', [WebsiteController::class, 'index'])->name('website.index');
    Route::put('/dashboard/website/{id}/logo1', [WebsiteController::class, 'updateLogo1'])->name('logo1-update');
    Route::put('/dashboard/website/{id}/pelayanan', [WebsiteController::class, 'updatePelayanan'])->name('pelayanan-update');
    Route::post('/dashboard/website', [WebsiteController::class, 'buatPelayanan'])->name('buat-pelayanan');
    Route::delete('/dashboard/layanan/{layanan}', [WebsiteController::class, 'destroy'])->name('layanan-hapus');
    
});

// Route::group(['middleware' => ['auth', 'role:petugas', 'active']], function () {
//     Route::resource('/dashboard/petugas', [PetugasController::class]);
    
// });

// Route::group(['middleware' => ['auth', 'role:surveyor', 'active']], function () {
//     Route::resource('/dashboard/laporanadmin', AdminLaporanController::class);
    
// });


Route::fallback(function () {
    abort(404);
});


// Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
// Route::post('/login', [LoginController::class, 'authenticate']);
// Route::post('/logout', [LoginController::class, 'logout']);

// Route::get('/registrasi', [RegisterController::class, 'index'])->middleware('guest');
// Route::post('/registrasi', [RegisterController::class, 'store']);

// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified']);
