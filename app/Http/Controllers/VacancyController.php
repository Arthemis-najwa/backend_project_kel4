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
    try {
        $vacancy = Vacancy::findOrFail($id);

        // Cek apakah ada applicant_recommendations yang terkait dengan lowongan ini
        // dan pelamarnya BELUM diarsipkan (deleted_at = NULL)
        $applicantRecommendations = \DB::table('applicant_recommendations')
            ->where('vacancy_id', $id)
            ->join('applicants', 'applicant_recommendations.applicant_id', '=', 'applicants.id')
            ->whereNull('applicants.deleted_at')  // Hanya ambil pelamar yang belum diarsipkan
            ->select('applicants.id', 'applicants.nama_lengkap')
            ->distinct()
            ->get();
        
        if ($applicantRecommendations->count() > 0) {
            $applicantList = $applicantRecommendations->map(function($a) {
                return ['nama_lengkap' => $a->nama_lengkap];
            })->toArray();
            
            return response()->json([
                'success' => false,
                'message' => '❌ Anda harus mengarsipkan seluruh pelamar terlebih dahulu sebelum menghapus lowongan',
                'applicant_count' => $applicantRecommendations->count(),
                'applicants' => $applicantList
            ], 422);
        }

        // Hapus applicant_recommendations terlebih dahulu
        \DB::table('applicant_recommendations')->where('vacancy_id', $id)->delete();

        // Hapus qualification terlebih dahulu
        $vacancy->qualification()->delete();

        // Hapus lowongan
        $vacancy->delete();

        return response()->json([
            'success' => true,
            'message' => 'Lowongan berhasil dihapus.'
        ], 200);
        
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ], 500);
    }
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