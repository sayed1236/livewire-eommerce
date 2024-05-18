<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Socials extends Model
{

    protected $table = 'socials';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'icon', 'name_url');

    public function companysocial()
    {
        return $this->hasMany('Companysocial', 'social_id');
    }

}
