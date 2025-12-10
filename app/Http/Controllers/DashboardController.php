<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\Vacancy;
use App\Models\Company;

class DashboardController extends Controller
{
    public function index()
    {
        // Rekap real-time
        $totalPelamar = Applicant::count();
        $totalLowongan = Vacancy::count();
        $totalPerusahaan = Company::count();

        // Ambil 5 data terbaru
        $pelamarTerbaru = Applicant::latest('created_at')->take(5)->get();

        // eager load company + qualification
        $lowonganTerbaru = Vacancy::with(['company', 'qualification'])
            ->latest('created_at')
            ->take(5)
            ->get();

        $perusahaanTerbaru = Company::latest('created_at')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalPelamar',
            'totalLowongan',
            'totalPerusahaan',
            'pelamarTerbaru',
            'lowonganTerbaru',
            'perusahaanTerbaru'
        ));
    }
}
