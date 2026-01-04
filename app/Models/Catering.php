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
        'unit_type',
        'total_units',
        'annual_fee',
        'fee_paid',
    ];
}
