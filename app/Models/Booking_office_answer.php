<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking_office_answer extends Model
{
    protected $fillable = ['booking_office_id', 'remarks'];
    protected $table = 'booking_office_answers';
    
    public function bookingOffice()
    {
        return $this->belongsTo(Booking_office::class);
    }
}
