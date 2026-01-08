<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketChecking extends Model
{
    use HasFactory;

    protected $table = 'ticketcheckings';

    protected $fillable = [
        'date', 'staff', 'case', 'amount', 'avg_case', 'avg_amt', 'amt_ly',
    ];

    public function sleeper()
    {
        return $this->hasOne(SleeperCase::class);
    }

    public function stationery()
    {
        return $this->hasOne(Stationery::class);
    }

}
