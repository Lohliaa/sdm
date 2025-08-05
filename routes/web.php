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
use App\Http\Controllers\MOUController;
use App\Http\Controllers\SKController;

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
    Route::resource('/profile', UserController::class)->only(['index', 'update', 'show'])->middleware('auth');

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
    Route::get('/export-mou', [MOUController::class, 'export'])->name('mou.export');

    // SK
    Route::resource('/sk', SKController::class);
    Route::get('/search-sk', [SKController::class, 'searchSK'])->name('search.sk');
    Route::get('/sk/download/{id}', [SKController::class, 'download'])->name('sk.download');
    Route::get('/sk/upload', [SKController::class, 'upload'])->name('sk.upload');
    Route::post('/sk/upload', [SKController::class, 'uploadProcess'])->name('sk.upload.process');
    Route::get('/export-sk', [SKController::class, 'export'])->name('sk.export');

    //ABOUT
    Route::get('/about', [AboutController::class, 'index'])->name('about')->middleware('auth');

    // USER
    Route::resource('/user', UserController::class)->middleware('auth');
    Route::post('reset_user', [UserController::class, 'reset_user'])->name('reset_user');
    // Route::get('edit_user/{id}', [UserController::class, 'edit']);
    // Route::post('/update-user/{id}', [UserController::class, 'update'])->name('update.user');
    Route::delete('/delete-user',  [UserController::class, 'deleteItems'])->name('user.delete');
    Route::get('/search-user', [UserController::class, 'searchUser'])->name('search.user');
    Route::get('/cari', [UserController::class, 'cari'])->name('user.cari');

    Route::get('/unduh/{nama_file}', [HomeController::class, 'unduh'])->name('unduh');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
