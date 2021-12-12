<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $dates= [
        "start_date",
        "end_date"
    ];
    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function assessments(){
        return $this->hasMany(Assessment::class);
    }
}
