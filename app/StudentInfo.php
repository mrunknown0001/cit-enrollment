<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentInfo extends Model
{
    public function year_level()
    {
    	return $this->belongsTo('App\YearLevel', 'curriculum_id');
    }
}
