<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PRS_office extends Model
{
    use HasFactory;

    public function answers()
    {
        return $this->hasMany(PRS_office_answer::class);
    }
}
