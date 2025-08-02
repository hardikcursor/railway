<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionPayUseToilets_location_form extends Model
{
    use HasFactory;

      protected $fillable = [
        'inspection_id',
        'location',
        'Gents',
        'Ladies',
        'Gents_Urinals',
        'Ladies_Urinals',
        'Divyang',
    ];
}
