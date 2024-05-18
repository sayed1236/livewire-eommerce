<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['order_num','trader_id','status','is_done','order_total_price','barcode_num','delivering_cost','coupon_id',
    'coupon_discount','delivering_time'];

    public function order_address()
    {
        return $this->hasOne(OrderAddress::class, 'order_id','id');
    }
    public function orderproducts()
    {
        return  $this->hasMany(OrdersProduct::class);
    }
    public function address()
    {
        return  $this->hasOne(OrderAddress::class);
    }

}
