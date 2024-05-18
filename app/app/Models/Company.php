<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends  Authenticatable
{
    protected $guard = 'companies';

    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'img', 'mobile', 'email', 'password', 'logo');


    public function companydetail()
    {
        return $this->hasOne('App/Models\Companydetail', 'company_id');
    }

    public function companybranches()
    {
        return $this->hasMany('App/Models\Companybranch', 'company_id');
    }

    public function companysocials()
    {
        return $this->hasMany('App/Models\Companysocial', 'company_id');
    }

    public function companyrates()
    {
        return $this->hasMany('App/Models\Companyrate', 'company_id');
    }

    public function companygallery()
    {
        return $this->hasMany(Companygallery::class);
    }

    public function companycontactus()
    {
        return $this->hasMany('App/Models\Companycontactus', 'company_id');
    }

}
