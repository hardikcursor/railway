<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coaching extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name',
        'Station',
        'Unreserved_Passengers',
        'Unreserved_Earning',
        'Reserved_Passengers',
        'Reserved_Earning',
        'Total_Passengers',
        'Total_Earning',
        'Date',
    ];

   
}
