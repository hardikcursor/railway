<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking_office_form extends Model
{
    use HasFactory;

    protected $table = 'booking_office_forms';

    protected $fillable = [
        'inspection_id',
        'cbs_name',
        'no_of_duty_staff',
        'Sanctioned_Cadre',
        'Available',
        'Vacancy',
        'No_of_Counters',
        'UTS',
        'PRS',
        'UTS_PRS',
    ];
}
