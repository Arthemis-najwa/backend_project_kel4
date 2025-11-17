<?php

namespace App\Exports;

use App\Models\Applicant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ApplicantsExport implements 
    FromCollection, 
    WithHeadings, 
    WithMapping, 
    ShouldAutoSize,
    WithStyles,
    WithEvents
{
    protected $vacancyId;
    protected $rowNumber = 0;

    public function __construct($vacancyId)
    {
        $this->vacancyId = $vacancyId;
    }

    public function collection()
    {
        return Applicant::whereHas('recommendations', function($q) {
                $q->where('vacancy_id', $this->vacancyId);
            })
            ->with('recommendations.vacancy.company')
            ->orderBy('nama_lengkap', 'ASC')
            ->orderBy('created_at', 'DESC')       
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Lengkap',
            'Tanggal Lahir',
            'Usia',
            'Jenis Kelamin',
            'Status Pernikahan',
            'Alamat',
            'No Telepon',
            'Email',
            'Pendidikan Terakhir',
            'Jurusan',
            'Tahun Lulus',
            'Pengalaman Kerja',
            'Skill Teknis',
            'Skill Non Teknis',
            'Status Vaksinasi',
            'Perusahaan Tujuan',
            'Lowongan Direkomendasikan',
            'Perusahaan',
            'Status Rekomendasi',
            'Tanggal Daftar',
        ];
    }

    public function map($applicant): array
    {
        $this->rowNumber++;

        $recommendation = $applicant->recommendations
            ->where('vacancy_id', $this->vacancyId)
            ->first();

        return [
            $this->rowNumber,
            $applicant->nama_lengkap,
            $applicant->tanggal_lahir,
            $applicant->usia,
            $applicant->jenis_kelamin,
            $applicant->status_pernikahan,
            $applicant->alamat,
            $applicant->no_telp,
            $applicant->email,
            $applicant->pendidikan_terakhir,
            $applicant->jurusan,
            $applicant->tahun_lulus,
            $applicant->pengalaman_kerja,
            $applicant->skill_teknis,
            $applicant->skill_non_teknis,
            $applicant->status_vaksinasi,
            $applicant->perusahaan_tujuan,
            $recommendation->vacancy->posisi ?? '-',
            $recommendation->vacancy->company->nama_perusahaan ?? '-',
            $recommendation->status ?? '-',
            $applicant->created_at->format('Y-m-d'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // header bold + background
        $sheet->getStyle('A1:U1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'fill' => [
                'fillType' => 'solid',
                'color' => ['rgb' => '4A90E2']
            ],
            'alignment' => [
                'horizontal' => 'center'
            ]
        ]);

        return [];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                // Tambah border ke semua data
                $lastRow = $sheet->getHighestRow();
                $sheet->getStyle("A1:U{$lastRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => 'thin',
                            'color' => ['rgb' => '000000']
                        ]
                    ]
                ]);

                // Filter Excel otomatis
                $sheet->setAutoFilter("A1:U1");

                // Auto size column
                foreach (range('A','U') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            }
        ];
    }
}
