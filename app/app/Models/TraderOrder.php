<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TraderOrder extends Model
{
    use HasFactory;
    public $timestamps = true;

    use SoftDeletes;

    protected $fillable = ['product_id','trader_id'];

    // public function product()
    // {
    //     return $this->hasOne(Product::class,'id','product_id')->with('latestProductStock','discounts_product');
    // }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
