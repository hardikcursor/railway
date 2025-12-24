<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketChecking extends Model
{
    use HasFactory;

     protected $table = 'ticketcheckings';

    protected $fillable = [
        'cadre',
        'location',
        'cases',
        'revenue',
    ];
}
