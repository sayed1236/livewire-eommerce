<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function user_rated()
    {
        return $this->belongsTo(User::class,'rated_id');
    }
    public function rated_in()
    {
        return $this->belongsTo(Question::class, 'rated_in_id');
    }
}
