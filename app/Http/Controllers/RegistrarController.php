<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\GeneralController;

use App\User;
use App\Registrar;
use App\StudentInfo;
use App\Course;
use App\CourseMajor;
use App\Curriculum;
use App\CourseEnrolled;
use App\YearLevel;

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


    // method use to view profile of registrar
    public function profile()
    {
        return view('registrar.profile');
    }


    // method use to update profile of registrar
    public function updateProfile()
    {
        return view('registrar.profile-update');
    }


    // method use to save update to profile of registrar
    public function postUpdateProfile(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required'
        ]);

        $firstname = $request['firstname'];
        $middlename = $request['middlename'];
        $lastname = $request['lastname'];
        $suffix = $request['suffix_name'];
        $id_number = $request['id_number'];

        $registrar = Registrar::find(Auth::guard('registrar')->user()->id);

        // check id number existence
        $check_id = Registrar::where('id_number')->first();

        if(count($check_id) > 0 && $registrar->id_number == $id_number && $id_number != null) {
            return redirect()->back()->with('error', 'ID Number Exists!');
        }

        $registrar->firstname = $firstname;
        $registrar->middle_name = $middlename;
        $registrar->lastname = $lastname;
        $registrar->suffix_name = $suffix;
        $registrar->id_number = $id_number;
        $registrar->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('registrar')->user()->id, 3, 'Registrar Updated Profile');

        return redirect()->route('registrar.profile')->with('success', 'Profile Updated!');
    }


    // method use to change password
    public function changePassword()
    {
        return view('registrar.password-change');
    }


    // method use to save new password
    public function postChangePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        $old_password = $request['old_password'];
        $password = $request['password'];

        // check old password if matched to the correct password
        if(!password_verify($old_password, Auth::guard('registrar')->user()->password)) {
            return redirect()->back()->with('error', 'Incorrect Old Password!');
        }

        // check if the new password is same as the old
        if(password_verify($password, Auth::guard('registrar')->user()->password)) {
            return redirect()->back()->with('error', 'New Password Entered is Same as Old Password!');
        }

        // change password
        $registrar = Registrar::find(Auth::guard('registrar')->user()->id);
        $registrar->password = bcrypt($password);
        $registrar->save();

        // add activty log
        GeneralController::activity_log(Auth::guard('registrar')->user()->id, 3, 'Registrar Change Password');

        // return to deans and add admin with message
        return redirect()->route('registrar.dashboard')->with('success', 'Password Changed!');
    }


    // method use on student operations
    public function students()
    {
    	$students = User::orderBy('created_at')
    				->paginate(15);

    	return view('registrar.students', ['students' => $students]);
    }


    // method use to search students
    public function searchStudent(Request $request)
    {
        $key = $request['q'];

        $students = GeneralController::students_search($key);

        return view('registrar.students-search-result', ['students' => $students, 'key' => $key]);
    }


    // method use to add student
    public function addStudent()
    {
        $courses = Course::where('active', 1)->orderBy('title', 'asc')->get();
        $yl = YearLevel::get();

    	return view('registrar.student-add', ['courses' => $courses, 'yl' => $yl]);
    }


    // method use to save new student
    public function postAddStudent(Request $request)
    {
    	$request->validate([
    		'student_number' => 'required|unique:users',
    		'firstname' => 'required',
    		'lastname' => 'required',
            'course' => 'required',
            'curriculum' => 'required',
            'year_level' => 'required'
    	]);

    	$sn = $request['student_number'];
    	$firstname = $request['firstname'];
    	$lastname = $request['lastname'];
    	$middlename = $request['middlename'];
    	$suffix = $request['suffix_name'];
        $course_id = $request['course'];
        $major_id = $request['major'];
        $curriculum_id = $request['curriculum'];
        $yl_id = $request['year_level'];

        $year_level = YearLevel::findorfail($yl_id);
        $course = Course::findorfail($course_id);
        $curriculum = Curriculum::findorfail($curriculum_id);

        // add to user as students
    	$student = new User();
    	$student->student_number = $sn;
    	$student->firstname = $firstname;
    	$student->lastname = $lastname;
    	$student->middle_name = $middlename;
    	$student->suffix_name = $suffix;
    	$student->save();

        // add course enrolled
        $ce = new CourseEnrolled();
        $ce->student_id = $student->id;
        $ce->course_id = $course->id;
        $ce->major_id = $major_id;
        $ce->curriculum_id = $curriculum->id;
        $ce->save();

        // add student info record
        $info = new StudentInfo();
        $info->student_id = $student->id;
        $info->year_level_id = $year_level->id;
        $info->save();

    	// add activitly log
        GeneralController::activity_log(Auth::guard('registrar')->user()->id, 3, 'Registrar Added Student');

    	// redirect back with success message
    	return redirect()->back()->with('success', 'Student Added!');
    }


    // method use to update students basic info
    public function updateStudent($id = null)
    {
        $student = User::findorfail($id);
        $courses = Course::where('active', 1)->orderBy('title', 'asc')->get();
        $yl = YearLevel::get();

        return view('registrar.student-update', ['student' => $student, 'courses' => $courses, 'yl' => $yl]);
    }


    // method use to get major oncourses
    public function getCourseMajor($id = null)
    {
        $majors = CourseMajor::where('course_id', $id)
                            ->where('active', 1)
                            ->get();

        return $majors;

    }


    // method use to save student update
    public function postUpdateStudent(Request $request)
    {
        $request->validate([
            'student_number' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'course' => 'required',
            'curriculum' => 'required',
            'year_level' => 'required'
        ]);

        $student_id = $request['student_id'];
        $sn = $request['student_number'];
        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $middlename = $request['middlename'];
        $suffix = $request['suffix_name'];
        $course_id = $request['course'];
        $major_id = $request['major'];
        $curriculum_id = $request['curriculum'];
        $yl_id = $request['year_level'];

        $student = User::findorfail($student_id);

        // student number existence
        $check_sn = User::where('student_number', $sn)->first();

        if(count($check_sn) > 0 && $student->student_number != $sn) {
            return redirect()->back()->with('error', 'Student Number Already Exist!');
        }

        $year_level = YearLevel::findorfail($yl_id);
        $course = Course::findorfail($course_id);
        $curriculum = Curriculum::findorfail($curriculum_id);

        // save to user as students
        $student->student_number = $sn;
        $student->firstname = $firstname;
        $student->lastname = $lastname;
        $student->middle_name = $middlename;
        $student->suffix_name = $suffix;
        $student->save();

        // save to course enrolled
        $ce = new CourseEnrolled();
        $ce->student_id = $student->id;
        $ce->course_id = $course->id;
        $ce->major_id = $major_id;
        $ce->curriculum_id = $curriculum->id;
        $ce->save();

        // save to student info record
        $info = new StudentInfo();
        $info->student_id = $student->id;
        $info->year_level_id = $year_level->id;
        $info->save();

        // add activitly log
        GeneralController::activity_log(Auth::guard('registrar')->user()->id, 3, 'Registrar Updated Student');

        // redirect back with success message
        return redirect()->route('registrar.students')->with('success', 'Student Info Updated!');
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
