<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\PaymentController;

use App\User;
use App\StudentInfo;
use App\Avatar;

class StudentController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }


    // method to show student dashboard
    public function dashboard()
    {
    	return view('student.dashboard');
    }


    // method use  to show profile
    public function profile()
    {
    	return view('student.profile');
    }


    // method use to update profile
    public function updateProfile($id = null)
    {
        $student = User::findorfail($id);

        if($student->id != Auth::user()->id) {
            return redirect()->route('student.dashboard')->with('error', 'Hey, Error Detected!');
        }

        return view('student.profile-update');
    }


    // method use to save profile update
    public function postUpdateProfile(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required'
        ]);

        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $middle_name = $request['middlename'];
        $suffix_name = $request['suffix_name'];
        $gender = $request['gender']; // save in sex column
        $mobile = $request['mobile_number'];
        $contact = $request['contact_number'];
        $email = $request['email'];
        $address = $request['address'];
        $nationality = $request['nationality'];
        $civil_status = $request['civil_status'];
        $dob = $request['date_of_birth']; // convert to date format
        $pob = $request['place_of_birth'];
        $religion = $request['religion'];
        $father = $request['fathers_name'];
        $mother = $request['mothers_name'];
        $parents_address = $request['parents_address'];
        $guardian = $request['guardians_name'];
        $guardians_address = $request['guardians_address'];

        $info = StudentInfo::where('student_id', Auth::user()->id)->first();
        $info->sex = $gender;
        $info->mobile_number = $mobile;
        $info->contact_number = $contact;
        $info->email = $email;
        $info->home_address = $address;
        $info->nationality = $nationality;
        $info->civil_status = $civil_status;
        $info->date_of_birth = date('Y-m-d', strtotime($dob));
        $info->place_of_birth = $pob;
        $info->religion = $religion;
        $info->fathers_name = $father;
        $info->mothers_name = $mother;
        $info->parents_address = $parents_address;
        $info->guardians_name = $guardian;
        $info->guardians_address = $guardians_address;
        $info->save();

        // add activity log
        GeneralController::activity_log(Auth::user()->id, 6, 'Student Updated Profile');

        return redirect()->route('student.profile')->with('success', 'Profile Updated!');

    }


    // method use to change password
    public function changePassword()
    {
        return view('student.password-change');
    }


    // method use to save new password
    public function postChangePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        $old = $request['old_password'];
        $password = $request['password'];

        // check old password to continue
        if(!password_verify($old, Auth::user()->password)) {
            return redirect()->back()->with('error', 'Old Password Invalid!');
        }

        // check if new password is same as the old
        if(password_verify($password, Auth::user()->password)) {
            return redirect()->back()->with('error', 'Please Chose Different Password!');
        }

        // save password
        Auth::user()->password = bcrypt($password);
        Auth::user()->save();

        GeneralController::activity_log(Auth::user()->id, 6, 'Student Change Password');

        return redirect()->back()->with('success', 'Password Change!');

    }


    // method use to change avatar
    public function uploadProfileImage()
    {
        return view('student.profile-image-upload');
    }


    // method use to upload profile image
    public function postUploadProfileImage(Request $request)
    {
        // get current time and append the upload file extension to it,
        // then put that name to $photoName variable.
        $photoname = time().'.'.$request->image->getClientOriginalExtension();

        /*
        talk the select file and move it public directory and make avatars
        folder if doesn't exsit then give it that unique name.
        */
        $request->image->move(public_path('uploads/images'), $photoname);


        $avatar = Avatar::where('student_id', Auth::user()->id)->first();

        // save photoname to database
        if(count($avatar) < 1) {
            $avatar = new Avatar();
            $avatar->student_id = Auth::user()->id;
            $avatar->name = $photoname;
            $avatar->save();
        }
        else {
            $avatar->name = $photoname;
            $avatar->save();
        }

        // add activity log
        GeneralController::activity_log(Auth::user()->id, 6, 'Student Change Avatar');

        // return to dashboard
        return redirect()->route('student.dashboard')->with('success', 'Avatar Uploaded!');
    }
}
