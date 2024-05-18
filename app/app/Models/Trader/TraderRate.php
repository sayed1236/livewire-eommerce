<?php

namespace App\Models\Trader;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TraderRate extends Model 
{

    protected $table = 'trader_rates';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('trader_id', 'user_id', 'rate', 'rate_comment');

    public function trader()
    {
        return $this->belongsTo(Trader::class, 'trader_id');
    }

}