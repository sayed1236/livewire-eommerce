<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialSetting extends Model
{
    use HasFactory;
    protected $fillable=[
        'seo','lang','color'
    ];

}
