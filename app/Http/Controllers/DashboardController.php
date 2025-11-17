<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Vacancy;
use App\Models\Company;

class DashboardController extends Controller
{
    
    public function index()
    {
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
}
