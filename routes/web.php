<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\DashboardController;

require __DIR__ . '/auth.php';
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// Halaman utama & dashboard
Route::get("/", [PageController::class, "direct_dashboard"]);
Route::get("/dashboard", [PageController::class, "dashboard"])->name("dashboard");
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');



// Halaman data
Route::get("/pelamar", [PageController::class, "pelamar"])->name("pelamar");
Route::get("/lowongan-pekerjaan", [PageController::class, "lowongan_pekerjaan"])->name("lowongan-pekerjaan");
Route::get("/perusahaan", [PageController::class, "perusahaan"])->name("perusahaan");
Route::get("/arsip-data-pelamar", [PageController::class, "arsip_data_pelamar"])->name("arsip-data-pelamar");

// Auth
Route::get("/login", [AuthController::class, "login"])->name("login");
Route::post("/login", [AuthController::class, "login_post"])->name("login.post");
Route::get("/logout", [AuthController::class, "logout"])->name("logout");

// Forgot password & reset
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

// Company CRUD
Route::get('/perusahaan/data', [CompanyController::class, 'data'])->name('perusahaan.data');
Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
Route::post('/companies/store', [CompanyController::class, 'store'])->name('companies.store');
Route::delete('/companies/{id}', [CompanyController::class, 'destroy'])->name('companies.destroy');
Route::resource('companies', CompanyController::class);
Route::put('/companies/{id}/status', [CompanyController::class, 'updateStatus']);


// Vacancy CRUD
Route::get('/vacancies', [VacancyController::class, 'index'])->name('lowongan-pekerjaan');
Route::post('/vacancies/store', [VacancyController::class, 'store'])->name('vacancies.store');
Route::get('/vacancies/{id}/edit', [VacancyController::class, 'edit'])->name('vacancies.edit');
Route::put('/vacancies/{id}', [VacancyController::class, 'update'])->name('vacancies.update');
Route::delete('/vacancies/{id}', [VacancyController::class, 'destroy'])->name('vacancies.destroy');

// Ganti Password
Route::get('/ganti-password', [ProfileController::class, 'editPassword'])->name('ganti-password');
Route::post('/ganti-password', [ProfileController::class, 'updatePassword'])->name('update-password');

// Applicant CRUD
Route::get('/pelamar', [ApplicantController::class, 'index'])->name('pelamar');
Route::post('/applicants/store', [ApplicantController::class, 'store'])->name('applicants.store');
Route::put('/applicants/{id}', [ApplicantController::class, 'update'])->name('applicants.update');
Route::delete('/applicants/{id}', [ApplicantController::class, 'destroy'])->name('applicants.destroy');
Route::post('/applicants/update-status/{id}', [ApplicantController::class, 'updateStatus'])->name('applicants.updateStatus');
Route::post('/applicants/{id}/archive', [ApplicantController::class, 'archive'])->name('applicants.archive');
Route::post('/applicants/{id}/restore', [ApplicantController::class, 'restore'])->name('applicants.restore');
Route::delete('/applicants/{id}/permanent-delete', [ApplicantController::class, 'permanentDelete'])->name('applicants.permanentDelete');

// Archive CRUD
Route::get('/arsip-data-pelamar', [ArchiveController::class, 'index'])->name('arsip-data-pelamar');
Route::post('/archives/{id}/restore', [ArchiveController::class, 'restore'])->name('arsip-data-pelamar.restore');
Route::delete('/archives/{id}/hapus', [ArchiveController::class, 'destroy'])->name('arsip-data-pelamar.destroy');

// Export & Kirim
Route::post('applicants/{id}/kirim', [ApplicantController::class, 'kirim'])->name('applicants.kirim');
Route::get('vacancies/{id}/export', [VacancyController::class, 'export'])->name('vacancies.export');