<?php

namespace App\Models\Trader;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TraderContacts extends Model 
{

    protected $table = 'trader_contacts';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('trader_id', 'parent_id', 'message', 'user_id');

    public function trader()
    {
        return $this->belongsTo(Trader::class, 'trader_id');
    }

}