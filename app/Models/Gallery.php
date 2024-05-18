<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function get_new($type=0,$cat_id=0)
    {
        $result = new Gallery();
        $result->id=0;
        $result->name='';
        $result->name_en='';
        $result->ord= Gallery::where(['type'=>$type])->count()+1;
        $result->img='';
        $result->cat_id= $cat_id;
        $result->type= $type;
        return $result;
    }
   
}
