<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use App\Models\Company;
use App\Models\Qualification;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    // Menampilkan semua data lowongan
    public function index()
    {
        // Ambil data perusahaan dan kualifikasi
        $companies = Company::all();
        $qualifications = Qualification::all();

        // Ambil data lowongan + relasi ke perusahaan & kualifikasi
        $vacancies = Vacancy::with(['company', 'qualification'])->get();

        return view('admin.lowongan-pekerjaan', compact('vacancies', 'companies', 'qualifications'));
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'qualification_id' => 'required|exists:qualifications,id',
            'posisi' => 'required|string|max:255',
        ]);

        Vacancy::create([
            'company_id' => $request->company_id,
            'qualification_id' => $request->qualification_id,
            'posisi' => $request->posisi,
        ]);

        return redirect()->back()->with('success', 'Lowongan berhasil ditambahkan!');
    }

    // Menampilkan data untuk diedit
    public function edit($id)
    {
        $vacancy = Vacancy::findOrFail($id);
        $companies = Company::all();
        $qualifications = Qualification::all();

        return view('admin.lowongan-edit', compact('vacancy', 'companies', 'qualifications'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'qualification_id' => 'required|exists:qualifications,id',
            'posisi' => 'required|string|max:255',
        ]);

        $vacancy = Vacancy::findOrFail($id);
        $vacancy->update($request->all());

        return redirect()->back()->with('success', 'Data lowongan berhasil diperbarui!');
    }

    // Hapus data
    public function destroy($id)
    {
        $vacancy = Vacancy::findOrFail($id);
        $vacancy->delete();

        return redirect()->back()->with('success', 'Lowongan berhasil dihapus!');
    }

    // 🔄 Logika hide/show berdasarkan status perusahaan
    public function toggleVisibility(Request $request)
    {
        $companyId = $request->company_id;
        $status = $request->status; // 'dibuka' atau 'ditutup'

        if ($status === 'ditutup') {
            // Menyembunyikan lowongan tanpa menghapus data
            Vacancy::where('company_id', $companyId)->update(['is_hidden' => true]);
        } else {
            // Menampilkan kembali lowongan
            Vacancy::where('company_id', $companyId)->update(['is_hidden' => false]);
        }

        return response()->json(['message' => 'Status lowongan diperbarui.']);
    }
}
