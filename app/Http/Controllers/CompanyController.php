<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CompaniesExport;
use Illuminate\Support\Facades\DB;

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
        $company = Company::findOrFail($id);
        $company->delete();
        return redirect()->route('perusahaan')->with('success', 'Data perusahaan berhasil dihapus!');
    }
    public function update(Request $request, $id)
{
    $company = Company::findOrFail($id);
     $company->update([
        'company_id' => $request->company_id,
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
