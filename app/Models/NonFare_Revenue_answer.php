<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonFare_Revenue_answer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','nonfare_question_id', 'inspection_id', 'answer', 'remark'];

    protected $table = 'non_fare__revenue_answers';

    public function nonFareRevenueOffice()
    {
        return $this->belongsTo(NonFare_Revenue::class, 'nonfare_question_id', 'id');
    }
}
