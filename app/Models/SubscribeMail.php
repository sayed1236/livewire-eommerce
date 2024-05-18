<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscribeMail extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function get_new()
    {
        $result = new SubscribeMail();
        $result->name='';
        $result->email='';
        return $result;
    }
}
