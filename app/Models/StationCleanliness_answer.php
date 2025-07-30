<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StationCleanliness_answer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'stationclean_question_id', 'inspection_id', 'answer', 'Black','Blue','Green', 'remark'];
    protected $table = 'station_cleanliness_answers';

    public function stationCleanliness()
    {
        return $this->belongsTo(StationCleanliness::class, 'stationclean_question_id', 'id');
    }
}
