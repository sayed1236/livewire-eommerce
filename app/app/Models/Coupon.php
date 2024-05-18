<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory,SoftDeletes;
    public function get_new($type=0)
    {
        $result = new Coupon();
        $result->id=0;
        $result->name='';
        $result->type=$type;
        $result->name_en='';
        $result->coupon_code=randomString();
        $result->date_expire=date_with_add_days();
        $result->max_num_uses='';
        $result->img='';
        $result->num_uses='';
        $result->amount='';
        $result->amount_taken='';
        return $result;
    }
}
