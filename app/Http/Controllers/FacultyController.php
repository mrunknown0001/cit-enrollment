<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\GeneralController;
use DB;

use App\Faculty;
use App\FacultyLoad;
use App\Grade;
use App\User;
use App\Subject;
use App\Course;
use App\Curriculum;
use App\YearLevel;
use App\Section;
use App\AcademicYear;
use App\Semester;
use App\Assessment;
use App\EncodedGrade;

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
            'password' => 'required|confirmed|min:6|max:32'
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


    // method use to view faculty load
    public function subjectLoads()
    {
        $faculty = Faculty::find(Auth::guard('faculty')->user()->id);

        $loads = FacultyLoad::where('faculty_id', $faculty->id)
                            ->where('active', 1)
                            ->get();


        return view('faculty.subject-loads', ['loads' => $loads]);
    }


    // method use to view students in the subject
    public function viewStudentSectionSubject($course_id = null, $curriculum_id = null, $yl_id = null, $section_id = null, $subject_id = null)
    {
        $ay = AcademicYear::whereActive(1)->first();
        $sem = Semester::whereActive(1)->first();

        if(count($ay) < 1 || count($sem) < 1) {
            return redirect()->back()->with('error', 'No Active Academic Year or Semester. Please report to the adminsitrator.');
        }

        $course = Course::findorfail($course_id);
        $curriculum = Curriculum::findorfail($curriculum_id);
        $yl = YearLevel::findorfail($yl_id);
        $section = Section::findorfail($section_id);
        $subject = Subject::findorfail($subject_id);

        // get the list of student enrolled in this course year level section
        $student_ids = Assessment::where('course_id', $course->id)
                                ->where('curriculum_id', $curriculum->id)
                                ->where('year_level_id', $yl->id)
                                ->where('section_id', $section->id)
                                ->whereActive(1)
                                ->get(['student_id']);

        $students = User::find($student_ids);

        // check if subject is encoded
        $encoded = EncodedGrade::where('course_id', $course->id)
                        ->where('curriculum_id', $curriculum->id)
                        ->where('year_level_id', $yl->id)
                        ->where('semester_id', $sem->id)
                        ->where('academic_year_id', $ay->id)
                        ->where('section_id', $section->id)
                        ->where('subject_id', $subject->id)
                        ->first();

        // you can filter students if enrolled / paid or not


        return view('faculty.subject-load-students', [
            'course' => $course,
            'curriculum' => $curriculum,
            'yl' => $yl,
            'section' => $section,
            'subject' => $subject,
            'students' => $students,
            'encoded' => $encoded
        ]);
    }


    // method use to show encode of grade
    public function studentSubjectGradeEncode($course_id = null, $curriculum_id = null, $yl_id = null, $section_id = null, $subject_id = null)
    {
        $ay = AcademicYear::whereActive(1)->first();
        $sem = Semester::whereActive(1)->first();

        if(count($ay) < 1 || count($sem) < 1) {
            return redirect()->back()->with('error', 'No Active Academic Year or Semester. Please report to the adminsitrator.');
        }

        $course = Course::findorfail($course_id);
        $curriculum = Curriculum::findorfail($curriculum_id);
        $yl = YearLevel::findorfail($yl_id);
        $section = Section::findorfail($section_id);
        $subject = Subject::findorfail($subject_id);

        // get the list of student enrolled in this course year level section
        $student_ids = Assessment::where('course_id', $course->id)
                                ->where('curriculum_id', $curriculum->id)
                                ->where('year_level_id', $yl->id)
                                ->where('section_id', $section->id)
                                ->whereActive(1)
                                ->get(['student_id']);

        $students = User::find($student_ids);

        // get the view for adding grades
        return view('faculty.subject-load-students-encode-grade', [
            'sem' => $sem,
            'course' => $course,
            'curriculum' => $curriculum,
            'yl' => $yl,
            'section' => $section,
            'subject' => $subject,
            'students' => $students
        ]);
    }


    // method use to save grades of students
    public function postStudentEncodeGrade(Request $request)
    {
        $ay = AcademicYear::whereActive(1)->first();
        $sem = Semester::whereActive(1)->first();

        if(count($ay) < 1 || count($sem) < 1) {
            return redirect()->back()->with('error', 'No Active Academic Year or Semester. Please report to the adminsitrator.');
        }

        // get all hidden important values course, curriculum, year level, section, subject
        $course_id = $request['course_id'];
        $curriculum_id = $request['curriculum_id'];
        $yl_id = $request['yl_id'];
        $section_id = $request['section_id'];
        $subject_id = $request['subject_id'];

        $course = Course::findorfail($course_id);
        $curriculum = Curriculum::findorfail($curriculum_id);
        $yl = YearLevel::findorfail($yl_id);
        $section = Section::findorfail($section_id);
        $subject = Subject::findorfail($subject_id);

        // get all students
        // get the list of student enrolled in this course year level section
        $student_ids = Assessment::where('course_id', $course->id)
                                ->where('curriculum_id', $curriculum->id)
                                ->where('year_level_id', $yl->id)
                                ->where('section_id', $section->id)
                                ->whereActive(1)
                                ->get(['student_id']);

        $students = User::find($student_ids);

        
        // get all grades
        $grades = [];

        foreach($students as $s) {
            $grades[] = [
                'student_id' => $s->id,
                'academic_year_id' => $ay->id,
                'semester_id' => $sem->id,
                'subject_id' => $subject->id,
                'grade' => $request[$s->student_number]
            ];
        }


        // additional validation
        // check if the subject assigns to the teacher/faculty, if not, redirect to home

        // save to grades/insert user DB::seeder
        DB::table('grades')->insert($grades);
        
        // add to record of encoded grades
        $enc = new EncodedGrade();
        $enc->course_id = $course->id;
        $enc->curriculum_id = $curriculum->id;
        $enc->year_level_id = $yl->id;
        $enc->semester_id = $sem->id;
        $enc->academic_year_id = $ay->id;
        $enc->section_id = $section->id;
        $enc->subject_id = $subject->id;
        $enc->save();

        // add to activity log
        GeneralController::activity_log(Auth::guard('faculty')->user()->id, 5, 'Faculty Encoded Grade');

        // return
        return redirect()->route('faculty.student.section.subject', [
                                'course_id' => $course->id,
                                'curriculum_id' => $curriculum->id,
                                'yl_id' => $yl->id,
                                'section_id' => $section->id,
                                'subject_id' => $subject->id 
                            ])->with('success', 'Grades Encoded!');


    }


    // method use to view student grade subject
    public function viewStudentGrade($course_id = null, $curriculum_id = null, $yl_id = null, $section_id = null, $subject_id = null)
    {
        $ay = AcademicYear::whereActive(1)->first();
        $sem = Semester::whereActive(1)->first();

        if(count($ay) < 1 || count($sem) < 1) {
            return redirect()->back()->with('error', 'No Active Academic Year or Semester. Please report to the adminsitrator.');
        }

        $course = Course::findorfail($course_id);
        $curriculum = Curriculum::findorfail($curriculum_id);
        $yl = YearLevel::findorfail($yl_id);
        $section = Section::findorfail($section_id);
        $subject = Subject::findorfail($subject_id);

        // get the list of student enrolled in this course year level section
        $student_ids = Assessment::where('course_id', $course->id)
                                ->where('curriculum_id', $curriculum->id)
                                ->where('year_level_id', $yl->id)
                                ->where('section_id', $section->id)
                                ->whereActive(1)
                                ->get(['student_id']);

        $students = User::find($student_ids);

        // get the student with id number link with grade with current 
        $grades = [];

        foreach($students as $s) {
            // get find students
            $gr = Grade::where('student_id', $s->id)
                    ->where('academic_year_id', $ay->id)
                    ->where('semester_id', $sem->id)
                    ->where('subject_id', $subject->id)
                    ->first();

            $grades[] = [
                'firstname' => $s->firstname,
                'lastname' => $s->lastname,
                'student_number' => $s->student_number,
                'grade' => $gr->grade,
                'grade_id' => $gr->id
                ];
        }

        // return with student grades
        return view('faculty.subject-load-students-view-grade', [
            'sem' => $sem,
            'course' => $course,
            'curriculum' => $curriculum,
            'yl' => $yl,
            'section' => $section,
            'subject' => $subject,
            'grades' => $grades
        ]);

    }


}
