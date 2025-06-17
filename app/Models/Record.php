<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = [
        'Station', 'UR_Pass', 'UR_Earning', 'Rsvd_Pass', 'Rsvd_Earning',
        'Date', 'UR_Pass_Lakh', 'UR_Er_Cr', 'Rsvd_Pass_Lakh', 'Rsvd_Er_Cr',
        'Total_Pass_Lakh', 'Total_Er_Cr', 'Month', 'M_short', 'Year', 'FY', 'T_short',
    ];
}
