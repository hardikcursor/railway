<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionPayUseToilets_answer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'inspection_pay_id', 'report_id', 'Remar_Observations','Minor_deficiencies','Major_deficiencies_Proposed','remark'];

    protected $table = 'inspection_pay_use_toilets_answers';

    public function inspectionPayUseToilets()
    {
        return $this->belongsTo(InspectionPayUseToilets::class, 'inspection_pay_id');
    }
}
