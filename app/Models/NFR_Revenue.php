<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NFR_Revenue extends Model
{
 protected $fillable = [
    'station',
    'location',
    'station_category',
    'unit_policy',
    'type_of_unit',
    'area_in_sqm',
    'period_in_months',
    'period_start',
    'expiring_on',
    'yearly_license_fees',
    'fee_paid_upto_month',
    'fee_paid_upto_rs',
];
}
