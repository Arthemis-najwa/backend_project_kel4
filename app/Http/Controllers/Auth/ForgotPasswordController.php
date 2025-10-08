<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    // 🔹 1️⃣ Tampilkan form "Lupa Password"
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    // 🔹 2️⃣ Kirim OTP ke email
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        // Cek apakah email terdaftar di tabel 
        $user = DB::table('admins')->where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak terdaftar!']);
        }

        // Buat kode OTP 6 digit
        $otp = rand(100000, 999999);

        // Simpan / perbarui OTP di tabel password_reset_tokens
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'otp_code' => $otp,
                'otp_expires_at' => Carbon::now()->addMinutes(10),
                'created_at' => Carbon::now()
            ]
        );

        // Kirim email OTP
        Mail::raw("Kode OTP kamu untuk reset password adalah: $otp", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Kode OTP Reset Password');
        });

        // Simpan email ke session agar bisa diakses di form selanjutnya
        session(['email' => $request->email]);

        return redirect()->route('password.otp.form')->with('success', 'Kode OTP telah dikirim ke email kamu!');
    }

    // 🔹 3️⃣ Tampilkan form verifikasi OTP
    public function showOtpForm()
    {
        $email = session('email');
        if (!$email) {
            return redirect()->route('password.request')->withErrors(['email' => 'Silakan masukkan email terlebih dahulu.']);
        }
        return view('auth.verify-otp', compact('email'));
    }

    // 🔹 4️⃣ Verifikasi OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp_code' => 'required'
        ]);

        $record = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if (!$record) {
            return back()->withErrors(['otp_code' => 'Kode OTP tidak ditemukan.']);
        }

        if ($record->otp_code !== $request->otp_code) {
            return back()->withErrors(['otp_code' => 'Kode OTP salah.']);
        }

        if (Carbon::now()->gt(Carbon::parse($record->otp_expires_at))) {
            return back()->withErrors(['otp_code' => 'Kode OTP sudah kadaluarsa.']);
        }

        // Simpan email ke session agar bisa diakses di halaman reset password
        session(['email' => $request->email]);

        // Arahkan ke form reset password
        return redirect()->route('password.reset.form')->with('success', 'OTP berhasil diverifikasi!');
    }

    // 🔹 5️⃣ Tampilkan form reset password
    public function showResetForm()
    {
        $email = session('email');
        if (!$email) {
            return redirect()->route('password.request')->withErrors(['email' => 'Silakan masukkan email terlebih dahulu.']);
        }

        return view('auth.reset-password', compact('email'));
    }

    // 🔹 6️⃣ Simpan password baru
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = DB::table('admins')->where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan di sistem.']);
        }

        // Update password
        DB::table('admins')->where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        // Hapus token agar tidak bisa digunakan lagi
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Hapus email dari session
        session()->forget('email');

        return redirect()->route('login')->with('status', 'Password berhasil diubah! Silakan login dengan password baru.');
    }
}
