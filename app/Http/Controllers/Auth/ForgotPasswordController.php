<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required',
        ]);

        $token = \DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('otp_code', $request->otp)
            ->where('otp_expires_at', '>', now())
            ->first();

        if (!$token) {
            return back()->withErrors(['otp' => 'Kode OTP salah atau sudah kadaluarsa.']);
        }

        // Jika OTP benar, arahkan ke halaman reset password
        return redirect()->route('password.reset.form', ['email' => $request->email]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        // Cari data user di tabel admin
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        // Cek OTP yang tersimpan di tabel password_reset_tokens
        $token = \DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('otp_code', $request->otp)
            ->where('otp_expires_at', '>', now())
            ->first();

        if (!$token) {
            return back()->withErrors(['otp' => 'OTP salah atau sudah kadaluarsa.']);
        }

        // Update password admin
        $admin->update([
            'password' => Hash::make($request->password),
        ]);

        // Hapus token OTP agar tidak bisa dipakai lagi
        \DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        return redirect()->route('login')->with('success', 'Password berhasil diperbarui! Silakan login kembali.');
    }

    public function showResetForm(Request $request)
    {
        $email = $request->query('email');
        return view('auth.reset-password', compact('email'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $admin = \App\Models\Admin::where('email', $request->email)->first();

        if (!$admin) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        $admin->password = Hash::make($request->password);
        $admin->save();

        // Hapus token setelah digunakan
        \DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Password berhasil diubah. Silakan login.');
    }

    public function sendOtp(Request $request)
    {
        // Contoh validasi username
        $request->validate([
            'username' => 'required'
        ]);

        // Cari admin berdasarkan username
        $admin = \App\Models\Admin::where('username', $request->username)->first();

        if (!$admin) {
            return back()->withErrors(['username' => 'Username tidak ditemukan']);
        }

        // Generate OTP
        $otp = rand(100000, 999999);

        // Simpan OTP ke tabel password_reset_tokens
        \DB::table('password_reset_tokens')->updateOrInsert(
            ['username' => $admin->username],
            ['token' => $otp, 'created_at' => now()]
        );

        // Untuk demo, tampilkan OTP di halaman (atau kirim manual)
        return view('auth.show-otp', ['otp' => $otp, 'username' => $admin->username]);
    }
}
