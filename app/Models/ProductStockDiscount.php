<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductStockDiscount extends Model
{

    protected $table = 'products_stock_discount';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('product_id', 'stock_id', 'quantity_from', 'quantity_to', 'discount_percent');
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
