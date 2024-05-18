<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['name','img','category_id','company_id','describtion','type','product_code','discount',
    'ord','tag','is_used','classification_id','img','details','store_id','min_amount_to_buy','stoke_id','barcode_number'];
    public function get_new()
    {

        $result = new Product();
        $result->id=0;
        $result->category_id=0;
        $result->brand_id=0;
        $result->type=0;
        $result->name='';
        $result->name_en='';
        $result->product_code='';
        $result->barcode_number='';
        $result->discount='';
        $result->ord=Product::count()+1;
        $result->img='';
        $result->tag='';
        $result->tag_en='';
        $result->is_used='';
        $result->classification_id='';
        $result->details='';
        $result->details_en='';
        $result->color_id=0;
        $result->price=0;
        $result->import_price=0;
        $result->store_id=0;
        $result->stoke_id=0;
        return $result;
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

   
    public function trader_orders_details()
    {
        return $this->hasMany(TradersOrdersDetail::class);
    }
    public function trader()
    {
        return $this->hasOne(Trader::class,'id','trader_id');
    }
    public function rates()
    {
        return $this->hasMany(ProductRate::class,'product_id','id');
    }
    public function rate()
    {
        return $this->hasOne('\Productsrate');
    }
    public function product_stocks()
    {
        return $this->hasMany('Productsstock');
    }

    public function copany()
    {
        return $this->belongsTo('Company');
    }

    public function trader_history_logs()
    {
        return $this->hasMany(Trader_History_Log::class);
    }

    public function products_rates()
    {
        return $this->hasMany(Productsrate::class,'product_id','id');
    }

    public function discounts_product(){
        return $this->hasMany(ProductStockDiscount::class);

    }
    public function vendor()
    {
        return $this->belongsTo(Company::class,'company_id');
    }
    public function prouct_price()
    {
        return $this->hasMany(ProductStockDiscount::class);
    }
    public function latestProductStock()
    {
        return $this->hasOne(Productsstock::class)->orderBy('created_at','desc')->with('stock');
    }

    public function products_attributes()
    {

        return $this->hasMany(ProductAttribute::class,'product_id')->with('atrribute');
    }

    public function attributes()
    {
        return $this->hasManyThrough(Attribute::class,Productsattribute::class,'product_id','id','id','attribute_category_id');
    }
    public function atts_cats()
    {
        return $this->hasMany(ProductAttribute::class,'product_id')->with('attrcats');
    }


    public function products_gallaries()
    {
        return $this->hasMany(ProductsGallary::class);
    }

}
