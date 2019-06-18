<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['firstname', 'lastname', 'username', 'degree', 'position', 'user_type_id', 'is_lecturer', 'email', 'password',
    ];

    protected $attributes = [
        'degree' => 'nav norādīts',
        'position' => 'nav norādīts',
        'is_lecturer' => 0,
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function user_type()
    {
        return $this->belongsTo('App\UserType');
    }

    public function getSelectOptionAttribute()
    {
        return $this->firstname.' '.$this->lastname;
    }

    public function study_courses()
    {
        return $this->belongsToMany('App\StudyCourse', 'lecturer_study_course');
    }

    public function isLecturer()
    {
        return $this->is_lecturer == 1;
    }

    public function isAdmin()
    {
        return $this->user_type->type == 'admin';
    }

    public function canAddCourseDescriptions()
    {
        return $this->user_type->type == 'admin' || $this->user_type->type == 'director' || $this->is_lecturer || $this->user_type->type == 'study_specialist' || $this->user_type->type == 'secretary';
    }

    public function canViewCourseDescriptions()
    {
        return $this->user_type->type != 'student'; // student is the only type of user who doesn't have permission to view course descriptions 
    }

    public function canViewStudyProgramMapping()
    {
        return $this->user_type->type != 'student'; // student is the only type of user who doesn't have permission to view study program mapping 
    }

    public function canViewStructures()
    {
        return $this->user_type->type != 'student'; // student is the only type of user who doesn't have permission to view structures (faculties, study programs, study directions etc.)
    }

    public function canDefineStructures()
    {
        return $this->user_type->type == 'admin' || $this->user_type->type == 'dean' || $this->user_type->type == 'director' || $this->user_type->type == 'study_manager' || $this->user_type->type == 'study_specialist';
    }

    public function canViewCatalog()
    {
        return $this->user_type->type != 'student';
    }

    public function canDefineCatalog()
    {
        return $this->user_type->type == 'admin' || $this->user_type->type == 'vice_rector' || $this->user_type->type == 'study_manager' || $this->user_type->type == 'study_specialist' || $this->user_type->type == 'external_issues_specialist';
    }

    public function canViewReports()
    {
        return $this->user_type->type== 'admin' || $this->user_type->type == 'dean' || $this->user_type->type == 'director' || $this->user_type->type == 'vice_rector' || $this->user_type->type == 'study_specialist' || $this->user_type->type == 'external_issues_specialist' || $this->user_type->type == 'secretary';
    }

}
