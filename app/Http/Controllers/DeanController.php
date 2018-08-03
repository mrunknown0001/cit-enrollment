<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\GeneralController;

use App\Dean;

class DeanController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:dean');
    }


    // method use to view dashboard
    public function dashboard()
    {
    	return view('dean.dashboard');
    }


    // method use to view profile of the dean
    public function profile()
    {
    	return view('dean.profile');
    }


    // method use to update profile of the dean
    public function updateProfile()
    {
    	return view('dean.profile-update');
    }


    // method use to save update of profile
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

        $dean = Dean::find(Auth::guard('dean')->user()->id);

        // check id number existence
        $check_id = Dean::where('id_number')->first();

        if(count($check_id) > 0 && $dean->id_number == $id_number && $id_number != null) {
        	return redirect()->back()->with('error', 'ID Number Exists!');
        }

        $dean->firstname = $firstname;
        $dean->middle_name = $middlename;
        $dean->lastname = $lastname;
        $dean->suffix_name = $suffix;
        $dean->id_number = $id_number;
        $dean->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('dean')->user()->id, 2, 'Dean Updated Profile');

        return redirect()->route('dean.profile')->with('success', 'Profile Updated!');
    }


    // method use to change password
    public function changePassword()
    {
    	return view('dean.password-change');
    }


    // method use to save new password for dean
    public function postChangePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        $old_password = $request['old_password'];
        $password = $request['password'];

        // check old password if matched to the correct password
        if(!password_verify($old_password, Auth::guard('dean')->user()->password)) {
            return redirect()->back()->with('error', 'Incorrect Old Password!');
        }

        // check if the new password is same as the old
        if(password_verify($password, Auth::guard('dean')->user()->password)) {
            return redirect()->back()->with('error', 'New Password Entered is Same as Old Password!');
        }

        // change password
        $dean = Dean::find(Auth::guard('dean')->user()->id);
        $dean->password = bcrypt($password);
        $dean->save();

        // add activty log
        GeneralController::activity_log(Auth::guard('dean')->user()->id, 2, 'Dean Change Password');

        // return to deans and add admin with message
        return redirect()->route('dean.dashboard')->with('success', 'Password Changed!');
    }


    // method use to show schedules
    public function schedules()
    {
        
    }

}
