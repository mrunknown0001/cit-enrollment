<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function enrolled()
    {
        return $this->hasOne('App\CourseEnrolled', 'student_id');
    }


    public function info()
    {
        return $this->hasOne('App\StudentInfo', 'student_id');
    }


    public function prev()
    {
        return $this->hasOne('App\StudentPreviousSchool', 'student_id');
    }


    public function avatar()
    {
        return $this->hasOne('App\Avatar', 'student_id');
    }

    public function balance()
    {
        return $this->hasOne('App\Balance', 'student_id');
    }

    public function enrolled_now()
    {
        return $this->hasOne('App\EnrolledStudent', 'student_id');
    }

    public function status()
    {
        return $this->hasOne('App\StudentStatus', 'student_id');
    }
}
