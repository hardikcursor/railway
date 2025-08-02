<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcel_Office_form extends Model
{
    use HasFactory;

        protected $fillable = [
        'inspection_id',
        'cbs_name',
        'no_of_duty_staff',
        'Sanctioned_Cadre',
        'Available',
        'Vacancy_Excess',
    ];
}
