<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingMs extends Model
{
    protected $table='setting_ms';
    use HasFactory;
    public function get_new()
    {
        $result = new SettingMs();
        $result->name='';
        $result->name_en='';
        $result->img='';
        $result->details='';
        $result->details_en='';
        $result->video='';
        $result->type= 0;
        return $result;
    }
}
