<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialMedia extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function get_new()
    {
        $result = new SocialMedia();
        $result->id=0;
        $result->name='';
        $result->ord_footer=$result->ord= SocialMedia::count()+1;
        $result->img='';
        $result->img_type='img';
        $result->class_so='';
        $result->url_link='';
        return $result;
    }
}
