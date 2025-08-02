<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionPantryCar_form extends Model
{
    use HasFactory;

    protected $fillable = [
        'inspection_id',
        'date_of_inspection',
        'train_no',
        'train_name',
        'inspecting_official',
        'designation',
        'pantry_car_no',
        'pantry_car_manager',
        'contractor_name',
        'irctc_supervisor',
    ];
}
