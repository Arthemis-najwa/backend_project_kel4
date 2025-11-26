<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantFile extends Model
{
    use HasFactory;

    protected $table = 'applicant_files';

    protected $fillable = [
        'applicant_id',
        'link_dokumen',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
