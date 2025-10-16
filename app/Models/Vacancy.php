<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'posisi',
        'tanggal_dibuka',
        'tanggal_ditutup',
        'usia',
        'jenis_kelamin',
        'pendidikan_terakhir',
        'jurusan',
        'pengalaman_kerja',
        'skill_teknis',
        'skill_non_teknis',
        'status_vaksinasi',
        'status_pernikahan',
        'tahun_lulus'
    ];
    // Relasi ke tabel Company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Relasi ke tabel Qualification
    public function qualification()
    {
        return $this->belongsTo(Qualification::class);
    }
}
