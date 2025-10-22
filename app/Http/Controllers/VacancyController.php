<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacancyController extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'qualification_id',
        'posisi',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function qualification()
    {
        return $this->belongsTo(Qualification::class);
    }
}
