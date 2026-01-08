<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catering extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'station',
        'name_of_unit',
        'type_of_unit',
        'platform_no',
        'annual_license_fee',
        'category_of_unit',
        'unit_allotted',
        'date_of_commencement',
    ];

    protected $dates = ['date_of_commencement'];
}
