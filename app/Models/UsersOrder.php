<?php

namespace App\Models;

use App\Models\Admin\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsersOrder extends Model
{
    use SoftDeletes;
    protected $fillable=['order_num','type','parent_id','user_id','status','is_done','store_id','payment_type','payment_order_id','order_total_price','price_move','reason_if_cancel','steps','deliver_date','deliver_time','inbox_id','date_arrive','is_rated','is_active','lang','user_ip','user_pc_info'];

    public function get_new()
    {
        $result = new UsersOrder();
        $result->user_id=0;
        $result->payment_type=0;
        $result->order_total_price=0;
        $result->user_address=0;
        $result->latitude=0;
        $result->longitude=0;
        $result->price_move=0;
        return $result;
    }
    public function user_order_detail()
    {
        return $this->hasMany(UsersOrdersDetail::class,'order_id')->with('product');
    }
    public function user_order_adress()
    {
        return $this->hasOne(UsersOrdersAddress::class,'order_id')->with('governorate','city');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
