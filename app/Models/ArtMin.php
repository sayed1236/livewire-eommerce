<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArtMin extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function get_new($type=0,$category_id=0)
    {
        $result = new ArtMin();
        $result->id=0;
        $result->name='';
        $result->name_en='';
        $result->ord= (ArtMin::where(['type'=>$type, 'category_id'=>$category_id])->count()) +1;
        $result->img='';
        $result->details='';
        $result->details_en='';
        $result->video='';
        $result->category_id= $category_id;
        $result->type= $type;
        return $result;
    }
}
