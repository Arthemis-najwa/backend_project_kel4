<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('new-login', [
            'title' => 'Login Admin'
        ]);
    }

    public function login_post(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if (!$admin) {
            return back()->withErrors(['username' => 'Username tidak ditemukan.'])->withInput();
        }

        if (!Hash::check($request->password, $admin->password)) {
            return back()->withErrors(['password' => 'Password salah.'])->withInput();
        }

        Auth::login($admin);

        return redirect()->route('dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
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


    return redirect()->route('password.reset.form', ['email' => $request->email]);
}


    public function store(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'otp' => 'required',
        'password' => 'required|min:6|confirmed',
    ]);

    $admin = Admin::where('email', $request->email)->first();

    if (!$admin) {
        return back()->withErrors(['email' => 'Email tidak ditemukan.']);
    }

    $token = \DB::table('password_reset_tokens')
        ->where('email', $request->email)
        ->where('otp_code', $request->otp)
        ->where('otp_expires_at', '>', now())
        ->first();

    if (!$token) {
        return back()->withErrors(['otp' => 'OTP salah atau sudah kadaluarsa.']);
    }


    $admin->update([
        'password' => Hash::make($request->password),
    ]);

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


    $admin = Admin::where('email', $request->email)->first();

    if (!$admin) {
        return back()->withErrors(['email' => 'Email tidak ditemukan.']);
    }

    $admin->password = Hash::make($request->password);
    $admin->save();

    DB::table('password_reset_tokens')->where('email', $request->email)->delete();

    return redirect()->route('login')->with('success', 'Password berhasil diubah. Silakan login.');
}
}
