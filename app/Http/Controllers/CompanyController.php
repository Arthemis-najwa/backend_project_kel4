<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CompaniesExport;

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

        Company::create($request->all());
        return redirect()->route('perusahaan')->with('success', 'Data perusahaan berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return redirect()->route('perusahaan')->with('success', 'Data perusahaan berhasil dihapus!');
    }

     public function export($id)
    {
        $company = Company::findOrFail($id);
        $filename = 'pelamar_' . str_replace(' ', '_', strtolower($company->nama_perusahaan)) . '.xlsx';
        return Excel::download(new ApplicantsExport($company->id), $filename);
    }
     public function update(Request $request, $id)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'required|string',
            'bidang_usaha' => 'required|string',
        ]);

        $company = Company::findOrFail($id);
        $company->update($request->all());

        return redirect()->route('perusahaan')->with('success', 'Data perusahaan berhasil diperbarui!');
    }
}
