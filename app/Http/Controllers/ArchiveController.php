<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Applicant;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function index()
    {
        $title = "Data Arsip Pelamar";
        $archives = Archive::with('applicant')->get();
        return view('admin.arsip-data-pelamar', compact('archives','title'));
    }

    public function restore($id)
    {
        $applicant = Applicant::withTrashed()->find($id);
        if (! $applicant) {
            return response()->json(['message' => 'Applicant tidak ditemukan.'], 404);
        }

        $applicant->restore();

        Archive::where('applicant_id', $id)->delete();

        return response()->json(['message' => 'Pelamar berhasil dipulihkan!'], 200);
    }

    public function destroy($id)
    {
    
        $applicant = Applicant::withTrashed()->find($id);
        if (! $applicant) {
            return response()->json(['message' => 'Applicant tidak ditemukan.'], 404);
        }

        $applicant->forceDelete();


        Archive::where('applicant_id', $id)->delete();

        return response()->json(['message' => 'Data pelamar berhasil dihapus permanen!'], 200);
    }
}
