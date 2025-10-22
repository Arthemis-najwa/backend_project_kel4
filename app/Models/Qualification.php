<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id',
        'status_vaksinasi',
        'status_pernikahan',
        'jenis_kelamin',
        'usia',
        'vacancy_id',
        'pendidikan_terakhir',
        'jurusan',
        'tahun_lulus',
        'pengalaman_kerja',
        'skill_teknis',
        'skill_non_teknis',
    ];

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }
}

