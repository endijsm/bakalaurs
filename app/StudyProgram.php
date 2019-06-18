<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
    public function study_program_results()
    {
        return $this->hasMany('App\StudyProgramResult');
    }

    public function study_direction()
    {
        return $this->belongsTo('App\StudyDirection');
    }

    public function study_courses()
    {
        return $this->belongsToMany('App\StudyCourse');
    }

    public function director()
    {
        return $this->belongsTo('App\User');
    }

    public function getSelectOptionAttribute(){
        return $this->name.' ('.$this->level.')';
    }
}
