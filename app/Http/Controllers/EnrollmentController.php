<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\EnrolledStudent;
use App\AcademicYear;
use App\Semester;

class EnrollmentController extends Controller
{
    public static function enroll_student($id = null)
    {
    	$student = User::find($id);

    	$ay = AcademicYear::where('active', 1)->first();
    	// $sem = Semester::where('active', 1)->first();

    	// add to enrolled student
    	$enrolled = new EnrolledStudent();
    	$enrolled->student_id = $student->id;
    	$enrolled->academic_year_id = $ay->id;
    	// $enrolled->semester_id = $sem->id;
    	$enrolled->save();
    }
}
