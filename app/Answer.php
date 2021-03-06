<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Paper;
use App\StudentPaper;


class Answer extends Model 
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'subject_id',
         'paper_id',
         'status_id',
         'answer'
    ];

    public function paper()
    {
         return $this->belongsTo(Paper::class);
    }

    public function subject()
    {
         return $this->belongsTo(Subject::class);
    }

}


