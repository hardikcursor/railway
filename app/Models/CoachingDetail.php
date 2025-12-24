<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoachingDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'coaching_id',
        'type',
        'class',
        'passenger',
        'revenue',
    ];
}
