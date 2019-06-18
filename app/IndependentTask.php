<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndependentTask extends Model
{
    public function study_course()
    {
        return $this->belongsTo('App\StudyCourse');
    }
}
