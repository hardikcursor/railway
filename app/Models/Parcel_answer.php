<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcel_answer extends Model
{
     protected $fillable = ['user_id', 'parcel_question_id', 'inspection_id', 'answer', 'remark'];

    protected $table = 'parcel_answers';

    public function parcelOffice()
    {
        return $this->belongsTo(Parcel_Office::class, 'parcel_question_id', 'id');
    }
}
