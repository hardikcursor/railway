<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PRS_office_answer extends Model
{
  protected $fillable = ['user_id', 'prs_office_id', 'report_id', 'answer', 'remark'];
   

       public function PRS_office()
    {
        return $this->belongsTo(PRS_office::class, 'prs_office_id');
    }
}
