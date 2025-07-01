<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking_office extends Model
{
    use HasFactory;


    public function answers()
    {
        return $this->hasMany(Booking_office_answer::class);
    }
}
