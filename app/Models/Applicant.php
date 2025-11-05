<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'tanggal_lahir',
        'usia',
        'jenis_kelamin',
        'status_pernikahan',
        'alamat',
        'no_telp',
        'email',
        'pendidikan_terakhir',
        'jurusan',
        'tahun_lulus',
        'pengalaman_kerja',
        'skill_teknis',
        'skill_non_teknis',
        'status_vaksinasi',
        'perusahaan_tujuan'
    ];

    // ✔️ pakai singular karena hasOne
    public function qualification()
    {
        return $this->hasOne(ApplicantQualification::class);
    }

    // ✔️ hanya satu relasi recommendations
    public function recommendations()
    {
        return $this->hasMany(ApplicantRecommendation::class);
    }
}
