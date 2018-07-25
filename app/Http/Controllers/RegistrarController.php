<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\GeneralController;

use App\User;
use App\Course;

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
    		'lastname' => 'required'
    	]);

    	$sn = $request['student_number'];
    	$firstname = $request['firstname'];
    	$lastname = $request['lastname'];
    	$middlename = $request['middlename'];
    	$suffix = $request['suffix_name'];

    	$student = new User();
    	$student->student_number = $sn;
    	$student->firstname = $firstname;
    	$student->lastname = $lastname;
    	$student->middle_name = $middlename;
    	$student->suffix_name = $suffix;
    	$student->save();

    	// add activitly log

    	// redirect back with success message
    	return redirect()->back()->with('success', 'Student Added!');
    }

}
