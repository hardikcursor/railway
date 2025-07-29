<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inspectionkitchen_answer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'inspectionkitchen_question_id', 'report_id', 'answer', 'yes_no', 'remark'];

    protected $table = 'inspectionkitchen_answers';

    public function inspectionKitchen()
    {
        return $this->belongsTo(INSPECTIONKITCHEN::class, 'inspection_kitchen_id');
    }
}
