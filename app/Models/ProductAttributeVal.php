<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributeVal extends Model
{
    use HasFactory;
    public function attribute_val()
    {
        return $this->hasOne(AttributeValue::class,'id','attribute_value_id');
    }
}
