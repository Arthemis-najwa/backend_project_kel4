<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CompaniesExport;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
 
    public function index()
    {
        $companies = Company::latest()->get();
        return view('admin.companies', compact('companies'));
    }


    public function store(Request $request)
    {
        
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'required|string',
            'bidang_usaha' => 'required|string',
        ]);
        try{
        DB::beginTransaction();
        Company::create($request->all());
        DB::commit();
        return redirect()->route('perusahaan')->with('success', 'Data perusahaan berhasil ditambahkan!');
        } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
    }
    }
   public function destroy($id)
{
    try {
        $company = Company::findOrFail($id);

        // Cek lowongan dengan join ke company
        $vacancies = \DB::table('vacancies')
            ->where('company_id', $id)
            ->get();
        
        if ($vacancies->count() > 0) {
            $vacancyList = $vacancies->map(function($v) {
                return ['nama_posisi' => $v->posisi];
            })->toArray();
            
            return response()->json([
                'success' => false,
                'message' => '❌ Anda harus menghapus seluruh lowongan yang terkait dengan perusahaan ini terlebih dahulu',
                'lowongan_count' => $vacancies->count(),
                'lowongans' => $vacancyList
            ], 422);
        }

        // Cek pelamar melalui applicant_recommendations (join)
        // dan pelamarnya BELUM diarsipkan (deleted_at = NULL)
        $applicants = \DB::table('applicants')
            ->join('applicant_recommendations', 'applicants.id', '=', 'applicant_recommendations.applicant_id')
            ->join('vacancies', 'applicant_recommendations.vacancy_id', '=', 'vacancies.id')
            ->where('vacancies.company_id', $id)
            ->whereNull('applicants.deleted_at')  // Hanya ambil pelamar yang belum diarsipkan
            ->select('applicants.id', 'applicants.nama_lengkap')
            ->distinct()
            ->get();
        
        if ($applicants->count() > 0) {
            $applicantList = $applicants->map(function($a) {
                return ['nama_lengkap' => $a->nama_lengkap];
            })->toArray();
            
            return response()->json([
                'success' => false,
                'message' => '❌ Anda harus mengarsipkan seluruh pelamar terlebih dahulu',
                'pelamar_count' => $applicants->count(),
                'pelamars' => $applicantList
            ], 422);
        }

        // Hapus perusahaan
        $company->delete();

        return response()->json([
            'success' => true,
            'message' => 'Perusahaan berhasil dihapus.'
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
    $company = Company::findOrFail($id);

    $company->update([
        'nama_perusahaan' => $request->nama_perusahaan,
        'alamat' => $request->alamat,
        'kontak' => $request->kontak,
        'bidang_usaha' => $request->bidang_usaha,
    ]);

    return redirect()->back()->with('success', 'Perusahaan berhasil diupdate!');
}


    public function updateStatus(Request $request, $id)
{
    $company = Company::findOrFail($id);
    $company->status_lowongan = $request->status_lowongan;
    $company->save();

   if ($request->status_lowongan === 'Tutup') {
    foreach ($company->vacancies as $vacancy) {
        $vacancy->update(['status' => 'disabled']);

        foreach ($vacancy->applicants as $applicant) {
            $applicant->update(['status' => 'disabled']);
        }
    }
}

if ($request->status_lowongan === 'Buka') {
    foreach ($company->vacancies as $vacancy) {
        $vacancy->update(['status' => 'active']);

        foreach ($vacancy->applicants as $applicant) {
            $applicant->update(['status' => 'active']);
        }
    }
}


    return response()->json(['success' => true]);
}

}
