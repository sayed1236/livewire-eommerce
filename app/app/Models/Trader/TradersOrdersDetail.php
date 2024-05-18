<?php

namespace App\Models\Trader;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TradersOrdersDetail extends Model
{
    protected $table = 'traders_orders_details';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function size()
    {
        return $this->hasOne(ProductAttributeValues::class,'size_id');
    }
    public function color()
    {
        return $this->hasOne(ProductAttributeValues::class,'color_id');
    }
    public function trader_order()
    {
        return $this->hasOne(TradersOrders::class,'order_id');
    }
}
