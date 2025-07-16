<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket_Examineroffice extends Model
{
    use HasFactory;

      public function answers()
    {
        return $this->hasMany(Ticket_office_answer::class);
    }
}
