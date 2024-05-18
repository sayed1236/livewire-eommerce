<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trader_History_Log extends Model
{
    use HasFactory;
    protected $table = 'trader_history_logs';
    protected $fillable=['product_id','user_ip','user_id'];
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
