<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    public function study_directions()
    {
        return $this->hasMany('App\StudyDirection');
    }
}