<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    public function vacancies()
{
    return $this->hasMany(Vacancy::class);
}

}
