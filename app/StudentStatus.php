<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentStatus extends Model
{
    public function type()
    {
    	return $this->hasOne('App\StudentType', 'student_type_id');
    }
}
