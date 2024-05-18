<?php

namespace App\Models\Trader;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TraderDetails extends Model 
{

    protected $table = 'trader_details';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('start_date', 'brief','trader_id');

    public function trader()
    {
        return $this->belongsTo(Trader::class, 'trader_id');
    }

}