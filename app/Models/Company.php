<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';
    protected $fillable = [
        'nama_perusahaan',
        'alamat',
        'kontak',
        'bidang_usaha'
    ];

    public function vacancies()
{
    return $this->hasMany(Vacancy::class);
}
}
