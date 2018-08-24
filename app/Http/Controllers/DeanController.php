<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\GeneralController;

use App\Dean;
use App\Schedule;
use App\Room;
use App\Subject;
use App\AcademicYear;
use App\Semester;

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

        // return to deans and add dean with message
        return redirect()->route('dean.dashboard')->with('success', 'Password Changed!');
    }


    // method use to show schedules
    public function schedules()
    {
        $rooms = Room::orderBy('name', 'asc')->get();
        $subjects = Subject::where('active', 1)->orderBy('code', 'asc')->get();

        $schedules = Schedule::where('active', 1)->get();
        $mon = Schedule::where('active', 1)->where('day', 1)->orderBy('start_time', 'asc')->get();
        $tue = Schedule::where('active', 1)->where('day', 2)->orderBy('start_time', 'asc')->get();
        $wed = Schedule::where('active', 1)->where('day', 3)->orderBy('start_time', 'asc')->get();
        $thu = Schedule::where('active', 1)->where('day', 4)->orderBy('start_time', 'asc')->get();
        $fri = Schedule::where('active', 1)->where('day', 5)->orderBy('start_time', 'asc')->get();
        $sat = Schedule::where('active', 1)->where('day', 6)->orderBy('start_time', 'asc')->get();
        $sun = Schedule::where('active', 1)->where('day', 7)->orderBy('start_time', 'asc')->get();

        return view('dean.schedules', ['schedules' => $schedules, 'monday' => $mon, 'tuesday' => $tue, 'wednesday' => $wed, 'thursday' => $thu, 'friday' => $fri, 'saturday' => $sat, 'sunday' => $sun, 'rooms' => $rooms, 'subjects' => $subjects]);

    }


    // method use to add schedule
    public function addSchedule()
    {
        // room, subjects, time, days
        $rooms = Room::orderBy('name', 'asc')->get();
        $subjects = Subject::where('active', 1)->orderBy('code', 'asc')->get();

        return view('dean.schedule-add', ['rooms' => $rooms, 'subjects' => $subjects]);
    }


    // method use to save new schedule
    public function postAddSchedule(Request $request)
    {
        $request->validate([
            'room' => 'required',
            'subject' => 'required',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required'
        ]);

        $room_id = $request['room'];
        $subject_id = $request['subject'];
        $day = $request['day'];
        $st = $request['start_time'];
        $et = $request['end_time'];

        $ay = AcademicYear::where('active', 1)->first();
        $sem = Semester::where('active', 1)->first();

        $subject = Subject::findorfail($subject_id);
        $room = Room::findorfail($room_id);

        if($st > $et) {
            return redirect()->back()->with('error', 'Invalid End Time. End Time must later than STart Time');
        }

        //////////////////////////////////////////////////////
        // check if there is dupplicate or confict schedule //
        //////////////////////////////////////////////////////
        // check for duplicate
        $schedule = Schedule::where('active', 1)
                        ->where('room_id', $room_id)
                        ->where('subject_id', $subject->id)
                        ->where('day', $day)
                        ->where('start_time', $st)
                        ->where('end_time', $et)
                        ->first();
        if(count($schedule) > 0) {
            return redirect()->back()->with('error', 'Duplicate Schedule Found!');
        }

        $schedule = Schedule::where('active', 1)
                        ->where('room_id', $room_id)
                        ->where('day', $day)
                        ->where('start_time', $st)
                        ->where('end_time', $et)
                        ->first();
        if(count($schedule) > 0) {
            return redirect()->back()->with('error', 'Time Slot Filled Up!');
        }

        // ckeck for start time conflict on the day
        $schedules = Schedule::where('active', 1)
                        ->where('room_id', $room_id)
                        ->where('day', $day)
                        ->get();

        foreach($schedules as $sch) {
            if(($sch->end_time > $st && $sch->end_time < $et) || ($sch->start_time > $st && $sch->start_time < $et) || $sch->start_time == $st || $sch->end_time == $et) {
                return redirect()->back()->with('error', 'Time conflict on ' . GeneralController::get_day($sch->day) . ' ' . GeneralController::get_time($sch->start_time) . '-' . GeneralController::get_time($sch->end_time));
            }
        }


        // add new sched
        $sched = new Schedule();
        $sched->room_id = $room->id;
        $sched->subject_id = $subject->id;
        $sched->day = $day;
        $sched->start_time = $st;
        $sched->end_time = $et;
        $sched->save();

        // add activty log
        GeneralController::activity_log(Auth::guard('dean')->user()->id, 2, 'Dean Added New Schedule');

        // return to deans and add dean with message
        return redirect()->back()->with('success', 'Schedule Added!');
    }
















    // method use to view room management
    public function rooms()
    {
        $rooms = Room::orderBy('name', 'asc')->paginate(15);

        return view('dean.rooms', ['rooms' => $rooms]);
    }


    // method use to add room
    public function addRoom()
    {
        return view('dean.room-add');
    }


    // method use to save new room
    public function postAddRoom(Request $request)
    {
        $request->validate([
            'room_name' => 'required'
        ]);

        $name = $request['room_name'];

        // add new room in \
        $r = new Room();
        $r->name = $name;
        $r->save();

        GeneralController::activity_log(Auth::guard('dean')->user()->id, 2, 'Admin Added New Room');

        return redirect()->route('dean.rooms')->with('success', 'New Room Added!');
    }


    // method use to update room
    public function updateRoom($id = null)
    {
        $room = Room::findorfail($id);

        return view('dean.room-update', ['room' => $room]);
    }

    // method use to save room changes
    public function postUpdateRoom(Request $request)
    {
        $request->validate([
            'room_name' => 'required'
        ]);

        $name = $request['room_name'];
        $room_id = $request['room_id'];

        $room = Room::findorfail($room_id);

        // save update here
        $room->name = $name;
        $room->save();

        GeneralController::activity_log(Auth::guard('dean')->user()->id, 2, 'Admin Updated Room Details');

        return redirect()->route('dean.rooms')->with('success', 'Room Updated!');
    }





}
