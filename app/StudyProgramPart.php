<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudyProgramPart extends Model
{
    public $timestamps = false;

    public function study_courses()
    {
        return $this->hasMany('App\StudyCourse');
    }
}
