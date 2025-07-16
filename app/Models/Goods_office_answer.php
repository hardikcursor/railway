<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goods_office_answer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'goods_office_id', 'report_id', 'answer', 'remark'];

    protected $table = 'goods_office_answers';

    public function goodsShedOffice()
    {
        return $this->belongsTo(Goods_Shed_office::class);
    }
}
