<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Productsattribute extends Model
{

    protected $table = 'products_attributes';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('prod_id', 'att_cat_id');

    public function attributes()
    {
        return $this->hasManyThrough('Attribute', 'Attributescategory');
    }

}
