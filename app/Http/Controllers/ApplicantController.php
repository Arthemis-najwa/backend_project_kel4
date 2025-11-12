<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\ApplicantRecommendation;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Models\ApplicantFile;
use Illuminate\Support\Facades\DB;

class ApplicantController extends Controller
{

    public function index()
    {
        $title = "Data Pelamar";
        $applicants = Applicant::with('recommendations.vacancy.company')->get();

        return view('admin.pelamar', compact('applicants', 'title'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap'        => 'required|string|max:255',
            'tanggal_lahir'       => 'required|date',
            'usia'                => 'required|integer|min:17',
            'jenis_kelamin'       => 'required|string|max:1',
            'status_pernikahan'   => 'required|string|max:255',
            'alamat'              => 'required|string|max:255',
            'no_telp'             => 'required|string|max:20',
            'email'               => 'required|email',
            'pendidikan_terakhir' => 'required|string|max:255',
            'jurusan'             => 'required|string|max:255',
            'tahun_lulus'         => 'required|integer',
            'pengalaman_kerja'    => 'nullable|string',
            'skill_teknis'        => 'nullable|string',
            'skill_non_teknis'    => 'nullable|string',
            'status_vaksinasi'    => 'nullable|string',
            'perusahaan_tujuan'   => 'nullable|string',
            'link_dokumen'        => 'nullable|url',
        ]);
        try{
        DB::beginTransaction();
        $applicant = Applicant::create($request->except('_token'));
        if ($request->filled('link_dokumen')) {
        ApplicantFile::create([
            'applicant_id' => $applicant->id,
            'link_dokumen' => $request->link_dokumen,
        ]);
    }
        $this->matchVacancies($applicant);
    DB::commit();
        return back()->with('success', 'Data pelamar berhasil ditambahkan dan direkomendasikan otomatis!');
    }catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
    }
    }
    public function update(Request $request, $id)
    {
        $applicant = Applicant::findOrFail($id);

        $request->validate([
            'nama_lengkap'        => 'required|string|max:255',
            'tanggal_lahir'       => 'required|date',
            'usia'                => 'required|integer|min:17',
            'jenis_kelamin'       => 'required|string|max:1',
            'status_pernikahan'   => 'required|string|max:255',
            'alamat'              => 'required|string|max:255',
            'no_telp'             => 'required|string|max:20',
            'email'               => 'required|email|unique:applicants,email,' . $applicant->id,
            'pendidikan_terakhir' => 'required|string|max:255',
            'jurusan'             => 'required|string|max:255',
            'tahun_lulus'         => 'required|integer',
            'pengalaman_kerja'    => 'nullable|string',
            'skill_teknis'        => 'nullable|string',
            'skill_non_teknis'    => 'nullable|string',
            'status_vaksinasi'    => 'nullable|string',
            'perusahaan_tujuan'   => 'nullable|string',
            'link_dokumen'        => 'nullable|url',
        ]);
try{
        DB::beginTransaction();
        $applicant->update($request->except('_token'));

        $this->matchVacancies($applicant);
DB::commit();
        return back()->with('success', 'Data pelamar berhasil diperbarui dan rekomendasi diperbarui otomatis!');
       }catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
    } 
    }

    public function destroy($id)
    {
        $applicant = Applicant::findOrFail($id);

        ApplicantRecommendation::where('applicant_id', $id)->delete();

        $applicant->delete();

        return back()->with('success', 'Data pelamar dan rekomendasinya berhasil dihapus!');
    }

    protected function matchVacancies(Applicant $applicant)
    {
        ApplicantRecommendation::where('applicant_id', $applicant->id)->delete();

        $vacancies = Vacancy::with(['qualification', 'company'])->get();

        foreach ($vacancies as $vacancy) {
            $q = $vacancy->qualification;
            if (!$q) continue;

            $score = 0;

    
            if ($applicant->usia >= $q->usia_minimum && $applicant->usia <= $q->usia_maksimum) $score += 1;

      
            if (empty($q->jenis_kelamin) || strtolower($q->jenis_kelamin) === 'any' || strtolower($q->jenis_kelamin) === strtolower($applicant->jenis_kelamin)) $score += 1;

            
            if (!empty($q->pendidikan_terakhir) && strcasecmp($q->pendidikan_terakhir, $applicant->pendidikan_terakhir) === 0) $score += 1;

     
            if (!empty($q->jurusan) && strcasecmp($q->jurusan, $applicant->jurusan) === 0) $score += 2;

         
            if (!empty($q->tahun_lulus) && $applicant->tahun_lulus == $q->tahun_lulus) $score += 1;


            if (!empty($q->pengalaman_kerja) && !empty($applicant->pengalaman_kerja)) {
                $expKeywords = explode(' ', strtolower($q->pengalaman_kerja));
                foreach ($expKeywords as $kw) {
                    if (strlen($kw) > 3 && stripos(strtolower($applicant->pengalaman_kerja), $kw) !== false) {
                        $score += 2;
                        break;
                    }
                }
            }

                if (!empty($q->skill_teknis) && !empty($applicant->skill_teknis)) {
                $reqSkills = array_map('trim', explode(',', strtolower($q->skill_teknis)));
                $appSkills = strtolower($applicant->skill_teknis);
                foreach ($reqSkills as $rs) {
                    if ($rs !== '' && stripos($appSkills, $rs) !== false) {
                        $score += 1;
                        break;
                    }
                }
            }


            if (!empty($q->status_vaksinasi) && !empty($applicant->status_vaksinasi) &&
                strcasecmp($q->status_vaksinasi, $applicant->status_vaksinasi) === 0) {
                $score += 1;
            }

    
            $threshold = 6;

            if ($score >= $threshold) {
                ApplicantRecommendation::create([
                    'applicant_id' => $applicant->id,
                    'vacancy_id'   => $vacancy->id,
                    'company_id'   => $vacancy->company_id,
                    'score'        => $score,
                ]);
            }
        }
    }

  
    public function show($id)
    {
        $applicant = Applicant::with(['recommendations.vacancy.company'])->findOrFail($id);
        return view('admin.applicants.show', compact('applicant'));
    }
}
