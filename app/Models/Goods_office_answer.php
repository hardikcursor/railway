<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goods_office_answer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'goods_question_id', 'inspection_id','answer', 'remark'];

    protected $table = 'goods_office_answers';

    public function goodsOffice()
    {
        return $this->belongsTo(Goods_Shed_office::class, 'goods_question_id', 'id');
    }
}
