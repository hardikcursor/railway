<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking_office_answer extends Model
{
    protected $fillable = ['user_id', 'booking_office_id', 'report_id','answer', 'remark'];

    protected $table = 'booking_office_answers';
    
    public function bookingOffice()
    {
        return $this->belongsTo(Booking_office::class,'q_id');
    }
}
