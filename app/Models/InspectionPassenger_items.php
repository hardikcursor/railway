<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionPassenger_items extends Model
{
    use HasFactory;

    
    public function answers()
    {
        return $this->hasMany(InspectionPassenger_items__answer::class);
    }
}
