<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Companybranch extends Model
{

    protected $table = 'company_branches';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('company_id', 'name', 'phone', 'address', 'email', 'end_time');

    public function company()
    {
        return $this->belongsTo('Company', 'company_id');
    }

    public function companyworkdays()
    {
        return $this->hasMany('Companydayswork', 'branch_id');
    }

}
