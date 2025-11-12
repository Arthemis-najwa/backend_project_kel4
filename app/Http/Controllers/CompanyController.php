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

    public function exportApplicants($id)
{
    $company = Company::findOrFail($id);
    $filename = 'applicants_for_' . Str::slug($company->nama_perusahaan) . '.xlsx';
    return Excel::download(new ApplicantsForCompanyExport($id), $filename);
}
     public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'required|string',
            'bidang_usaha' => 'required|string',
        ]);
        try{
        DB::beginTransaction();
        $company->update($request->all());
        DB::commit();
        return redirect()->route('perusahaan')->with('success', 'Data perusahaan berhasil diperbarui!');
        } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
    }
    }
}
