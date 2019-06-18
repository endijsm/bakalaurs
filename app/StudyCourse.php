<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudyCourse extends Model
{
    public function lecturers()
    {
        return $this->belongsToMany('App\User', 'lecturer_study_course');
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'author_id');
    }

    public function study_program_part()
    {
        return $this->belongsTo('App\StudyProgramPart');
    }

    public function type_of_test()
    {
        return $this->belongsTo('App\TypeOfTest');
    }

    public function independent_tasks()
    {
        return $this->hasMany('App\IndependentTask');
    }

    public function basic_literature()
    {
        return $this->hasMany('App\BasicLiterature');
    }

    public function additional_literature()
    {
        return $this->hasMany('App\AdditionalLiterature');
    }

    public function other_information_sources()
    {
        return $this->hasMany('App\OtherInformationSource');
    }

    public function study_course_results()
    {
        return $this->hasMany('App\StudyCourseResult');
    }

    public function additional_study_course_results()
    {
        return $this->hasMany('App\AdditionalStudyCourseResult');
    }

    public function evaluations()
    {
        return $this->hasMany('App\Evaluation');
    }

    public function subjects()
    {
        return $this->hasMany('App\StudyCourseSubject');
    }

    public function calendar_plans()
    {
        return $this->hasMany('App\CalendarPlan');
    }

    public function study_program_results()
    {
        return $this->belongsToMany('App\StudyProgramResult');
    }

    public function study_programs()
    {
        return $this->belongsToMany('App\StudyProgram');
    }
}
