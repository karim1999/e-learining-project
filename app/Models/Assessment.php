<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function quiz(){
        return $this->belongsTo(Quiz::class);
    }
    public function answers(){
        return $this->hasMany(Answer::class);
    }
}
