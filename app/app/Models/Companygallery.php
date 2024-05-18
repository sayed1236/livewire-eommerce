<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Companygallery extends Model
{

    protected $table = 'company_gallery';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('branch_id', 'company_id', 'path', 'type');

    public function company()
    {
        return $this->belongsTo('Company', 'company_id');
    }

}
