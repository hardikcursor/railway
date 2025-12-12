<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'NameInspection',
        'NameInspector',
        'Station',
        'TypeofInspection',
        'Duration',
        'date',
        'status',
    ];

    public function forwards()
    {
        return $this->hasMany(AdminReportForward::class, 'report_id', 'id');
    }
}
