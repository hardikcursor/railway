<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcel_Office extends Model
{
    use HasFactory;

    
      public function answers()
    {
        return $this->hasMany(Parcel_answer::class);
    }
}
