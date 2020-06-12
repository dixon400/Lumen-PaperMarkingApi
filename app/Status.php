<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Status extends Model 
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    protected $table = 'statuses';

    public function studentPaper()
    {
        return $this->belongsTo(StudentPaper::class);
    }

    public function paper()
    {
        return $this->hasMany(Paper::class);
    }

    public function answer()
    {
        return $this->hasMany(Answer::class);
    }

}
