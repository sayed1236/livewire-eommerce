<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagesMnu extends Model
{
    use HasFactory;
    public function get_new($parent_id)
    {
        $result = new PagesMnu();
        $result->name='';
        $result->name_en='';
        $result->ord= PagesMnu::where('parent_id',$parent_id)->count()+1;
        $result->img='';
        $result->details='';
        $result->details_en='';
        $result->video='';
        $result->parent_id= $parent_id;
        return $result;
    }
}
