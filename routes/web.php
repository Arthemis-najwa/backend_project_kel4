<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;

// Route::get('/', function () {
//     return view('login');
// });

// Route::get('/register', function () {
//     return view('auth.register');
// })->name('register');

// aktifkan route auth
require __DIR__ . '/auth.php';

Route::get("/", [PageController::class, "direct_dashboard"]);
Route::get("/dashboard", [PageController::class, "dashboard"])->name("dashboard");
Route::get("/pelamar", [PageController::class, "pelamar"])->name("pelamar");
Route::get("/lowongan-pekerjaan", [PageController::class, "lowongan_pekerjaan"])->name("lowongan-pekerjaan");
Route::get("/perusahaan", [PageController::class, "perusahaan"])->name("perusahaan");
Route::get("/arsip-data-pelamar", [PageController::class, "arsip_data_pelamar"])->name("arsip-data-pelamar");
Route::get("/logout", [AuthController::class, "logout"])->name("logout");
Route::get('change-password', function () {
    $title = 'Ganti Password';
    return view('admin.change-password',compact('title'));
})->name('change-password');

Route::get("/login", [AuthController::class, "login"])->name("login");
Route::post("/login", [AuthController::class, "login_post"])->name("login.post");


Route::get("/logout", [AuthController::class, "logout"])->name("logout");
Route::get('/forgot-password', function () {
    return 'Halaman ganti password belum tersedia.';
})->name('password.request');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendOtp'])->name('password.email');

Route::get('/verify-otp', [ForgotPasswordController::class, 'showOtpForm'])->name('password.otp.form');

Route::get('/reset-password', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset.form');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('password.store');
Route::post('/password/store', [AuthController::class, 'store'])->name('password.store');

Route::post('/password/verify-otp', [AuthController::class, 'verifyOtp'])->name('password.verify.otp');

Route::get('/password/reset-form', [AuthController::class, 'showResetForm'])->name('password.reset.form');
Route::post('/password/reset-store', [AuthController::class, 'resetPassword'])->name('password.reset.store');

