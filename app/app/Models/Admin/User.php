<?php

namespace App\Models\Admin;

use App\Models\MounyMounth;
use App\Models\Product;
use App\Models\Role;
use App\Models\Store;
use App\Models\TeamUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;
    use HasRoles;
    Protected $guard_name ='web';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','user_type_id','user_balance','mobile','national_id','notes','address','mobile_whats','member_plan','user_name','role_id', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function user_role()
    {
        return $this->belongsTo(Role::class,'role_id');
    }
    public function user_detail()
    {
        return $this->hasOne(UsersDetail::class);
    }

    public function user_team()
    {
        return $this->belongsTo(TeamUser::class,'id','user_id');
    }
    public function prodducts()
    {
        return $this->hasMany(Product::class);
    }
    public function rates()
    {
        return $this->hasMany(Rate::class,'rated_id');
    }
    public function motivation()
    {
        return $this->hasMany(MounyMounth::class,'user_id')->where('type','motivation')->whereMonth('created_at', '=',date('m'));
    }
    public function discount()
    {
        return $this->hasMany(MounyMounth::class,'user_id')->where('type','discount')->whereMonth('created_at', '=',date('m'));
    }
    public function advance()
    {
        return $this->hasMany(MounyMounth::class,'user_id')->where('type','advance')->whereMonth('created_at', '=',date('m'));
    }
    public function products()
    {
        return $this->hasMany(Product::class,'user_id');
    }
    public function store(){
        return $this->belongsTo(Store::class);
    }
}
