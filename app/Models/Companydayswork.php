<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Companydayswork extends Model
{

    protected $table = 'Company_days_work';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('company_id', 'branch_id', 'day', 'start_time', 'end_time');

    public function companybranche()
    {
        return $this->belongsTo('Companybranch', 'branch_id');
    }

}
