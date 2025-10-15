<?php

namespace App\Exports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CompaniesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Company::select('id', 'nama_perusahaan', 'alamat', 'kontak', 'bidang_usaha', 'created_at')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Nama Perusahaan', 'Alamat', 'Kontak', 'Bidang Usaha', 'Dibuat Pada'];
    }
}
