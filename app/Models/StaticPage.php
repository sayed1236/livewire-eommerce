<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaticPage extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function get_new()
    {
        $result = new StaticPage();
        $result->name='';
        $result->name_en='';
        $result->ord= StaticPage::count()+1;
        $result->img='';
        $result->details='';
        $result->details_en='';
        $result->video='';
        $result->parent_id= 0;
        $result->type= 0;
        return $result;
    }
}
