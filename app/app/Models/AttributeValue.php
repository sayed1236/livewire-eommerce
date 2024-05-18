<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttributeValue extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function get_new($attribute_id)
    {
        $result = new AttributeValue();
        $result->id=0;
        $result->name='';
        $result->name_en='';
        $result->attribute_id=$attribute_id;
        $result->value='';
        $result->ord= (AttributeValue::where(['attribute_id'=>$attribute_id])->count()) +1;
        return $result;
    }
    function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
