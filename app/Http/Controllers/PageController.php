<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use App\Models\Company;
use App\Models\Qualification;

class PageController extends Controller
{
    public function pelamar()
    {
        return view('admin.pelamar', [
            "title" => "Pelamar"
        ]);
    }

    public function lowongan_pekerjaan()
    {
        $companies = Company::all();
        $qualifications = Qualification::all();
        $vacancies = Vacancy::with(['company', 'qualification'])->get();

        return view('admin.lowongan-pekerjaan', [
            "title" => "Lowongan Pekerjaan",
            "vacancies" => $vacancies,
            "companies" => $companies,
            "qualifications" => $qualifications
        ]);
    }

    public function arsip_data_pelamar()
    {
        return view('admin.arsip-data-pelamar', [
            "title" => "Arsip Data Pelamar"
        ]);
    }

    public function perusahaan()
    {
        $companies = Company::all();

        return view('admin.perusahaan', [
            "title" => "Perusahaan",
            "companies" => $companies
        ]);
    }
}
