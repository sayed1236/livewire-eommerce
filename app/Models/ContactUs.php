<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUs extends Model
{
    protected $table='contact_us';
    public $timestamps=false;
    use HasFactory;
    use SoftDeletes;
    public static function boot()
    {
        parent::boot();
        static::creating(function($model){
            $model->created_at=$model->freshTimestamp();
        });
    }
    public function get_new()
    {
        $result = new ContactUs();
        $result->name='';
        $result->name_en='';
        $result->img='';
        $result->details='';
        $result->details_en='';
        $result->video='';
        $result->parent_id= 0;
        $result->type= 0;
        return $result;
    }
}
