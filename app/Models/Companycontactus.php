<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Companycontactus extends Model
{

    protected $table = 'companies_contact_us';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('message', 'parent_id', 'company_id', 'user_id');

    public function company()
    {
        return $this->belongsTo('Company', 'company_id');
    }

}
