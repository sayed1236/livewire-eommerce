<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CountriesCity extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'parent_id',  'name', 'name_en', 'currency_code',
        'currency_code_en', 'country_code', 'dail_code','delivery_price','fast_delivery_price', 'user_pc_info'
    ];

    public function get_new($parent_id=0)
    {
        $result = new CountriesCity();
        $result->id=0;
        $result->name='';
        $result->name_en='';
        $result->ord= (CountriesCity::where('parent_id', $parent_id)->count()) +1;
        $result->img='';
        $result->flag='';
        $result->currency_code='';
        $result->currency_code_en='';
        $result->country_code='';
        $result->dail_code='';
        $result->delivery_price=0;
        $result->fast_delivery_price=0;
        $result->parent_id= $parent_id;
        return $result;
    }
    function cities()
    {
        return  $this->hasMany(CountriesCity::class,'parent_id')->where('is_active','Y');
    }
}
