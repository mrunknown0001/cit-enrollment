<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\GeneralController;

use App\User;
use App\Admin;
use App\Dean;
use App\Cashier;
use App\Registrar;
use App\Faculty;
use App\ActivityLog;
use App\Course;
use App\AcademicYear;
use App\Semester;
use App\YearLevel;
use App\CourseMajor;
use App\Subject;
use App\EnrollmentSetting;
use App\Curriculum;

class AdminController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:admin');
    }

    
    // method to view dashboard of admin
    public function dashboard()
    {
        $es = EnrollmentSetting::find(1);

    	return view('admin.dashboard', ['es' => $es]);
    }


    // method use to view profile of admin
    public function profile()
    {
        return view('admin.profile');
    }


    // method use to update profile of admin
    public function updateProfile()
    {
        return view('admin.profile-update');
    }


    // method use to save update on admin profile
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

        $admin = Admin::find(Auth::guard('admin')->user()->id);

        // check id number existence
        $check_id = Admin::where('id_number')->first();

        if(count($check_id) > 0 && $admin->id_number == $id_number && $id_number != null) {
            return redirect()->back()->with('error', 'ID Number Exists!');
        }

        $admin->firstname = $firstname;
        $admin->middle_name = $middlename;
        $admin->lastname = $lastname;
        $admin->suffix_name = $suffix;
        $admin->id_number = $id_number;
        $admin->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Updated Profile');

        return redirect()->route('admin.profile')->with('success', 'Profile Updated!');

    }


    // method use to change password
    public function changePassword()
    {
        return view('admin.password-change');
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
        if(!password_verify($old_password, Auth::guard('admin')->user()->password)) {
            return redirect()->back()->with('error', 'Incorrect Old Password!');
        }

        // check if the new password is same as the old
        if(password_verify($password, Auth::guard('admin')->user()->password)) {
            return redirect()->back()->with('error', 'New Password Entered is Same as Old Password!');
        }

        // change password
        $admin = Admin::find(Auth::guard('admin')->user()->id);
        $admin->password = bcrypt($password);
        $admin->save();

        // add activty log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Change Password');

        // return to deans and add admin with message
        return redirect()->route('admin.dashboard')->with('success', 'Password Changed!');
    }


    // method use to enable enrollment
    public function enableEnrollment(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        $password = $request['password'];

        if(!password_verify($password, Auth::guard('admin')->user()->password)) {
           return redirect()->back()->with('error', 'Invalid Password!');
        }

        $es = EnrollmentSetting::find(1);
        $es->active = 1;
        $es->save();

        // add activty log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Enabled Enrollment');

        // return to deans and add admin with message
        return redirect()->route('admin.dashboard')->with('success', 'Enrollment Enabled!');
    
    }


    // method use to disable enrollment
    public function disableEnrollment(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        $password = $request['password'];

        if(!password_verify($password, Auth::guard('admin')->user()->password)) {
           return redirect()->back()->with('error', 'Invalid Password!');
        }

        $es = EnrollmentSetting::find(1);
        $es->active = 0;
        $es->save();

        // add activty log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Disabled Enrollment');

        // return to deans and add admin with message
        return redirect()->route('admin.dashboard')->with('success', 'Enrollment Disabled!');
    }


    // method use to view deans
    public function deans()
    {
    	$deans = Dean::where('active', 1)
    				->orderBy('lastname', 'asc')
    				->get();

    	return view('admin.deans', ['deans' => $deans]);
    }


    // method use to add dean
    public function addDean()
    {
    	return view('admin.dean-add');
    }


    // method use to save new dean
    public function postAddDean(Request $request)
    {
    	$request->validate([
    		'firstname' => 'required',
    		'lastname' => 'required',
    		'username' => 'required'
    	]);

    	$firstname = $request['firstname'];
    	$lastname = $request['lastname'];
    	$middlename = $request['middlename'];
    	$suffix = $request['suffix_name'];
    	$username = $request['username'];

        // check if the username is already exist
        $check_username = Dean::where('username', $username)->first();

        if(count($check_username) > 0) {
            return redirect()->back()->with('error', 'Username Already Used!');
        }

    	// add new dean
    	$dean = new Dean();
    	$dean->username = $username;
    	$dean->password = bcrypt('password');
    	$dean->firstname = $firstname;
    	$dean->lastname = $lastname;
    	$dean->middle_name = $middlename;
    	$dean->suffix_name = $suffix;
    	$dean->save();

    	// add activty log
    	GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Added Dean');

    	// return to deans and add admin with message
    	return redirect()->route('admin.deans')->with('success', 'Dean Added!');

    }


    // method use to update dean
    public function updateDean($id = null)
    {
    	$dean = Dean::findorfail($id);

    	return view('admin.dean-update', ['dean' => $dean]);
    }


    // method use to save update on dean
    public function postUpdateDean(Request $request)
    {
    	$request->validate([
    		'firstname' => 'required',
    		'lastname' => 'required',
    		'username' => 'required'
    	]);

    	$firstname = $request['firstname'];
    	$lastname = $request['lastname'];
    	$middlename = $request['middlename'];
    	$suffix = $request['suffix_name'];
    	$username = $request['username'];
    	$dean_id = $request['dean_id'];

    	$dean = Dean::findorfail($dean_id);

    	// check if the username is already exist
    	$check_username = Dean::where('username', $username)->first();

    	if(count($check_username) > 0 && $username != $dean->username) {
    		return redirect()->back()->with('error', 'Username Already Used!');
    	}

    	$dean->username = $username;
    	$dean->password = bcrypt('password');
    	$dean->firstname = $firstname;
    	$dean->lastname = $lastname;
    	$dean->middle_name = $middlename;
    	$dean->suffix_name = $suffix;
    	$dean->save();

    	// add activty log
    	GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Updated Dean Information');

    	// return to deans and add admin with message
    	return redirect()->route('admin.deans')->with('success', 'Dean Information Updated!');
    }


    // method use to view registrars
    public function registrars()
    {
        $registrars = Registrar::where('active', 1)
                            ->orderBy('lastname', 'asc')
                            ->get();

        return view('admin.registrars', ['registrars' => $registrars]);
    }


    // method use to add registrar
    public function addRegistrar()
    {
        return view('admin.registrar-add');
    }


    // method use to save new registrar
    public function postAddRegistrar(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required'
        ]);

        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $middlename = $request['middlename'];
        $suffix = $request['suffix_name'];
        $username = $request['username'];

        // check if the username is already exist
        $check_username = Registrar::where('username', $username)->first();

        if(count($check_username) > 0) {
            return redirect()->back()->with('error', 'Username Already Used!');
        }

        // add new registrar
        $registrar = new Registrar();
        $registrar->username = $username;
        $registrar->password = bcrypt('password');
        $registrar->firstname = $firstname;
        $registrar->lastname = $lastname;
        $registrar->middle_name = $middlename;
        $registrar->suffix_name = $suffix;
        $registrar->save();

        // add activty log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Added Registrar');

        // return to deans and add admin with message
        return redirect()->route('admin.registrars')->with('success', 'Registrar Added!');
    }


    // method use to update registrar
    public function updateRegistrar($id = null)
    {
        $registrar = Registrar::findorfail($id);

        return view('admin.registrar-update', ['registrar' => $registrar]);
    }


    // method use to save update on registrar
    public function postUpdateRegistrar(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required'
        ]);

        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $middlename = $request['middlename'];
        $suffix = $request['suffix_name'];
        $username = $request['username'];
        $registrar_id = $request['registrar_id'];

        $registrar = Registrar::findorfail($registrar_id);

        // check if the username is already exist
        $check_username = Registrar::where('username', $username)->first();

        if(count($check_username) > 0 && $username != $registrar->username) {
            return redirect()->back()->with('error', 'Username Already Used!');
        }

        // add new dean
        $registrar->username = $username;
        $registrar->password = bcrypt('password');
        $registrar->firstname = $firstname;
        $registrar->lastname = $lastname;
        $registrar->middle_name = $middlename;
        $registrar->suffix_name = $suffix;
        $registrar->save();

        // add activty log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Updated Registrar');

        // return to deans and add admin with message
        return redirect()->route('admin.registrars')->with('success', 'Registrar Details Updated!');
    }


    // method use to view cashiers
    public function cashiers()
    {
        $cashiers = Cashier::where('active', 1)
                            ->orderBy('lastname', 'asc')
                            ->get();

        return view('admin.cashiers', ['cashiers' => $cashiers]);
    }


    // method use to add cashier
    public function addCashier()
    {
        return view('admin.cashier-add');
    }


    // method use to save new cashier
    public function postAddCashier(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required'
        ]);

        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $middlename = $request['middlename'];
        $suffix = $request['suffix_name'];
        $username = $request['username'];

        // check if the username is already exist
        $check_username = Cashier::where('username', $username)->first();

        if(count($check_username) > 0) {
            return redirect()->back()->with('error', 'Username Already Used!');
        }

        // add new registrar
        $cashier = new Cashier();
        $cashier->username = $username;
        $cashier->password = bcrypt('password');
        $cashier->firstname = $firstname;
        $cashier->lastname = $lastname;
        $cashier->middle_name = $middlename;
        $cashier->suffix_name = $suffix;
        $cashier->save();

        // add activty log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Added Cashier');

        // return to deans and add admin with message
        return redirect()->route('admin.cashiers')->with('success', 'Cashier Added!');
    }


    // method use to update cashier
    public function updateCashier($id = null)
    {
        $cashier = Cashier::findorfail($id);

        return view('admin.cashier-update', ['cashier' => $cashier]);
    }


    // method use to save update on cashier
    public function postUpdateCashier(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required'
        ]);

        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $middlename = $request['middlename'];
        $suffix = $request['suffix_name'];
        $username = $request['username'];
        $cashier_id = $request['cashier_id'];

        $cashier = Cashier::findorfail($cashier_id);

        // check if the username is already exist
        $check_username = Cashier::where('username', $username)->first();

        if(count($check_username) > 0 && $username != $cashier->username) {
            return redirect()->back()->with('error', 'Username Already Used!');
        }

        // add new dean
        $cashier->username = $username;
        $cashier->password = bcrypt('password');
        $cashier->firstname = $firstname;
        $cashier->lastname = $lastname;
        $cashier->middle_name = $middlename;
        $cashier->suffix_name = $suffix;
        $cashier->save();

        // add activty log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Updated Cashier');

        // return to deans and add admin with message
        return redirect()->route('admin.cashiers')->with('success', 'Cashier Details Updated!');
    }


    // method use to view faculties
    public function faculties()
    {
        $faculties = Faculty::where('active', 1)
                            ->orderBy('lastname', 'asc')
                            ->get();

        return view('admin.faculties', ['faculties' => $faculties]);
    }


    // method use to add faculty
    public function addFaculty()
    {
        return view('admin.faculty-add');
    }


    // method use to save new faculty
    public function postAddFaculty(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required'
        ]);

        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $middlename = $request['middlename'];
        $suffix = $request['suffix_name'];
        $username = $request['username'];

        // check if the username is already exist
        $check_username = Faculty::where('username', $username)->first();

        if(count($check_username) > 0) {
            return redirect()->back()->with('error', 'Username Already Used!');
        }

        // add new registrar
        $faculty = new Faculty();
        $faculty->username = $username;
        $faculty->password = bcrypt('password');
        $faculty->firstname = $firstname;
        $faculty->lastname = $lastname;
        $faculty->middle_name = $middlename;
        $faculty->suffix_name = $suffix;
        $faculty->save();

        // add activty log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Added Faculty');

        // return to deans and add admin with message
        return redirect()->route('admin.faculties')->with('success', 'Faculty Added!');
    }


    // method use to update faculty
    public function updateFaculty($id = null)
    {
        $faculty = Faculty::findorfail($id);

        return view('admin.faculty-update', ['faculty' => $faculty]);
    }


    // method use to save update on faculty
    public function postUpdateFaculty(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required'
        ]);

        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $middlename = $request['middlename'];
        $suffix = $request['suffix_name'];
        $username = $request['username'];
        $faculty_id = $request['faculty_id'];

        $faculty = Faculty::findorfail($faculty_id);

        // check if the username is already exist
        $check_username = Faculty::where('username', $username)->first();

        if(count($check_username) > 0 && $username != $faculty->username) {
            return redirect()->back()->with('error', 'Username Already Used!');
        }

        // add new dean
        $faculty->username = $username;
        $faculty->password = bcrypt('password');
        $faculty->firstname = $firstname;
        $faculty->lastname = $lastname;
        $faculty->middle_name = $middlename;
        $faculty->suffix_name = $suffix;
        $faculty->save();

        // add activty log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Updated Faculty');

        // return to deans and add admin with message
        return redirect()->route('admin.faculties')->with('success', 'Faculty Details Updated!');
    }


    // method use to show all students
    public function students()
    {
        $students = User::where('active', 1)
                        ->orderBy('created_at', 'desc')
                        ->paginate(15);

        return view('admin.students', ['students' => $students]);
    }


    // method use to reset student password
    public function postResetStudentPassword(Request $request)
    {
        $student_id = $request['student_id'];

        $student = User::findorfail($student_id);
        $student->password = bcrypt('password');
        $student->save();

        // add activty log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Reset Student Password');

        // return to deans and add admin with message
        return redirect()->route('admin.students')->with('success', 'Student Password is Reset!');
    }


    // method use to view courses
    public function courses()
    {
        $courses = Course::where('active', 1)
                    ->orderBy('title', 'asc')
                    ->paginate(10);

        return view('admin.courses', ['courses' => $courses]);
    }


    // method use to add course
    public function addCourse()
    {
        return view('admin.course-add');
    }


    // method use to save new course
    public function postAddCourse(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'code' => 'required'
        ]);

        $title = $request['title'];
        $code = $request['code'];

        $check_title = Course::where('title', $title)->first();
        $check_code = Course::where('code', $code)->first();

        if(count($check_title) > 0 || count($check_code) > 0) {

            return redirect()->back()->with('error', 'Please check you input!');
        }

        // save course
        $course = new Course();
        $course->title = $title;
        $course->code = $code;
        $course->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Added Course');

        // return back with success message
        return redirect()->back()->with('success', 'Course Added!');
    }


    // method use to update course
    public function updateCourse($id = null)
    {
        $course = Course::findorfail($id);

        return view('admin.course-update', ['course' => $course]);
    }


    // method use to save update on course
    public function postUpdateCourse(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'code' => 'required'
        ]);

        $title = $request['title'];
        $code = $request['code'];
        $course_id = $request['course_id'];

        $course = Course::findorfail($course_id);

        $check_title = Course::where('title', $title)->first();
        $check_code = Course::where('code', $code)->first();

        if((count($check_title) > 0 && $title != $course->title) || (count($check_code) > 0 && $code != $course->code)) {

            return redirect()->back()->with('error', 'Please check you input!');
        }

        // save course
        $course->title = $title;
        $course->code = $code;
        $course->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Updated Course');

        // return back with success message
        return redirect()->route('admin.courses')->with('success', 'Course Updated!');
    }


    // method use to view course majors
    public function courseMajor()
    {
        $majors = CourseMajor::get();

        return view('admin.majors', ['majors' => $majors]);
    }


    // method use to add course majors
    public function addCourseMajor()
    {
        $courses = Course::get();

        return view('admin.major-add', ['courses' => $courses]);
    }


    // method use to save new course major
    public function postAddCourseMajor(Request $request)
    {
        $request->validate([
            'course' => 'required',
            'major_name' => 'required'
        ]);

        $course_id = $request['course'];
        $name = $request['major_name'];

        $course = Course::findorfail($course_id);

        // check if there is duplicate
        $check_duplicate = CourseMajor::where('course_id', $course->id)
                                ->where('name', $name)
                                ->first();

        if(count($check_duplicate) > 0) {
            return redirect()->back()->with('error', 'Duplicate Record Found!');
        }

        // save new course major
        $major = new CourseMajor();
        $major->course_id = $course->id;
        $major->name = $name;
        $major->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Added Course Major');

        // return back with success message
        return redirect()->route('admin.course.majors')->with('success', 'Course Major Added!');
    }


    // method use to update course major
    public function updateCourseMajor($id = null)
    {
        $major = CourseMajor::findorfail($id);
        $courses = Course::get();

        return view('admin.major-update', ['major' => $major, 'courses' => $courses]);
    }


    // method use to save update on course major
    public function postUpdateCourseMajor(Request $request)
    {
        $request->validate([
            'course' => 'required',
            'major_name' => 'required'
        ]);

        $course_id = $request['course'];
        $name = $request['major_name'];
        $major_id = $request['major_id'];

        $course = Course::findorfail($course_id);
        $major = CourseMajor::findorfail($major_id);

        // check if there is duplicate
        $check_duplicate = CourseMajor::where('course_id', $course->id)
                                ->where('name', $name)
                                ->first();

        if(count($check_duplicate) > 0 && $major->name != $name) {
            return redirect()->back()->with('error', 'Duplicate Record Found!');
        }

        $major->course_id = $course->id;
        $major->name = $name;
        $major->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Updated Course Major');

        // return back with success message
        return redirect()->route('admin.course.majors')->with('success', 'Course Major Updated!');
    }


    // method use to view all curricula 
    public function curricula()
    {
        $curricula = Curriculum::where('active', 1)->orderBy('created_at', 'desc')
                                ->paginate(15);

        return view('admin.curricula', ['curricula' => $curricula]);
    }


    // method use to add curriculum
    public function addCurriculum()
    {
        $courses = Course::where('active', 1)->orderBy('title', 'asc')->get();

        return view('admin.curriculum-add', ['courses' => $courses]);
    }


    // method use to save new curriculum
    public function postAddCurriculum(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'course' => 'required'
        ]);

        $name = $request['name'];
        $course_id = $request['course'];
        $major_id = $request['major'];

        $course = Course::findorfail($course_id);

        // save new curriculum
        $cu = new Curriculum();
        $cu->name = $name;
        $cu->course_id = $course->id;
        $cu->major_id = $major_id;
        $cu->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Added Curriculum');

        // return back with success message
        return redirect()->route('admin.curricula')->with('success', 'Curriculum Added!');
    }


    // method use to update curriculum
    public function updateCurriculum($id = null)
    {
        $courses = Course::where('active', 1)->orderBy('created_at', 'desc')->get();
        $curriculum = Curriculum::findorfail($id);

        return view('admin.curriculum-update', ['curriculum' => $curriculum, 'courses' => $courses ]);
    }


    // method use to save update on curriculum
    public function postUpdateCurriculum(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'course' => 'required'
        ]);

        $name = $request['name'];
        $course_id = $request['course'];
        $major_id = $request['major'];
        $curriculum_id = $request['curriculum_id'];

        $course = Course::findorfail($course_id);
        $cu = Curriculum::findorfail($curriculum_id);

        $check = Curriculum::where('name', $name)
                        ->where('course_id', $course->id)
                        ->where('major_id', $major_id)
                        ->first();

        if(count($check) > 0 && $cu->name != $name) {
            return redirect()->back()->with('error', 'Duplicate Curriculum Found!');
        }


        // save new curriculum
        $cu->name = $name;
        $cu->course_id = $course->id;
        $cu->major_id = $major_id;
        $cu->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Updated Curriculum');

        // return back with success message
        return redirect()->route('admin.curricula')->with('success', 'Curriculum Updated!');
    }


    // method use to view academic year and settings
    public function academicYear()
    {
        $ay = AcademicYear::where('active', 1)->first();
        $sem = Semester::where('active', 1)->first();

        return view('admin.academic-year', ['ay' => $ay, 'sem' => $sem]);
    }


    // method use to add new academic year
    public function postAddAcademicYear(Request $request)
    {
        $request->validate([
            'start_year' => 'required',
            'end_year' => 'required'
        ]);

        $sy = $request['start_year'];
        $ey = $request['end_year'];

        // check if there is current active ay
        $check_active_ay = AcademicYear::where('active', 1)->first();

        if(count($check_active_ay) > 0) {
            return redirect()->back()->with('error', 'There is an active Academic Year. Please close first!');
        }

        $check_duplicate_ay = AcademicYear::where('from', $sy)
                                    ->where('to', $ey)
                                    ->first();

        if(count($check_duplicate_ay) > 0) {
            return redirect()->back()->with('error', 'Duplicate Academic Year!');
        }

        // add academic year
        $ay = new AcademicYear();
        $ay->from = $sy;
        $ay->to = $ey;
        $ay->save();

        // activate first semester
        $sem = Semester::find(1);
        $sem->active = 1;
        $sem->save();

        // add activty log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Added New Academic Year and Activated First Semester');

        // return with message
        return redirect()->route('admin.academic.year')->with('success', 'Added New Academic Year!');
    }


    // method use to select second semester
    public function postSelectSecondSemester(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        $password = $request['password'];

        if(!password_verify($password, Auth::guard('admin')->user()->password)) {
            return redirect()->back()->with('error', 'Invalid Password!');
        }

        $first = Semester::findorfail(1);
        $first->active = 0;
        $first->save();

        $sem = Semester::findorfail(2);
        $sem->active = 1;
        $sem->save();

        // add operations in this part closing and saving other data needed
        // reset all settings needed to start a new sem


        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Activated Second Semester');

        return redirect()->route('admin.academic.year')->with('success', 'Second Semester Selected!');
    }


    // method use to close active academic year
    public function postCloseAcademicYear(Request $request)
    {
         $request->validate([
            'password' => 'required'
        ]);

        $password = $request['password'];

        if(!password_verify($password, Auth::guard('admin')->user()->password)) {
            return redirect()->back()->with('error', 'Invalid Password!');
        }

        // close academic year
        // operations goes here

        $ay = AcademicYear::where('active', 1)->first();
        $ay->active = 0;
        $ay->save();

        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Closed Academic Year');

        return redirect()->route('admin.academic.year')->with('success', 'Academic Year is Close. Congratulations!!!');

    }


    // method use to view year level
    public function yearLevel()
    {
        $yls = YearLevel::get();

        return view('admin.year-level', ['year_levels' => $yls]);
    }


    // method use to add year level
    public function addYearLevel()
    {
        return view('admin.year-level-add');
    }


    // method use to save new year level
    public function postAddYearLevel(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $name = $request['name'];

        // add new year level
        $yl = new YearLevel();
        $yl->name = $name;
        $yl->save();

        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Added New Yearl Level');

        return redirect()->route('admin.year.level')->with('success', 'New Year Level Added!');
    }


    // method use to udpate year level
    public function updateYearLevel($id = null)
    {
        $yl = YearLevel::findorfail($id);

        return view('admin.year-level-update', ['yl' => $yl]);
    }


    // method use to save update on year level
    public function postUpdateYearLevel(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $name = $request['name'];
        $id = $request['yl_id'];

        $yl = YearLevel::findorfail($id);
        $yl->name = $name;
        $yl->save();

        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Updated Yearl Level');

        return redirect()->route('admin.year.level')->with('success', 'Year Level Updated!');
    }


    // method use to view subjects
    public function subjects()
    {
        $subjects = Subject::orderBy('code', 'asc')
                        ->paginate(15);

        return view('admin.subjects', ['subjects' => $subjects]);
    }


    // method use to get course major to use in form add/update subject
    public function getCourseMajors($id = null)
    {
        $majors = CourseMajor::where('course_id', $id)->where('active', 1)->get();

        $course_majors = null;

        foreach($majors as $m) {
            $course_majors[] = [
                        'id' => $m->id,
                        'name' => $m->name
                    ];
        }

        return $course_majors;
    }


    // method use to get course curriculum to use in form add/update subject
    public function getCourseCurriculum($id = null)
    {
        $curriculum = Curriculum::where('course_id', $id)->where('active', 1)->get();

        $course_cu = null;

        foreach($curriculum as $c) {
            $course_cu[] = [
                        'id' => $c->id,
                        'name' => $c->name
                    ];
        }

        return $course_cu;
    }


    // method use to get major per curriculum in form add/update
    public function getMajorCurriculum($id = null)
    {
        $curriculum = Curriculum::where('major_id', $id)->where('active', 1)->get();

        $course_cu = null;

        foreach($curriculum as $c) {
            $course_cu[] = [
                        'id' => $c->id,
                        'name' => $c->name
                    ];
        }

        return $course_cu;
    }


    // method use to add subject
    public function addSubject()
    {
        $courses = Course::where('active', 1)->get();
        $subjects = Subject::where('active', 1)->get(['id', 'code']);
        $yl = YearLevel::get();
        $sem = Semester::get();

        return view('admin.subject-add', ['courses' => $courses, 'subjects' => $subjects, 'yl' => $yl, 'sem' => $sem]);
    }


    // method use to save new subject
    public function postAddSubject(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:subjects',
            'description' => 'required',
            'units' => 'required|numeric',
            'course' => 'required',
            'year_level' => 'required',
            'semester' => 'required',
            'curriculum' => 'required'
        ]);

        $code = $request['code'];
        $description = $request['description'];
        $units = $request['units'];
        $course_id = $request['course'];
        $major_id = $request['major'];
        $year_level_id = $request['year_level'];
        $semester_id = $request['semester'];
        $curriculum_id = $request['curriculum'];
        $prerequisite = $request['prerequisite'];

        $course = Course::findorfail($course_id);
        $major = CourseMajor::find($major_id);

        // save new subject
        $sub = new Subject();
        $sub->code = $code;
        $sub->description = $description;
        $sub->units = $units;
        $sub->course_id = $course->id;
        if(count($major) > 0) {
            $sub->major_id = $major->id;
        }
        else {
            $sub->major_id = null;
        }
        $sub->prerequisite = $prerequisite;
        $sub->curriculum_id = $curriculum_id;
        $sub->year_level_id = $year_level_id;
        $sub->semester_id = $semester_id;
        $sub->save();

        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Added New Subject');

        return redirect()->back()->with('success', 'Subject Added!');

    }


    // method use to update subject
    public function updateSubject($id = null)
    {
        $subject = Subject::findorfail($id);
        $subjects = Subject::where('active', 1)->get(['id', 'code']);
        $courses = Course::orderBy('title', 'asc')->get();
        $yl = YearLevel::get();
        $sem = Semester::get();

        return view('admin.subject-update', ['subject' => $subject, 'subjects' => $subjects, 'courses' => $courses, 'yl' => $yl, 'sem' => $sem]);
    }


    // method use to save update on subject
    public function postUpdateSubject(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'description' => 'required',
            'units' => 'required|numeric',
            'course' => 'required',
            'year_level' => 'required',
            'semester' => 'required',
            'curriculum' => 'required'
        ]);

        $subject_id = $request['subject_id'];
        $code = $request['code'];
        $description = $request['description'];
        $units = $request['units'];
        $course_id = $request['course'];
        $major_id = $request['major'];
        $year_level_id = $request['year_level'];
        $semester_id = $request['semester'];
        $curriculum_id = $request['curriculum'];

        $course = Course::findorfail($course_id);
        $major = CourseMajor::find($major_id);

        $sub = Subject::findorfail($subject_id);

        // check if code exists
        $check_code = Subject::where('code', $code)->first();

        if(count($check_code) > 0 && $sub->code != $code) {
            return redirect()->back()->with('error', 'Subject Code Exists. Please Check your input');
        }

        $sub->code = $code;
        $sub->description = $description;
        $sub->units = $units;
        $sub->course_id = $course->id;
        if(count($major) > 0) {
            $sub->major_id = $major->id;
        }
        else {
            $sub->major_id = null;
        }
        $sub->curriculum_id = $curriculum_id;
        $sub->year_level_id = $year_level_id;
        $sub->semester_id = $semester_id;
        $sub->save();

        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Updated Subject');

        return redirect()->route('admin.subjects')->with('success', 'Subject Updated!');
    }


    // route to view activity logs
    public function activityLogs()
    {
        $logs = ActivityLog::orderBy('created_at', 'desc')
                        ->paginate(15);

        return view('admin.activity-logs', ['logs' => $logs]);
    }

}
