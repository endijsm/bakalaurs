<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudyCourseResult extends Model
{
    public $timestamps = false;

    public function study_course()
    {
        return $this->belongsTo('App\StudyCourse');
    }
    
    public function study_program_results()
    {
        return $this->belongsToMany('App\StudyProgramResult');
    }
}
