<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inspection_tea_answer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'inspectiontea_question_id', 'inspection_id','yes_no', 'answer', 'remark'];

    protected $table = 'inspection_tea_answers';

    public function inspectionTea()
    {
        return $this->belongsTo(INSPECTION_TEA::class, 'inspectiontea_question_id', 'id');
    }
}
