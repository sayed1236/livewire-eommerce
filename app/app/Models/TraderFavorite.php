<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraderFavorite extends Model
{
    use HasFactory;
    protected $fillable = ['is_active','user_ip','trader_id','favo_id'];
    public function product()
    {
        return $this->hasOne(Product::class,'id','favo_id');
    }
}
