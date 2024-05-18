<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];

    public function get_new($type=0, $parent_id=0)
    {
        $result = new Category();
        $result->id=0;
        $result->name='';
        $result->name_en='';
        $result->ord= (Category::where(['type'=>$type , 'parent_id' => $parent_id])->count()) +1;
        $result->img='';
        $result->img_nave='';
        $result->details='';
        $result->details_en='';
        $result->video='';
        $result->choose_viewd='';
        $result->parent_id= $parent_id;
        $result->type= $type;
        return $result;
    }

    function scopeIsActive() {
        return $this->where('is_active','Y');
    }
    function sub_category()
    {
        return  $this->hasMany(Category::class,'parent_id');
    }


    
  public function attributes()
    {
        return $this->hasManyThrough(Attribute::class, Attributescategory::class, 'category_id', 'id', 'id', 'attribute_id');
    }
   
    public function products_attributes()
    {
        return $this->hasMany(Productsattribute::class);
    }
    public function categories_attributes()
    {
        return $this->hasMany(Attributescategory::class);
    }
    public function parent()
    {
        return $this->belongsTo(Category::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
