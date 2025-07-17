<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StationCleanliness_answer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'station_clean_id', 'report_id', 'answer', 'Black','Blue','Green', 'remark'];
    protected $table = 'station_cleanliness_answers';

    public function stationCleanliness()
    {
        return $this->belongsTo(StationCleanliness::class, 'station_clean_id');
    }
}
