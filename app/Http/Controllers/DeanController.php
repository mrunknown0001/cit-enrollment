<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\GeneralController;
use Session;
use DB;

use App\Dean;
use App\Schedule;
use App\Room;
use App\Subject;
use App\AcademicYear;
use App\Semester;
use App\Section;
use App\Course;
use App\YearLevel;
use App\CourseMajor;
use App\Curriculum;
use App\FacultyLoad;
use App\Faculty;

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
            'password' => 'required|confirmed|min:6|max:32'
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

        return view('dean.schedules', ['rooms' => $rooms, 'subjects' => $subjects]);

    }


    // method use to get major oncourses
    public function getCourseMajor($id = null)
    {
        $majors = CourseMajor::where('course_id', $id)
                            ->where('active', 1)
                            ->get();

        return $majors;

    }


    // method use to get course curriculum to use in form add/update subject
    public function getCourseCurriculum($id = null)
    {
        $curriculum = Curriculum::where('course_id', $id)->where('active', 1)->get();

        $course_cu = null;

        if(count($curriculum) < 1) {
            return null;
        }

        foreach($curriculum as $c) {
            $course_cu[] = [
                        'id' => $c->id,
                        'name' => $c->name
                    ];
        }

        return $course_cu;
    }


    // method use to select course, year level and section
    public function addScheduleSelect()
    {
        $courses = Course::orderBy('code', 'asc')->get();
        $yl = YearLevel::get(['id', 'name']);
        $sections = Section::orderBy('name', 'asc')->get(['id', 'name']);

        return view('dean.schedule-add-select', ['courses' => $courses, 'yl' => $yl, 'sections' => $sections]);
    }


    // method use to add schedule
    public function addSchedule(Request $request)
    {
        $request->validate([
            'course' => 'required',
            'year_level' => 'required',
            'curriculum' => 'required',
            'section' => 'required' 
        ]);

        $course_id = $request['course'];
        $major_id = $request['major'];
        $yl_id = $request['year_level'];
        $section_id = $request['section'];
        $curriculum_id = $request['curriculum'];

        $course = Course::findorfail($course_id);
        $yl = YearLevel::findorfail($yl_id);
        $section = Section::findorfail($section_id);
        $major = CourseMajor::find($major_id);
        $curriculum = Curriculum::findorfail($curriculum_id);

        $sem = Semester::whereActive(1)->first();

        if(count($sem) < 1) {
            return redirect()->route('dean.schedules')->with('error', 'Semester Not Selected! Please report to admin');
        }

        // room, subjects, time, days
        $rooms = Room::orderBy('name', 'asc')->get();
        $subjects = Subject::where('active', 1)
                    ->where('curriculum_id', $curriculum->id)
                    ->where('semester_id', $sem->id)
                    ->where('year_level_id', $yl->id)
                    ->orderBy('code', 'asc')
                    ->get();

        return view('dean.schedule-add', ['rooms' => $rooms, 'subjects' => $subjects, 'course' => $course, 'yl' => $yl, 'sem' => $sem, 'section' => $section, 'major' => $major, 'curriculum' => $curriculum]);
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

        $course_id = $request['course'];
        $major_id = $request['major'];
        $yl_id = $request['year_level'];
        $section_id = $request['section'];
        $curriculum_id = $request['curriculum'];

        $course = Course::findorfail($course_id);
        $yl = YearLevel::findorfail($yl_id);
        $section = Section::findorfail($section_id);
        $major = CourseMajor::findorfail($major_id);
        $curriculum = Curriculum::findorfail($curriculum_id);

        $room_id = $request['room'];
        $subject_id = $request['subject'];
        $day = $request['day'];
        $st = $request['start_time'];
        $et = $request['end_time'];

        $ay = AcademicYear::where('active', 1)->first();
        $sem = Semester::where('active', 1)->first();

        $subject = Subject::findorfail($subject_id);
        $room = Room::findorfail($room_id);

        // the start time is later than the end time
        if($st > $et) {
            return redirect()->back()->with('error', 'Invalid End Time. End Time must later than STart Time');
        }

        if($st == $et) {
            return redirect()->back()->with('error', 'Start and End Time must not Equal');
        }


        if(($et - $st) > 6) {
            return redirect()->back()->with('error', 'Max of 3 hours per class');
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
            return redirect()->back()->with('error', 'Time confict!');
        }

        // slot filled
        $schedule = Schedule::where('active', 1)
                        ->where('room_id', $room_id)
                        ->where('day', $day)
                        ->where('start_time', $st)
                        ->where('end_time', $et)
                        ->first();
        if(count($schedule) > 0) {
            return redirect()->back()->with('error', 'Time Slot Filled Up!');
        }

        // time conflict
        $schedule = Schedule::where('active', 1)
                        ->where('section_id', $section->id)
                        ->where('day', $day)
                        ->where('start_time', $st)
                        ->where('end_time', $et)
                        ->first();
        if(count($schedule) > 0) {
            return redirect()->back()->with('error', 'Time Conflict on Section!');
        }
        // $schedule = Schedule::where('active', 1)
        //                 ->where('day', $day)
        //                 ->where('start_time', $st)
        //                 ->where('end_time', $et)
        //                 ->first();
        // if(count($schedule) > 0) {
        //     return redirect()->back()->with('error', 'Time Conflict on Section!');
        // }


        // ckeck for start time conflict on the day
        $schedules = Schedule::where('active', 1)
                        ->where('room_id', $room_id)
                        ->where('day', $day)
                        ->get();


        foreach($schedules as $sch) {
            if(($sch->end_time > $st && $sch->end_time < $et) || 
                ($sch->start_time > $st && $sch->start_time < $et) || 
                $sch->start_time == $st || 
                $sch->end_time == $et || 
                ($sch->start_time < $st && $sch->end_time > $et) || 
                ($sch->start_time > $st && $sch->end_time < $et)) {
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
        $sched->section_id = $section->id;
        $sched->year_level_id = $yl->id;
        $sched->course_id = $course->id;
        $sched->curriculum_id = $curriculum->id;
        $sched->save();

        // add activty log
        GeneralController::activity_log(Auth::guard('dean')->user()->id, 2, 'Dean Added New Schedule');

        // return to deans and add dean with message
        return redirect()->back()->with('success', 'Schedule Added!');
    }


    // method use to delete schedule
    public function deleteSchedule($id = null)
    {
        $sched = Schedule::findorfail($id);
        $sched->delete();

        GeneralController::activity_log(Auth::guard('dean')->user()->id, 2, 'Dean Deleted Schedule');

        return redirect()->back()->with('success', 'Schedule Deleted!');
    }


    // method use to update schedule
    public function updateSchedule($id = null)
    {
        $schedule = Schedule::findorfail($id);

        $course = Course::findorfail($schedule->course_id);
        $major = CourseMajor::find($schedule->major_id);
        $curriculum = Curriculum::findorfail($schedule->curriculum_id);
        $yl = YearLevel::findorfail($schedule->year_level_id);
        $section = Section::findorfail($schedule->section_id);

        $sem = Semester::whereActive(1)->first();

        // room, subjects, time, days
        $rooms = Room::orderBy('name', 'asc')->get();
        $subjects = Subject::where('active', 1)
                    ->where('curriculum_id', $schedule->curriculum_id)
                    ->where('semester_id', $sem->id)
                    ->where('year_level_id', $schedule->year_level_id)
                    ->orderBy('code', 'asc')
                    ->get();

        // return view('dean.schedule-update', ['rooms' => $rooms, 'subjects' => $subjects, 'schedule' => $schedule]);

        return view('dean.schedule-update', ['rooms' => $rooms, 'subjects' => $subjects, 'course' => $course, 'yl' => $yl, 'sem' => $sem, 'section' => $section, 'major' => $major, 'curriculum' => $curriculum, 'schedule' => $schedule]);

    }


    // method use to save update on schedule
    public function postUpdateSchedule(Request $request)
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
        $schedule_id = $request['schedule_id'];

        $sched = Schedule::findorfail($schedule_id);

        $ay = AcademicYear::where('active', 1)->first();
        $sem = Semester::where('active', 1)->first();

        $subject = Subject::findorfail($subject_id);
        $room = Room::findorfail($room_id);


        // start condition in updating schedule
        // the start time is later than the end time
        if($st > $et) {
            return redirect()->back()->with('error', 'Invalid End Time. End Time must later than STart Time');
        }

        if($st == $et) {
            return redirect()->back()->with('error', 'Start and End Time must not Equal');
        }

        if(($et - $st) > 6) {
            return redirect()->back()->with('error', 'Max of 3 hours per class');
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
        if(count($schedule) > 0 && $schedule->id != $sched->id) {
            return redirect()->back()->with('error', 'Duplicate Schedule Found!');
        }

        $schedule = Schedule::where('active', 1)
                        ->where('room_id', $room_id)
                        ->where('day', $day)
                        ->where('start_time', $st)
                        ->where('end_time', $et)
                        ->first();
        if(count($schedule) > 0 && $schedule->id != $sched->id) {
            return redirect()->back()->with('error', 'Time Slot Filled Up!');
        }


        // ckeck for start time conflict on the day
        $schedules = Schedule::where('active', 1)
                        ->where('room_id', $room_id)
                        ->where('day', $day)
                        ->get();


        foreach($schedules as $sch) {
            if($sch->id != $sched->id) {
                if(($sch->end_time > $st && $sch->end_time < $et) || 
                    ($sch->start_time > $st && $sch->start_time < $et) || 
                    $sch->start_time == $st || 
                    $sch->end_time == $et || 
                    ($sch->start_time < $st && $sch->end_time > $et) || 
                    ($sch->start_time > $st && $sch->end_time < $et)) {
                    return redirect()->back()->with('error', 'Time conflict on ' . GeneralController::get_day($sch->day) . ' ' . GeneralController::get_time($sch->start_time) . '-' . GeneralController::get_time($sch->end_time));
                }
            }
        }


        // update schedule
        $sched->room_id = $room->id;
        $sched->subject_id = $subject->id;
        $sched->day = $day;
        $sched->start_time = $st;
        $sched->end_time = $et;
        $sched->save();

        // add activty log
        GeneralController::activity_log(Auth::guard('dean')->user()->id, 2, 'Dean Updated Schedule');

        // return to deans and add dean with message
        return redirect()->back()->with('success', 'Schedule Updated!');
    }


    // method use to view sched in monday
    public function mondaySchedule()
    {
        $rooms = Room::orderBy('name', 'asc')->get();
        $schedules = Schedule::whereActive(1)
                    ->where('day',1)
                    ->orderBy('start_time', 'asc')
                    ->get();

        return view('dean.schedules-monday', ['rooms' => $rooms, 'schedules' => $schedules]);
    }

    
    // method use to view sched in tuesday
    public function tuesdaySchedule()
    {
        $rooms = Room::orderBy('name', 'asc')->get();
        $schedules = Schedule::whereActive(1)
                    ->where('day',2)
                    ->orderBy('start_time', 'asc')
                    ->get();

        return view('dean.schedules-tuesday', ['rooms' => $rooms, 'schedules' => $schedules]);
    }
    
    
    // method use to view sched in wednesday
    public function wednesdaySchedule()
    {
        $rooms = Room::orderBy('name', 'asc')->get();
        $schedules = Schedule::whereActive(1)
                    ->where('day',3)
                    ->orderBy('start_time', 'asc')
                    ->get();

        return view('dean.schedules-wednesday', ['rooms' => $rooms, 'schedules' => $schedules]);
    }
    

    // method use to view sched in thursday
    public function thursdaySchedule()
    {
        $rooms = Room::orderBy('name', 'asc')->get();
        $schedules = Schedule::whereActive(1)
                    ->where('day',4)
                    ->orderBy('start_time', 'asc')
                    ->get();

        return view('dean.schedules-thursday', ['rooms' => $rooms, 'schedules' => $schedules]);
    }
    

    // method use to view sched in friday
    public function fridaySchedule()
    {
        $rooms = Room::orderBy('name', 'asc')->get();
        $schedules = Schedule::whereActive(1)
                    ->where('day',5)
                    ->orderBy('start_time', 'asc')
                    ->get();

        return view('dean.schedules-friday', ['rooms' => $rooms, 'schedules' => $schedules]);
    }
    

    // method use to view sched in saturday
    public function saturdaySchedule()
    {
        $rooms = Room::orderBy('name', 'asc')->get();
        $schedules = Schedule::whereActive(1)
                    ->where('day',6)
                    ->orderBy('start_time', 'asc')
                    ->get();

        return view('dean.schedules-saturday', ['rooms' => $rooms, 'schedules' => $schedules]);
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
            'room_name' => 'required|unique:rooms,name'
        ]);

        $name = $request['room_name'];

        // add new room in \
        $r = new Room();
        $r->name = strtolower($name);
        $r->save();

        GeneralController::activity_log(Auth::guard('dean')->user()->id, 2, 'Dean Added New Room');

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

        $check_room = Room::where('name', strtolower($name))->first();

        if(count($check_room) > 0 && $check_room->id != $room->id) {
            return redirect()->back()->with('error', 'Room Already Exist!');
        }

        // save update here
        $room->name = strtolower($name);
        $room->save();

        GeneralController::activity_log(Auth::guard('dean')->user()->id, 2, 'Dean Updated Room Details');

        return redirect()->route('dean.rooms')->with('success', 'Room Updated!');
    }


    // method use to delete room
    public function deleteRoom($id = null)
    {
        $room = Room::findorfail($id);
        $room->delete();

        GeneralController::activity_log(Auth::guard('dean')->user()->id, 2, 'Dean Deleted Room');

        return redirect()->route('dean.rooms')->with('success', 'Room Deleted!');
    }






    // method use to view sections
    public function sections()
    {
        $sections = Section::get(['id', 'name']);

        return view('dean.sections', ['sections' => $sections]);
    }


    // method use to save new section
    public function postAddSection(Request $request)
    {
        $request->validate([
            'section_name' => 'required|unique:sections,name'
        ]);

        $name = $request['section_name'];

        $section = new Section();
        $section->name = $name;
        $section->save();

        //
        GeneralController::activity_log(Auth::guard('dean')->user()->id, 2, 'Dean Added New Section');

        return redirect()->route('dean.sections')->with('success', 'Section Added!');        
    }


    // method use to update section
    public function postUpdateSection(Request $request)
    {
        $request->validate([
            'section_name' => 'required'
        ]);

        $id = $request['section_id'];
        $name = $request['section_name'];

        $section = Section::findorfail($id);

        $check_name = Section::where('name', $name)->first();

        if(count($check_name) > 0 && $check_name->id != $section->id) {
            return redirect()->back()->with('error', 'Section Name was already taken!');
        }

        $section->name = $name;
        $section->save();

        GeneralController::activity_log(Auth::guard('dean')->user()->id, 2, 'Dean Updated Section');

        return redirect()->route('dean.sections')->with('success', 'Section Updated!');   
    }


    // method use to view faculty load in dean
    public function facultyLoad()
    {
        $loads = FacultyLoad::whereActive(1)->get();

        return view('dean.faculty-load', ['loads' => $loads]);
    }


    // method use to select course year level section available in schedules
    public function addFacultySelection()
    {
        // get all distinct course year level and section
        // where to select subjects
        $sections = Schedule::where('active', 1)
                    ->distinct(['course_id', 'curriculum_id', 'year_level_id', 'section_id'])
                    ->orderBy('course_id', 'year_level_id', 'section_id')
                    ->get();


        return view('dean.faculty-load-select', ['sections' => $sections]);
    }


    // method use to select subject load of the faculty
    public function selectFacultyLoad(Request $request)
    {
        $request->validate([
            'section' => 'required'
        ]);

        $section_sched = $request['section'];

        $schedule = Schedule::findorfail($section_sched);

        // get all subjects in the schedule having same course, curriculum, yearl level and section
        $subject_ids = Schedule::whereActive(1)
                    ->distinct(['course_id', 'curriculum_id', 'year_level_id', 'section_id'])
                    ->get(['subject_id']);

        $subjects = Subject::find($subject_ids);

        // get all active faculty
        $faculty = Faculty::orderBy('lastname', 'asc')->get();


        return view('dean.faculty-load-add', ['schedule' => $schedule, 'faculty' => $faculty, 'subjects' => $subjects]);
    }


    // method use to add faculty laod 
    public function addFacultyLoad()
    {
        $sem = Semester::whereActive(1)->first();

        if(count($sem) < 1) {
            return redirect()->back()->with('error', 'No Active Semester. Please report to admin.');
        }

        // get all faculty
        $faculty = Faculty::orderBy('lastname', 'asc')->get(['id', 'firstname', 'lastname']);

        // get all active subject for the current semester
        $subjects = Subject::where('semester_id', $sem->id)->orderby('code', 'asc')->get();

        // get schedule, course, year level, subjects

        return view('dean.faculty-load-add', [
            'faculty' => $faculty
        ]);
    }


    // method use to save faculty load assignment
    public function postAddFacultyLoad(Request $request)
    {
        $request->validate([
            'faculty' => 'required',
            'subject' => 'required'
        ]);

        $schedule_id = $request['schedule_id'];
        $faculty_id = $request['faculty'];
        $subject_id = $request['subject'];

        $schedule = Schedule::findorfail($schedule_id);

        $faculty = Faculty::findorfail($faculty_id);
        $subject = Subject::findorfail($subject_id);

        $ay = AcademicYear::whereActive(1)->first();
        $sem = Semester::whereActive(1)->first();

        if(count($ay) < 1 || count($sem) < 1) {
            return redirect()->back()->with('error', 'No Active Academic Year or Semester. Please contact the administrator.');
        }

        // check duplicate subject Assignment
        $check_conflict = FacultyLoad::where('course_id', $schedule->course->id)
                                    ->where('curriculum_id', $schedule->curriculum->id)
                                    ->where('year_level_id', $schedule->year_level->id)
                                    ->where('academic_year_id', $ay->id)
                                    ->where('semester_id', $sem->id)
                                    ->where('section_id', $schedule->section->id)
                                    ->where('subject_id', $subject->id)
                                    ->whereActive(1)
                                    ->first();

        if(count($check_conflict) > 0) {
            return redirect()->back()->with('error', 'Subject in this Course Year Level and Section has been already Assigned!');
        }

        // add to database 
        $assign = new FacultyLoad();
        $assign->faculty_id = $faculty->id;
        $assign->course_id = $schedule->course->id;
        $assign->curriculum_id = $schedule->curriculum->id;
        $assign->year_level_id = $schedule->year_level->id;
        $assign->academic_year_id = $ay->id;
        $assign->semester_id = $sem->id;
        $assign->section_id = $schedule->section->id;
        $assign->subject_id = $subject->id;
        $assign->save();

        // activity log
        GeneralController::activity_log(Auth::guard('dean')->user()->id, 2, 'Dean Added Faculty Subject Load');

        // return with success message
        return redirect()->back()->with('success', 'Subject Assigned to Faculty');
    }


    // method use to delete faculty load
    public function deleteFacultyLoad($id = null)
    {
        $load = FacultyLoad::findorfail($id);
        $load->delete();

        GeneralController::activity_log(Auth::guard('dean')->user()->id, 2, 'Dean Deleted Faculty Load.');

        return redirect()->route('dean.faculty.load')->with('success', 'Load Deleted!');
    }


}
