<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Productsstock extends Model
{

    protected $table = 'products_stocks';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = array('product_id', 'stock_id', 'quantity', 'buing_price', 'selling_price', 'date_of_enter', 'date_of_expire');
    public function product()

    {
        return $this->belongsto(Product::class);    }

        public function stock()

        {
            return $this->belongsto(Stock::class,'stock_id');
        }


    
}
