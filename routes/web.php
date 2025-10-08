<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

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
