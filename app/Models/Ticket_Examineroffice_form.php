<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket_Examineroffice_form extends Model
{
    use HasFactory;

    protected $fillable = [
        'inspection_id',
        'cti_name',
        'no_of_duty_staff',
        'Sanctioned_Cadre',
        'Available',
        'Vacancy_Excess',
    ];
}
