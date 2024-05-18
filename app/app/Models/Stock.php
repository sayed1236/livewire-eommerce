<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{

    protected $table = 'stocks';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('company_id', 'stock_name', 'stock_id_num', 'address', 'notes','is_active');

    public function company()
    {
        return $this->belongsTo('Company');
    }
    public function stock_products()
    {
        return $this->hasMany(Productsstock::class)->with('product');
    }


}
