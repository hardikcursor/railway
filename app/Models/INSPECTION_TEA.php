<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class INSPECTION_TEA extends Model
{
    use HasFactory;


    public function answers()
    {
        return $this->hasMany(inspection_tea_answer::class);
    }
}
