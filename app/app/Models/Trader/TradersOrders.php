<?php

namespace App\Models\Trader;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TradersOrders extends Model
{
    protected $table = 'traders_orders';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('order_num','type','trader_id','status','is_done','store_id','payment_type','payment_order_id','order_total_price','price_move','reason_if_cancel','steps','deliver_date','deliver_time','inbox_id','date_arrive','is_rated','is_active','user_ip','user_pc_info');

    public function trader_order_detail()
    {
        return $this->hasMany(TradersOrdersDetail::class);
    }
}
