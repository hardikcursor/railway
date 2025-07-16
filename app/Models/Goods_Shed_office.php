<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goods_Shed_office extends Model
{
    use HasFactory;  


     public function answers()
    {
        return $this->hasMany(Goods_office_answer::class);
    }
    
}
