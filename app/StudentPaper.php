<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Answer;


class StudentPaper extends Model 
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id',
        'paper_id',
        'status_id',
        'score',
        'percentage'
    ];

    public function status()
    {
         return $this->hasOne(Status::class);
    }

    public function paper()
    {
         return $this->hasOne(Paper::class);
    }

    public function student()
    {
         return $this->belongsTo(Student::class);
    }

    public function subject()
    {
         return $this->belongsTo(Subject::class);
    }

}
