<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attributescategory extends Model
{

    protected $table = 'attribute_categories';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('category_id','attribute_id','is_main');

    public function attribute()
    {
        return $this->hasone(Attribute::class,'id','attribute_id')->with('attr_values','main_attribute');
    }

}
