<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\GeneralController;

use App\Faculty;

class FacultyController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:faculty');
    }


    // method use to view faculty dashboard
    public function dashboard()
    {
    	return view('faculty.dashboard');
    }


    // method use to view profile of faculty
    public function profile()
    {
    	return view('faculty.profile');
    }


    // method use to update profile of faculty
    public function updateProfile()
    {
    	return view('faculty.profile-update');
    }


    // method use to save update on profile of faculty
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

        $faculty = Faculty::find(Auth::guard('faculty')->user()->id);

        // check id number existence
        $check_id = Faculty::where('id_number')->first();

        if(count($check_id) > 0 && $faculty->id_number == $id_number && $id_number != null) {
            return redirect()->back()->with('error', 'ID Number Exists!');
        }

        $faculty->firstname = $firstname;
        $faculty->middle_name = $middlename;
        $faculty->lastname = $lastname;
        $faculty->suffix_name = $suffix;
        $faculty->id_number = $id_number;
        $faculty->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('faculty')->user()->id, 5, 'Faculty Updated Profile');

        return redirect()->route('faculty.profile')->with('success', 'Profile Updated!');
    }


    // method use to change password
    public function changePassword()
    {
    	return view('faculty.password-change');
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
        if(!password_verify($old_password, Auth::guard('faculty')->user()->password)) {
            return redirect()->back()->with('error', 'Incorrect Old Password!');
        }

        // check if the new password is same as the old
        if(password_verify($password, Auth::guard('faculty')->user()->password)) {
            return redirect()->back()->with('error', 'New Password Entered is Same as Old Password!');
        }

        // change password
        $faculty = Faculty::find(Auth::guard('faculty')->user()->id);
        $faculty->password = bcrypt($password);
        $faculty->save();

        // add activty log
        GeneralController::activity_log(Auth::guard('faculty')->user()->id, 5, 'Faculty Change Password');

        // return to deans and add admin with message
        return redirect()->route('faculty.dashboard')->with('success', 'Password Changed!');
    }

}
