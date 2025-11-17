<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacancy;
use App\Models\Company;
use App\Models\Qualification;

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
         // Total data
        $totalApplicants = Applicant::count();
        $totalVacancies  = Vacancy::count();
        $totalCompanies  = Company::count();

        // Ambil 5 data terbaru
        $latestApplicants = Applicant::orderBy('created_at', 'desc')->take(5)->get();
        $latestVacancies  = Vacancy::with('company')->orderBy('created_at', 'desc')->take(5)->get();
        $latestCompanies  = Company::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalApplicants',
            'totalVacancies',
            'totalCompanies',
            'latestApplicants',
            'latestVacancies',
            'latestCompanies'
        ));
    }

    public function pelamar()
    {
        return view('admin.pelamar', [
            "title" => "Pelamar",
        ]);
    }

    public function lowongan_pekerjaan()
    {
        // Get companies and qualifications
        $companies = Company::all();
        $qualifications = Qualification::all();
        
        // Get vacancies with their relationships
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
