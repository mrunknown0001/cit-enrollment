<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\GeneralController;

use App\User;
use App\Dean;
use App\Cashier;
use App\Registrar;
use App\Faculty;
use App\ActivityLog;
use App\Course;

class AdminController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:admin');
    }

    
    // method to view dashboard of admin
    public function dashboard()
    {
    	return view('admin.dashboard');
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
        $major = $request['major'];

        $check_title = Course::where('title', $title)->first();
        $check_code = Course::where('code', $code)->first();

        if(count($check_title) > 0 || count($check_code) > 0) {

            return redirect()->back()->with('error', 'Please check you input!');
        }

        // save course
        $course = new Course();
        $course->title = $title;
        $course->code = $code;
        $course->major = $major;
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
        $major = $request['major'];
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
        $course->major = $major;
        $course->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Updated Course');

        // return back with success message
        return redirect()->route('admin.courses')->with('success', 'Course Updated!');
    }


    // method use to view academic year and settings
    public function academicYear()
    {
        return view('admin.academic-year');
    }


    // method use to view year level
    public function yearLevel()
    {
        return view('admin.year-level');
    }


    // method use to view subjects
    public function subjects()
    {
        return view('admin.subjects');
    }


    // route to view activity logs
    public function activityLogs()
    {
        $logs = ActivityLog::orderBy('created_at', 'desc')
                        ->paginate(15);

        return view('admin.activity-logs', ['logs' => $logs]);
    }

}
