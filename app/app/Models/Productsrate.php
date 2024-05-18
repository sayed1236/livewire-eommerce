<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Productsrate extends Model 
{

    protected $table = 'products_rates';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('product_id');

    public function rated_product()
    {
        return $this->belongsTo('\Product');
    }

}