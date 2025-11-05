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
    $vacancy = Vacancy::create([
        'company_id' => $request->company_id,
        'posisi' => $request->posisi,
    ]);

    Qualification::create([
        'vacancy_id' => $vacancy->id,
        'usia_minimum' => $request->usia_minimum,
        'usia_maksimum' => $request->usia_maksimum,
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

    return redirect()->back()->with('success', 'Lowongan berhasil ditambahkan!');
}

    public function destroy($id)
    {
        $vacancies = Vacancy::findOrFail($id);
        $vacancies->delete();
        return redirect()->route('lowongan-pekerjaan')->with('success', 'Data perusahaan berhasil dihapus!');
    }

   public function update(Request $request, $id)
{
    $vacancy = Vacancy::findOrFail($id);
    $qualification = $vacancy->qualification;

    $vacancy->update([
        'company_id' => $request->company_id,
        'posisi' => $request->posisi,
    ]);

    if ($qualification) {
        $qualification->update([
            'usia_minimum' => $request->usia_minimum,
            'usia_maksimum' => $request->usia_maksimum,
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
    }
<<<<<<< HEAD

    return redirect()->route('lowongan-pekerjaan')->with('success', 'Lowongan berhasil diperbarui!');
}

}