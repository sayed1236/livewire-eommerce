<?php

namespace App\Models\Trader;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trader extends Authenticatable 
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $table = 'traders';
    public $timestamps = true;
    protected $guard = 'trader';

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'email', 'address' ,'password','remember_token' ,'last_name', 'mobile', 'photo');

    public function rates()
    {
        return $this->hasMany(TraderRate::class);
    }

    public function contacts()
    {
        return $this->hasMany(TraderContacts::class);
    }

    public function details()
    {
        return $this->hasOne(TraderDetails::class);
    }

}