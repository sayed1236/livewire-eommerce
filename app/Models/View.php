<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;
    protected $fillable=['views','product_id','user_ip','user_id'];
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
