<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PRS_office_answer extends Model
{
  protected $fillable = ['user_id', 'prs_question_id', 'inspection_id', 'answer', 'remark'];
     protected $table = 'p_r_s_office_answers';

       public function PRS_office()
    {
        return $this->belongsTo(PRS_office::class, 'prs_question_id', 'id');
    }
}
