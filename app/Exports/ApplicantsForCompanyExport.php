<?php
namespace App\Exports;

use App\Models\Applicant;
use App\Models\ApplicantRecommendation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ApplicantsForCompanyExport implements FromCollection, WithHeadings
{
    protected $companyId;
    public function __construct($companyId){ $this->companyId = $companyId; }

    public function collection()
    {
        $applicantIds = ApplicantRecommendation::where('company_id', $this->companyId)
            ->pluck('applicant_id')->unique()->toArray();

        return Applicant::whereIn('id',$applicantIds)
            ->select(['id','nama_lengkap','tanggal_lahir','usia','jenis_kelamin','email','no_telp','pendidikan_terakhir','jurusan'])
            ->get();
    }

    public function headings(): array
    {
        return ['ID','Nama','Tanggal Lahir','Usia','Jenis Kelamin','Email','No Telp','Pendidikan','Jurusan'];
    }
}
