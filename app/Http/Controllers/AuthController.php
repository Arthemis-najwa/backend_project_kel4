<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth.new-login", [
            "title" => "Login",
        ]);
    }

    public function login_post(Request $request)
    {
        return redirect()->route("dashboard");

        if (Auth::attempt($request->only(["email", "password"]))) {
            return redirect()->route("admin.dashboard");
        } else {
            return back()->with("notification", [
                "icon" => "error",
                "title" => "Gagal",
                "text" => "Email atau password salah",
            ]);
        }
    }

    public function logout()
    {
        return redirect()->route("login");
    }
}
