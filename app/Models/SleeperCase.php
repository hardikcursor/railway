<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SleeperCase extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_checking_id', 'staff', 'case', 'amount', 'avg_case', 'avg_amt', 'amt_ly',
    ];

    public function ticketChecking()
    {
        return $this->belongsTo(TicketChecking::class);
    }
}
