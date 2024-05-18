<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    // protected $table = 'attributes';
    // public $timestamps = true;
    use HasFactory,SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'value', 'parent_id');
    public function get_new($type=0)
    {
        $result = new Attribute();
        $result->id=0;
        $result->name='';
        $result->ord= (Attribute::where(['type'=>$type])->count()) +1;
        $result->type= $type;
        // $result->category_id= $category_id;
        return $result;
    }
    public function attribute_values()
    {
        return $this->hasMany(Attribute::class,'parent_id');
    }
    public function main_attribute()
    {
        return $this->belongsTo(Attribute::class,'parent_id');
    }
    public function categories_attributes()
    {
        return $this->hasMany(Attributescategory::class);
    }
    // public function attribute_values()
    // {
    //     return $this->hasMany(AttributeValue::class,'attribute_id','id');
    // }
    public function attr_values()
    {
        return $this->hasMany(Attribute::class,'parent_id','id');
    }

}
