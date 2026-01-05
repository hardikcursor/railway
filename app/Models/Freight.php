<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freight extends Model
{
    use HasFactory;

    protected $fillable = [
        'div', 'station_from', 'station_to', 'rr_number', 'rr_date',
        'rr_e_rr', 'rr_et_rr', 'traffic_type', 'paid_type', 'flag',
        'invoice_no', 'invoice_date', 'cmdt_code',
        'cnsr_code', 'cnsg_code', 'eight_wheeler', 'payment_mode', 'paid_by',
        'distance_chrg', 'weight_chrg', 'weight_actl', 'weight_pol1', 'weight_pol2',
        'chbl_class', 'rate_per_ton', 'basic_frgt',
        'total_frgt', 'fr_sort', 'fr_month', 'fr_year', 'fr_year_2',
    ];
}
