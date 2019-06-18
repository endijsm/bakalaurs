<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeOfTest extends Model
{
    public function study_courses()
    {
        return $this->hasMany('App\StudyCourse'); 
    }
}
