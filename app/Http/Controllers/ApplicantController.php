<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\ApplicantQualification;
use App\Models\JobQualification;
use App\Models\Vacancy;
use App\Models\ApplicantRecommendation;
use Illuminate\Http\Request;
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
    $request->validate([
        'nama_lengkap'        => 'required|string|max:255',
        'tanggal_lahir'       => 'required|date',
        'usia'                => 'required|integer',
        'jenis_kelamin'       => 'required|in:L,P',
        'status_pernikahan'   => 'required|string|max:255',
        'alamat'              => 'required|string|max:255',
        'no_telp'             => 'required|string|max:255|regex:/^[0-9+\-\s]{8,15}$/',
        'email'               => 'required|email|max:255',
        'pendidikan_terakhir' => 'required|string|max:255',
        'jurusan'             => 'required|string|max:255',
        'tahun_lulus'         => 'required|integer|min:1900|max:' . date('Y'),
        'pengalaman_kerja'    => 'nullable|string',
        'skill_teknis'        => 'nullable|string',
        'skill_non_teknis'    => 'nullable|string',
        'status_vaksinasi'    => 'nullable|string|max:255',
        'perusahaan_tujuan'   => 'nullable|string|max:255',
    ], [
        'nama_lengkap.required' => 'Nama lengkap wajib diisi.',

        'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',

        'usia.required' => 'Usia wajib diisi.',
        'usia.integer' => 'Usia harus berupa angka.',

        'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',

        'status_pernikahan.required' => 'Status pernikahan wajib diisi.',

        'alamat.required' => 'Alamat wajib diisi.',
        'alamat.max' => 'Alamat maksimal 255 karakter.',

        'no_telp.required' => 'Nomor telepon wajib diisi.',
        'no_telp.regex' => 'Nomor telepon hanya boleh angka dan simbol + atau -.',

        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Masukkan format email yang valid, misalnya: nama@gmail.com.',
        'email.max' => 'Email maksimal 255 karakter.',

        'pendidikan_terakhir.required' => 'Pendidikan terakhir wajib diisi.',
        'jurusan.required' => 'Jurusan wajib diisi.',
        'tahun_lulus.required' => 'Tahun lulus wajib diisi.',
        'tahun_lulus.integer' => 'Tahun lulus harus berupa angka.',
        'tahun_lulus.min' => 'Tahun lulus tidak valid.',
        'tahun_lulus.max' => 'Tahun lulus tidak boleh melebihi tahun ini.',
    ]);
    $applicant = Applicant::create($request->except('_token'));

    $this->matchVacancies($applicant);

    // Proses forward chaining langsung pakai $applicant
    $vacancies = Vacancy::with('qualification')->get();

    foreach ($vacancies as $job) {
        $q = $job->qualification;

        if (
            $applicant->usia >= $q->usia_minimum &&
            $applicant->usia <= $q->usia_maksimum &&
            ($q->jenis_kelamin == null || $q->jenis_kelamin == $applicant->jenis_kelamin) &&
            $q->pendidikan == $applicant->pendidikan_terakhir &&
            ($q->jurusan == null || $q->jurusan == $applicant->jurusan) &&
            $applicant->pengalaman_kerja >= $q->pengalaman &&
            $applicant->status_vaksinasi == $q->status_vaksinasi
        ) {
            ApplicantRecommendation::create([
                'applicant_id' => $applicant->id,
                'company_id' => $job->company_id,
                'vacancy_id' => $job->id
            ]);
        }
    }

    return back()->with('success','Data pelamar berhasil ditambahkan ✅');
}


    protected function matchVacancies(Applicant $applicant)
{
    ApplicantRecommendation::where('applicant_id',$applicant->id)->delete();

    $vacancies = Vacancy::with('qualification','company')->get();

    foreach ($vacancies as $vacancy) {
        $q = $vacancy->qualification;
        if (!$q) continue;

        $score = 0;
        $totalCriteria = 8;

        if ($applicant->usia >= $q->usia_minimum && $applicant->usia <= $q->usia_maksimum) $score++;

        if (empty($q->jenis_kelamin) || strtolower($q->jenis_kelamin) === 'any' || strtolower($q->jenis_kelamin) === strtolower($applicant->jenis_kelamin)) $score++;

        if (!empty($q->pendidikan_terakhir) && strcasecmp($q->pendidikan_terakhir, $applicant->pendidikan_terakhir) === 0) $score++;

        if (!empty($q->jurusan) && stripos($applicant->jurusan, $q->jurusan) !== false) $score++;

        if (!empty($q->tahun_lulus) && $applicant->tahun_lulus == $q->tahun_lulus) $score++;

        if (!empty($q->pengalaman_kerja) && !empty($applicant->pengalaman_kerja)) {
            if (stripos($applicant->pengalaman_kerja, strtok($q->pengalaman_kerja, ' ')) !== false) $score++;
        }

        if (!empty($q->skill_teknis) && !empty($applicant->skill_teknis)) {
            $reqSkills = array_map('trim', explode(',', strtolower($q->skill_teknis)));
            $appSkills = strtolower($applicant->skill_teknis);
            foreach ($reqSkills as $rs) {
                if ($rs !== '' && stripos($appSkills, $rs) !== false) { 
                    $score++; 
                    break; 
                }
            }
        }

        if (!empty($q->status_vaksinasi) && !empty($applicant->status_vaksinasi) && strcasecmp($q->status_vaksinasi, $applicant->status_vaksinasi) === 0) $score++;

        $threshold = 3;

        if ($score >= $threshold) {
            ApplicantRecommendation::create([
                'applicant_id' => $applicant->id,
                'vacancy_id' => $vacancy->id,
                'company_id' => $vacancy->company_id,
                'score' => $score,
            ]);
        }
    }
}


    public function show($id)
    {
        $applicant = Applicant::with(['qualification','recommendations.company','recommendations.vacancy'])->findOrFail($id);
        return view('admin.applicants.show', compact('applicant'));
    }
}
