<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Companyrate extends Model
{

    protected $table = 'company_rates';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('company_id', 'user_id', 'rate', 'rate_comment');

    public function company()
    {
        return $this->belongsTo('Company', 'company_id');
    }

}
