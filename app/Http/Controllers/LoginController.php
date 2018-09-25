<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Session;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\SmsController;
use App\Admin;
use App\Dean;
use App\Registrar;
use App\Cashier;
use App\Faculty;
use App\User;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    // method use to show login form for admin
    public function adminLogin()
    {
    	return GeneralController::auth_check('admin-login');
    }


    // method use to login admin
    public function postAdminLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request['username'];
        $password = $request['password'];
        $remember = $request['remember_me'];

        // attempt to login admin
        if(Auth::guard('admin')->attempt(['username' => $username, 'password' => $password], $remember)) {

            // check if the session id is not null
            if(Auth::guard('admin')->user()->session_id != null) {
                Auth::guard('admin')->logout();
                return redirect()->back()->with('error', 'Admin is currently logged in!!!');
            }

            Auth::guard('admin')->user()->session_id = Session::getId();
            Auth::guard('admin')->user()->save();

            GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Login');

            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->with('error', 'Authentication Error!');
    }


    // method use to show login form for student
    public function studentLogin()
    {
    	return GeneralController::auth_check('student-login');
    }


    // method use to login student
    public function postStudentLogin(Request $request)
    {
        $request->validate([
            'student_number' => 'required',
            'password' => 'required'
        ]);

        $sn = $request['student_number'];
        $password = $request['password'];
        $remember = $request['remember_me'];

        // attempt to login admin
        if(Auth::attempt(['student_number' => $sn, 'password' => $password], $remember)) {

            // check if the session id is not null
            if(Auth::user()->session_id != null) {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Account has active session!!!');
            }

            Auth::user()->session_id = Session::getId();
            Auth::user()->save();

            GeneralController::activity_log(Auth::user()->id, 6, 'Student Login');

            return redirect()->route('student.dashboard');
        }

        return redirect()->back()->with('error', 'Authentication Error!');
    }


    // method use to show login form for dean
    public function deanLogin()
    {
    	return view('dean-login');
    }


    // method use to login dean
    public function postDeanLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request['username'];
        $password = $request['password'];
        $remember = $request['remember_me'];

        // attempt to login dean
        if(Auth::guard('dean')->attempt(['username' => $username, 'password' => $password], $remember)) {

            // check if the session id is not null
            if(Auth::guard('dean')->user()->session_id != null) {
                Auth::guard('dean')->logout();
                return redirect()->back()->with('error', 'Dean is currently logged in!!!');
            }

            Auth::guard('dean')->user()->session_id = Session::getId();
            Auth::guard('dean')->user()->save();

            GeneralController::activity_log(Auth::guard('dean')->user()->id, 2, 'Dean Login');

            return redirect()->route('dean.dashboard');
        }

        return redirect()->back()->with('error', 'Authentication Error!');
    }


    // method use to show login form for cashier
    public function cashierLogin()
    {
    	return view('cashier-login');
    }


    // method use to login cashier
    public function postCashierLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request['username'];
        $password = $request['password'];
        $remember = $request['remember_me'];

        // attempt to login dean
        if(Auth::guard('cashier')->attempt(['username' => $username, 'password' => $password], $remember)) {

            // check if the session id is not null
            if(Auth::guard('cashier')->user()->session_id != null) {
                Auth::guard('cashier')->logout();
                return redirect()->back()->with('error', 'Cashier is currently logged in!!!');
            }

            Auth::guard('cashier')->user()->session_id = Session::getId();
            Auth::guard('cashier')->user()->save();

            GeneralController::activity_log(Auth::guard('cashier')->user()->id, 4, 'Cashier Login');

            return redirect()->route('cashier.dashboard');
        }

        return redirect()->back()->with('error', 'Authentication Error!');
    }


    // method use to show login form for registrar
    public function registrarLogin()
    {
    	return view('registrar-login');
    }


    // method use to login registrar
    public function postRegistrarLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request['username'];
        $password = $request['password'] ;
        $remember = $request['remember_me'];

        // attempt to login registrar
        if(Auth::guard('registrar')->attempt(['username' => $username, 'password' => $password], $remember)) {

            // check if the session id is not null
            if(Auth::guard('registrar')->user()->session_id != null) {
                Auth::guard('registrar')->logout();
                return redirect()->back()->with('error', 'Registrar is currently logged in!!!');
            }

            Auth::guard('registrar')->user()->session_id = Session::getId();
            Auth::guard('registrar')->user()->save();

            GeneralController::activity_log(Auth::guard('registrar')->user()->id, 3, 'Registrar Login');

            return redirect()->route('registrar.dashboard');
        }

        return redirect()->back()->with('error', 'Authentication Error!');
    }


    // method use to show login form for faculty
    public function facultyLogin()
    {
    	return view('faculty-login');
    }


    // method use to login faculty
    public function postFacultyLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request['username'];
        $password = $request['password'] ;
        $remember = $request['remember_me'];

        // attempt to login registrar
        if(Auth::guard('faculty')->attempt(['username' => $username, 'password' => $password], $remember)) {

            // check if the session id is not null
            if(Auth::guard('faculty')->user()->session_id != null) {
                Auth::guard('faculty')->logout();
                return redirect()->back()->with('error', 'Faculty is currently logged in!!!');
            }

            Auth::guard('faculty')->user()->session_id = Session::getId();
            Auth::guard('faculty')->user()->save();

            GeneralController::activity_log(Auth::guard('faculty')->user()->id, 5, 'Faculty Login');

            return redirect()->route('faculty.dashboard');
        }

        return redirect()->back()->with('error', 'Authentication Error!');   
    }


    protected function hasTooManyLoginAttempts(Request $request)
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), 3, 5
        );
    }


    // method used in forgot password
    public function forgotPassword()
    {
        return view('student-forgot-password');
    }


    // method use to check studet number and send code
    public function postForgotPassword(Request $request)
    {
        $request->validate([
            'student_number' => 'required'
        ]);

        // check for the student number
        $sn = $request['student_number'];

        $student = User::where('student_number', $sn)->first();

        // check if registered
        if($student->registered == 0) {
            return redirect()->back()->with('info', 'Student Not Registered!');
        }

        if(count($student) < 1) {
            return redirect()->back()->with('error', 'Student Number Not Found!');
        }
        
        // send code
        if($student->info->mobile_number != null) {
            // generate code
            $code = strtoupper(uniqid());

            // to suers table in code and expiration code
            $student->reset_code = $code;
            $student->code_expiration = strtotime(now()) + 300;
            $student->save();

            $message = "The reset code for the student number " .$student->student_number . " is " . $code;

            // send code
            SmsController::sendSms($student->info->mobile_number, $message);

        }
        else {
            return redirect()->back()->with('error', 'Student has no mobile number. Please report to admin to reset password!');
        }

        // return response
        return redirect()->route('enter.reset.code');
    }


    // method use to enter reset code
    public function enterResetCode()
    {
        return view('student-enter-code');
    }


    // method use to check code and redirect to reset password page
    public function postEnterResetCode(Request $request)
    {
        $request->validate([
            'code' => 'required'
        ]);

        $code = $request['code'];

        $student = User::where('reset_code', $code)->first();

        if(count($student) < 1) {
            return redirect()->back()->with('error', 'Code Invalid or Expired!');
        }

        if(strtotime(now()) > $student->code_expiration) {
            return redirect()->back()->with('error', 'Code Invalid or Expired!');
        }

        // // make code and code expiration null
        // $student->reset_code = null;
        // $student->code_expiration = null;
        // $student->save();

        return view('student-reset-password', ['student' => $student]);
    }


    // method use to reset password of student
    public function postResetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6|max:32'
        ]);

        $password = $request['password'];
        $student_id = $request['student_id'];

        $student = User::findorfail($student_id);

        // add checking for data tampering

        // // make code and code expiration null
        $student->reset_code = null;
        $student->code_expiration = null;

        $student->password = bcrypt($password);
        $student->save();

        return redirect()->route('login')->with('success', 'Password Changed!');
    }



}
