<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudyDirection extends Model
{
    protected $fillable = ['name', 'faculty_id'];

    public function faculty()
    {
        return $this->belongsTo('App\Faculty');
    }

    public function study_programs()
    {
        return $this->hasMany('App\StudyProgram');
    }
}
