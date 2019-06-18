<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    public $timestamps = false;

    public function study_course()
    {
        return $this->belongsTo('App\StudyCourse');
    }
}
