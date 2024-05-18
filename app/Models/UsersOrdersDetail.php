<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersOrdersDetail extends Model
{
    public function get_new()
    {
        $result = new UsersOrdersDetail();
        $result->order_id=0;
        $result->user_id=0;
        $result->product_id=0;
        $result->quantity=0;
        $result->total_price=0;
        $result->discount=0;
        $result->user_notes='';
        return $result;
    }
    public function product()
    {
        return $this->belongsTo(Product::class)->with('product_attributes');
    }
    public function size()
    {
        return $this->hasOne(AttributeValue::class,'id','size_id');
    }
    public function color()
    {
        return $this->hasOne(AttributeValue::class,'id','color_id');
    }
    public function user_order()
    {
        return $this->hasOne(UsersOrder::class,'id','order_id');
    }
}
