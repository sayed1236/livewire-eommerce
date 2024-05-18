<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAttribute extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='products_attributes';
    protected $fillable=['product_id','att_cat_id','size_id','color_id','amount','price','img'];
    public function get_new($product_id=0)
    {
        $result = new ProductAttribute();
        $result->id=0;
        $result->product_id=$product_id;
        $result->att_cat_id=0;
        $result->size_id=0;
        $result->color_id=0;
        $result->amount='';
        $result->price='';
        $result->img='';
        $result->ord=ProductAttribute::where('product_id',@$product_id)->count()+1;
        return $result;
    }
    public function size()
    {
        return $this->hasOne(AttributeValue::class,'id','size_id');
    }
    public function color()
    {
        return $this->hasOne(AttributeValue::class,'id','color_id');
    }
    public function atrribute()
    {
        return $this->hasManyThrough(Attribute::class,Attributescategory::class,'attribute_id','att_cat_id','id','id');
    }
    public function attrcats()
    {
        return $this->belongsTo(Attributescategory::class,'attribute_category_id')->with('attribute');
    }
}
