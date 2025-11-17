<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use App\Models\Company;
use App\Models\Qualification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\ApplicantsExport;
use Maatwebsite\Excel\Facades\Excel;

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
    try{
        DB::beginTransaction();
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
DB::commit();
    return redirect()->back()->with('success', 'Lowongan berhasil ditambahkan!');
    }catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
    }
}

    public function destroy($id)
    {
        $vacancies = Vacancy::findOrFail($id);
        $vacancies->delete();
        return redirect()->route('lowongan-pekerjaan')->with('success', 'Data perusahaan berhasil dihapus!');
    }

   public function update(Request $request, $id)
{
    try{
        DB::beginTransaction();
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
    DB::commit();
    return redirect()->back()->with('success', 'Lowongan berhasil diupdate!');
    }catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
    }
}
public function export($id)
{
    $vacancy = Vacancy::with('company')->findOrFail($id);

    $companyName = $vacancy->company->nama_perusahaan;

    $position = $vacancy->posisi;

    $safeCompany = preg_replace('/[^\w\s-]/', '', $companyName);
    $safePosition = preg_replace('/[^\w\s-]/', '', $position);

    $fileName = "Data Pelamar - {$safeCompany} - {$safePosition}.xlsx";

    return Excel::download(new ApplicantsExport($id), $fileName);
}
}