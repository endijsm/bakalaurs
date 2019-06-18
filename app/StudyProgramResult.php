<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudyProgramResult extends Model
{
    public function study_program()
    {
        return $this->belongsTo('App\StudyProgram');
    }

    public function study_courses()
    {
        return $this->belongsToMany('App\StudyCourse');
    }

    public function study_course_results()
    {
        return $this->belongsToMany('App\StudyCourseResult');
    }

    public function getSelectOptionAttribute()
    {
        return $this->study_program->name.' ('.$this->study_program->level.'): '.$this->result;
    }
}
