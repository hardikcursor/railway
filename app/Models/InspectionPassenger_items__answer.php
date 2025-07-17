<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionPassenger_items__answer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'inspection_id', 'report_id', 'yes_no', 'remark'];

    protected $table = 'inspection_passenger_items__answers';

    public function inspectionPassengerItems()
    {
        return $this->belongsTo(InspectionPassenger_items::class, 'inspection_id');

    }
}
