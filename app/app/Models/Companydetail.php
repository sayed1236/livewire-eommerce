<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Companydetail extends Model
{

    protected $table = 'companies_details';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('company_id', 'commercial_lines', 'commercial_lines_file', 'taxes_licenses', 'taxes_icenses_file', 'started_date', 'brief', 'company_profile');

    public function company()
    {
        return $this->belongsTo('Company', 'company_id');
    }

}
