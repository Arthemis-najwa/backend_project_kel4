<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function direct_dashboard()
    {
        return redirect()->route('login');
    }

    public function dashboard()
    {
        return view('admin.dashboard', [
            "title" => "Dashboard",
        ]);
    }

    public function pelamar()
    {
        return view('admin.pelamar', [
            "title" => "Pelamar",
        ]);
    }

    public function lowongan_pekerjaan()
    {
        return view('admin.lowongan-pekerjaan', [
            "title" => "Lowongan Pekerjaan",
        ]);
    }


    public function arsip_data_pelamar()
    {
        return view('admin.arsip-data-pelamar', [
            "title" => "Arsip Data Pelamar",
        ]);
    }

    public function perusahaan()
    {
        $companies = \App\Models\Company::all();
        $title = 'Perusahaan'; 

        return view('admin.perusahaan', compact('companies', 'title'));
    }
}
