<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use App\Models\Company;
use App\Models\Qualification;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    public function index()
    {
        $vacancies = Vacancy::with(['company', 'qualification'])->get();
        $companies = Company::all();

        return view('admin.lowongan-pekerjaan', [
            'title' => 'Lowongan Pekerjaan',
            'vacancies' => $vacancies,
            'companies' => $companies,
        ]);
    }

    public function store(Request $request)
    {
        $qualification = Qualification::create([
            'usia' => $request->usia,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'jurusan' => $request->jurusan,
            'tahun_lulus' => $request->tahun_lulus,
            'pengalaman_kerja' => $request->pengalaman_kerja,
            'skill_teknis' => $request->skill_teknis,
            'skill_non_teknis' => $request->skill_non_teknis,
            'status_vaksinasi' => $request->status_vaksinasi,
            'status_pernikahan' => $request->status_pernikahan,
        ]);

        Vacancy::create([
            'company_id' => $request->company_id,
            'qualification_id' => $qualification->id,
            'posisi' => $request->posisi,
        ]);

        return redirect()->back()->with('success', 'Lowongan berhasil ditambahkan!');
    }
}
