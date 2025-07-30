<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionPantryCar_answer extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'inspection_pantry_question_id', 'inspection_id', 'answer', 'remark'];
    protected $table = 'inspection_pantry_car_answers';

    public function inspectionPantryCar()
    {
        return $this->belongsTo(InspectionPantryCar::class, 'inspection_id', 'id');
    }
}
