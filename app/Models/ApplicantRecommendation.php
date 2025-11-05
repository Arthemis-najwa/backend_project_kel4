<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantRecommendation extends Model
{
    use HasFactory;

    protected $fillable = ['applicant_id','vacancy_id','company_id','score'];

    protected $attributes = [
        'score' => 0
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
