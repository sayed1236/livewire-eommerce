<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderAddress extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['steps','order_id','stock_id','vendor_id','product_id','quantity','total_price','discount',
    'date_of_cancel','reason_if_cancel'];
    public function Order()
    {
        return  $this->belongsTo(Order::class);
    }
}
