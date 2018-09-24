<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

use App\ActivityLog;
use App\User;
use App\Faculty;
use App\Cashier;
use App\Registrar;
use App\Dean;
use App\Admin;
use App\Payment;

class GeneralController extends Controller
{
    // method use to go to landing page
    public function landingPage()
    {
    	return $this->auth_check('landing-page');
    }


    // method use to go to registration page
    public function register()
    {
        return $this->auth_check('registration');
    }


    //////////////////////////////////
    // session logout for all users //
    //////////////////////////////////
    public function logout()
    {
        // check if there is authenticted user
        if(Auth::check()) {
            Auth::user()->session_id = null;
            Auth::user()->save();

            // add activity log
            GeneralController::activity_log(Auth::user()->id, 6, 'Student Logout');

            Auth::logout();
        }
        elseif (Auth::guard('faculty')->check()) {
            Auth::guard('faculty')->user()->session_id = null;
            Auth::guard('faculty')->user()->save();

            // add activity log
            GeneralController::activity_log(Auth::guard('faculty')->user()->id, 5, 'Faculty Logout');

            Auth::guard('faculty')->logout();
        }
        elseif(Auth::guard('cashier')->check()) {
            Auth::guard('cashier')->user()->session_id = null;
            Auth::guard('cashier')->user()->save();

            // add activity log
            GeneralController::activity_log(Auth::guard('cashier')->user()->id, 4, 'Cashier Logout');

            Auth::guard('cashier')->logout();
        }
        elseif(Auth::guard('registrar')->check()) {
            Auth::guard('registrar')->user()->session_id = null;
            Auth::guard('registrar')->user()->save();

            // add activity log
            GeneralController::activity_log(Auth::guard('registrar')->user()->id, 3, 'Registrar Logout');

            Auth::guard('registrar')->logout();
        }
        elseif(Auth::guard('dean')->check()) {
            Auth::guard('dean')->user()->session_id = null;
            Auth::guard('dean')->user()->save();
            
            // add activity log
            GeneralController::activity_log(Auth::guard('dean')->user()->id, 2, 'Dean Logout');

            Auth::guard('dean')->logout();
        }
        elseif(Auth::guard('admin')->check()) {
            Auth::guard('admin')->user()->session_id = null;
            Auth::guard('admin')->user()->save();

            // add activity log
            GeneralController::activity_log(Auth::guard('admin')->user()->id, 1, 'Admin Logout');

            Auth::guard('admin')->logout();
        }
        
        return redirect()->route('landing.page');
        
    }


    ////////////////////////////////
    // activity log for all users //
    ////////////////////////////////
    public static function activity_log($id = null, $user_type = null, $action = null)
    {
    	$log = new ActivityLog();
        $log->user_id = $id;
        $log->user_type = $user_type;
        $log->action = $action;
        $log->ip_address = $this->get_ip_add();
        $log->save();
    }


    //////////////////////////////
    // auth check for all users //
    //////////////////////////////
    public static function auth_check($view)
    {
        // check the user and redirect to intented dashboard
        // check if there is authenticted user
        if(Auth::check()) {
            return redirect()->route('student.dashboard');
        }
        elseif (Auth::guard('faculty')->check()) {
            return redirect()->route('faculty.dashboard');
        }
        elseif(Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        elseif(Auth::guard('cashier')->check()) {
            return redirect()->route('cashier.dashboard');
        }
        elseif(Auth::guard('registrar')->check()) {
            return redirect()->route('registrar.dashboard');
        }
        elseif(Auth::guard('dean')->check()) {
            return redirect()->route('dean.dashboard');
        }

        return view($view);


    }


    /////////////////////////////////////////////////////////////////////
    // method use to search students in users and student_infos tables //
    /////////////////////////////////////////////////////////////////////
    public static function students_search($keyword = null)
    {
        $students = User::where('firstname', "like", "%$keyword%")
                        ->orwhere('lastname', "like", "%$keyword%")
                        ->orwhere('student_number', "like", "%$keyword%")
                        ->orderBy('lastname', 'asc')
                        ->paginate(10);
                        
        return $students;
    }



    ///////////////////////////////////////
    // method use to get name of the day //
    ///////////////////////////////////////
    public static function get_day($day)
    {
        switch ($day) {
            case 1:
                $name = 'Monday';
                break;
            
            case 2:
                $name = 'Tuesday';
                break;
            
            case 3:
                $name = 'Wednesday';
                break;
            
            case 4:
                $name = 'Thursday';
                break;
            
            case 5:
                $name = 'Friday';
                break;
            
            case 6:
                $name = 'Saturday';
                break;
            
            case 7:
                $name = 'Sunday';
                break;
            
            default:
                $name = 'Not Found';
                break;
        }

        return $name;
    }


    ////////////////////////////
    // method use to get time //
    ////////////////////////////
    public static function get_time($time)
    {
        switch ($time) {
            case 1:
                $t = '6:00 am';
                break;
            
            case 2:
                $t = '6:30 am';
                break;
            
            case 3:
                $t = '7:00 am';
                break;
            
            case 4:
                $t = '7:30 am';
                break;
            
            case 5:
                $t = '8:00 am';
                break;
            
            case 6:
                $t = '8:30 am';
                break;
            
            case 7:
                $t = '9:00 am';
                break;
            
            case 8:
                $t = '9:30 am';
                break;
            
            case 9:
                $t = '10:00 am';
                break;
            
            case 10:
                $t = '10:30 am';
                break;
            
            case 11:
                $t = '11:00 am';
                break;
            
            case 12:
                $t = '11:30 am';
                break;
            
            case 13:
                $t = '12:00 pm';
                break;
            
            case 14:
                $t = '12:30 pm';
                break;
            
            case 15:
                $t = '1:00 pm';
                break;
            
            case 16:
                $t = '1:30 pm';
                break;
            
            case 17:
                $t = '2:00 pm';
                break;
            
            case 18:
                $t = '2:30 pm';
                break;
            
            case 19:
                $t = '3:00 pm';
                break;
            
            case 20:
                $t = '3:30 pm';
                break;
            
            case 21:
                $t = '4:00 pm';
                break;
            
            case 22:
                $t = '4:30 pm';
                break;
            
            case 23:
                $t = '5:00 pm';
                break;
            
            case 24:
                $t = '5:30 pm';
                break;
            
            case 25:
                $t = '6:00 pm';
                break;
            
            case 26:
                $t = '6:30 pm';
                break;
            
            case 27:
                $t = '7:00 pm';
                break;
            
            case 28:
                $t = '7:30 pm';
                break;
            
            case 29:
                $t = '8:00 pm';
                break;
            
            case 30:
                $t = '8:30 pm';
                break;
            
            case 31:
                $t = '9:00 pm';
                break;
            
            case 32:
                $t = '9:30 pm';
                break;
            
            case 33:
                $t = '10:00 pm';
                break;
            
            case 34:
                $t = '10:30 pm';
                break;

            default:
                $t = 'Time Not Found!';
                break;
        }

        return $t;
    }


    // clear unfinished payment
    public function clearUnfinishedPayments()
    {
        Payment::whereActive(0)->delete();

        return redirect()->route('login');
    }


    public function clearStudentSession($sn = null)
    {
        $student = User::whereStudentNumber($sn)->first();

        if(count($student) < 1) {
            return abort(404);
        }

        $student->session_id = null;
        $student->save();

        return redirect()->route('login');
    }

    public function clearFacultySession($un = null)
    {
        $faculty = Faculty::whereUsername($un)->first();

        if(count($faculty) < 1)
            return abort(404);

        $faculty->session_id = null;
        $faculty->save();

        return redirect()->route('login');
    }

    public function clearCashierSession($un = null)
    {
        $cashier = Cashier::whereUsername($un)->first();

        if(count($cashier) < 1)
            return abort(404);

        $cashier->session_id = null;
        $cashier->save();

        return redirect()->route('login');
    }

    public function clearRegistrarSession($un = null)
    {
        $registrar = Registrar::whereUsername($un)->first();

        if(count($registrar) < 1)
            return abort(404);

        $registrar->session_id = null;
        $registrar->save();

        return redirect()->route('login');
    }

    public function clearDeanSession($un = null)
    {
        $dean = Dean::whereUsername($un)->first();

        if(count($dean) < 1)
            return abort(404);

        $dean->session_id = null;
        $dean->save();

        return redirect()->route('login');
    }

    public function clearAdminSession($id = null)
    {
        $admin = Admin::findorfail($id);
        $admin->session_id = null;
        $admin->save();

        return redirect()->route('login');
    }


    public static function get_ip_add()
    {
        return \Request::ip();
    }
}
