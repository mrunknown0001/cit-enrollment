<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\GeneralController;

use App\User;
use App\Course;
use App\CourseMajor;
use App\Curriculum;
use App\CourseEnrolled;

class RegistrarController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:registrar');
    }


    // method to registrar dashboard
    public function dashboard()
    {
    	return view('registrar.dashboard');
    }


    // method use on student operations
    public function students()
    {
    	$students = User::orderBy('created_at')
    				->paginate(15);

    	return view('registrar.students', ['students' => $students]);
    }


    // method use to add student
    public function addStudent()
    {
        $courses = Course::where('active', 1)->orderBy('title', 'asc')->get();

    	return view('registrar.student-add', ['courses' => $courses]);
    }


    // method use to save new student
    public function postAddStudent(Request $request)
    {
    	$request->validate([
    		'student_number' => 'required|unique:users',
    		'firstname' => 'required',
    		'lastname' => 'required',
            'course' => 'required',
            'curriculum' => 'required'
    	]);

    	$sn = $request['student_number'];
    	$firstname = $request['firstname'];
    	$lastname = $request['lastname'];
    	$middlename = $request['middlename'];
    	$suffix = $request['suffix_name'];
        $course_id = $request['course'];
        $major_id = $request['major'];
        $curriculum_id = $request['curriculum'];

        $course = Course::findorfail($course_id);
        $curriculum = Curriculum::findorfail($curriculum_id);

    	$student = new User();
    	$student->student_number = $sn;
    	$student->firstname = $firstname;
    	$student->lastname = $lastname;
    	$student->middle_name = $middlename;
    	$student->suffix_name = $suffix;
    	$student->save();

        $ce = new CourseEnrolled();
        $ce->student_id = $student->id;
        $ce->course_id = $course->id;
        $ce->major_id = $major_id;
        $ce->curriculum_id = $curriculum->id;
        $ce->save();

    	// add activitly log
        GeneralController::activity_log(Auth::guard('registrar')->user()->id, 3, 'Registrar Added Student');

    	// redirect back with success message
    	return redirect()->back()->with('success', 'Student Added!');
    }


    // method use to get major oncourses
    public function getCourseMajor($id = null)
    {
        $majors = CourseMajor::where('course_id', $id)
                            ->where('active', 1)
                            ->get();

        return $majors;

    }


    // method use to get curriculum of cousre
    public function getCourseCurriculum($id = null)
    {
        $cu = Curriculum::where('course_id', $id)
                        ->where('active', 1)
                        ->get();

        return $cu;
    }

}
