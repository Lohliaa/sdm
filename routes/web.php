<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MOUController;

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
    return view('welcome');
});
Auth::routes();

// REGISTER
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);
// FORGOT PASSWORD
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');

// RESET PASSWORD
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


Route::group(['middleware' => ['web']], function () {
    // Halaman Utama
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth,51B1');
    // Halaman Utama

    Route::resource('/user', UserController::class)->middleware('checkRole:Admin');
    Route::resource('/dashboard', DashboardController::class)->only(['index'])->middleware('checkRole:Admin');
    Route::resource('/profile', ProfileController::class)->only(['index', 'update', 'show'])->middleware('auth');

    // HOME
    Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');
    Route::delete('/home/{id}', [HomeController::class, 'destroy'])->name('home.delete');
    Route::get('/search-home', [HomeController::class, 'searchHome'])->name('search.home');

    // MOU
    Route::resource('/mou', MOUController::class);
    Route::get('/search-mou', [MOUController::class, 'searchMOU'])->name('search.mou');
    Route::get('/mou/download/{id}', [MOUController::class, 'download'])->name('mou.download');
    Route::get('/mou/upload', [MOUController::class, 'upload'])->name('mou.upload');
    Route::post('/mou/upload', [MOUController::class, 'uploadProcess'])->name('mou.upload.process');


    // KATEGORI SURAT
    Route::get('/kategori_surat', [KategoriController::class, 'index'])->name('kategori_surat')->middleware('auth');
    Route::delete('/kategori_surat/{id}', [KategoriController::class, 'destroy'])->name('kategori_surat.delete');
    Route::post('/kategori_surat/store', [KategoriController::class, 'store'])->name('kategori_surat.store');
    Route::put('/kategori_surat/update', [KategoriController::class, 'update'])->name('kategori_surat.update');
    Route::get('/search-ks', [KategoriController::class, 'searchks'])->name('search.kategori_surat');

    //ABOUT
    Route::get('/about', [AboutController::class, 'index'])->name('about')->middleware('auth');

    // PROFILE
    Route::resource('/profile', UserController::class)->middleware('auth');
    Route::post('reset_profile', [UserController::class, 'reset_profile'])->name('reset_profile');
    Route::get('edit_profile/{id}', [UserController::class, 'edit']);
    Route::post('/update-profile/{id}', [UserController::class, 'update'])->name('update.profile');
    Route::delete('/delete-profile',  [UserController::class, 'deleteItems'])->name('profile.delete');
    Route::get('/search-profile', [UserController::class, 'searchProfile'])->name('search.profile');
    Route::get('/cari', [UserController::class, 'cari'])->name('profile.cari');

    Route::get('/unduh/{nama_file}', [HomeController::class, 'unduh'])->name('unduh');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
