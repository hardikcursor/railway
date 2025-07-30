<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking_office_answer extends Model
{
    protected $fillable = ['user_id', 'booking_question_id', 'inspection_id','answer', 'remark'];

    protected $table = 'booking_office_answers';
    
    public function bookingOffice()
    {
        return $this->belongsTo(Booking_office::class,'booking_question_id', 'id');
    }
}
