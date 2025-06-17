<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outward_Freight_Register extends Model
{
protected $fillable = [
    'dvsn',
    'station_from',
    'station_to',
    'rr_number',
    'rr_date',
    'invoice_date',
    'cmdt_code',
    '8_WHLR',
    'weight_chrg',
    'total_frgt',
    'siding_type',
    'rake_type',
    'wagon_type',
];


}
