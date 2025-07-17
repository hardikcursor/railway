<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionPantryCar extends Model
{
    use HasFactory;


    public function answers()
    {
        return $this->hasMany(InspectionPantryCar_answer::class);
    }
}
