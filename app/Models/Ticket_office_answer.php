<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket_office_answer extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'ticket_office_id', 'report_id', 'answer', 'remark'];

    protected $table = 'ticket_office_answers';
    public function ticketOffice()
    {
        return $this->belongsTo(Ticket_Examineroffice::class);
    }
}
