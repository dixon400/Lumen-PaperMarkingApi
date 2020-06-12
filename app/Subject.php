<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Subject extends Model 
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'title'
    ];

    public function paper()
    {
         return $this->hasMany(Paper::class);
    }

    public function studentPaper()
    {
         return $this->hasMany(StudentPaper::class);
    }

    public function answer()
    {
         return $this->hasMany(Answer::class);
    }
}
