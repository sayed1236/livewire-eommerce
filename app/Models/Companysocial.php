<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Companysocial extends Model
{

    protected $table = 'company_social';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('company_id', 'social_id');

    public function company()
    {
        return $this->belongsTo('Company', 'company_id');
    }

    public function social()
    {
        return $this->belongsTo(Socials::class);
    }

}
