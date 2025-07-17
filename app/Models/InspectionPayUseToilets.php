<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionPayUseToilets extends Model
{
    use HasFactory;

    public function answers()
    {
        return $this->hasMany(InspectionPayUseToilets_answer::class);
    }
}
