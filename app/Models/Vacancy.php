<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'qualification_id',
        'posisi',
    ];

    public function company()
{
    return $this->belongsTo(Company::class, 'company_id');
}
    public function qualification()
{
    return $this->hasOne(Qualification::class);
}
public function applicants()
{
    return $this->hasMany(Applicant::class);
}


}
