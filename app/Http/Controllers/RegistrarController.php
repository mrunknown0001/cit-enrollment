<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\GeneralController;
use Excel;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\UploadedFile;
use DB;

use App\User;
use App\Registrar;
use App\StudentInfo;
use App\Course;
use App\CourseMajor;
use App\Curriculum;
use App\CourseEnrolled;
use App\YearLevel;
use App\AcademicYear;
use App\Semester;
use App\EnrolledStudent;
use App\Subject;
use App\StudentPreviousSchool;

class RegistrarController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:registrar');
    }


    // method to registrar dashboard
    public function dashboard()
    {
    	return view('registrar.dashboard');
    }


    // method use to view profile of registrar
    public function profile()
    {
        return view('registrar.profile');
    }


    // method use to update profile of registrar
    public function updateProfile()
    {
        return view('registrar.profile-update');
    }


    // method use to save update to profile of registrar
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

        $registrar = Registrar::find(Auth::guard('registrar')->user()->id);

        // check id number existence
        $check_id = Registrar::where('id_number')->first();

        if(!empty($check_id) && $registrar->id_number == $id_number && $id_number != null) {
            return redirect()->back()->with('error', 'ID Number Exists!');
        }

        $registrar->firstname = $firstname;
        $registrar->middle_name = $middlename;
        $registrar->lastname = $lastname;
        $registrar->suffix_name = $suffix;
        $registrar->id_number = $id_number;
        $registrar->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('registrar')->user()->id, 3, 'Registrar Updated Profile');

        return redirect()->route('registrar.profile')->with('success', 'Profile Updated!');
    }


    // method use to change password
    public function changePassword()
    {
        return view('registrar.password-change');
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
        if(!password_verify($old_password, Auth::guard('registrar')->user()->password)) {
            return redirect()->back()->with('error', 'Incorrect Old Password!');
        }

        // check if the new password is same as the old
        if(password_verify($password, Auth::guard('registrar')->user()->password)) {
            return redirect()->back()->with('error', 'New Password Entered is Same as Old Password!');
        }

        // change password
        $registrar = Registrar::find(Auth::guard('registrar')->user()->id);
        $registrar->password = bcrypt($password);
        $registrar->save();

        // add activty log
        GeneralController::activity_log(Auth::guard('registrar')->user()->id, 3, 'Registrar Change Password');

        // return to deans and add admin with message
        return redirect()->route('registrar.dashboard')->with('success', 'Password Changed!');
    }


    // method use on student operations
    public function students()
    {
    	$students = User::orderBy('lastname', 'asc')
    				->paginate(15);

    	return view('registrar.students', ['students' => $students]);
    }


    // method use to search students
    public function searchStudent(Request $request)
    {
        $key = $request['q'];

        $students = GeneralController::students_search($key);

        return view('registrar.students-search-result', ['students' => $students, 'key' => $key]);
    }


    // method use to add student
    public function addStudent(Request $request)
    {
        $request->validate([
            'sn' => 'nullable|numeric|unique:users,student_number',
            'firstname' => 'nullable|regex:/^[\pL\s\-]+$/u',
            'lastname' => 'nullable|regex:/^[\pL\s\-]+$/u',
            'middlename' => 'nullable|regex:/^[\pL\s\-]+$/u',
            'student_number' => 'nullable|numeric'
        ]);

        // $courses = Course::where('active', 1)->orderBy('title', 'asc')->get();
        $strands = \App\Strand::where('active', 1)->orderBy('code', 'asc')->get();
        $yl = YearLevel::get();

        $sn = $request['sn'];
        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $middlename = $request['middlename'];
        $suffix = $request['suffix_name'];
        $course_id = $request['course_id'];
        $major_id = $request['major'];
        $curriculum_id = $request['curriculum'];
        $yl_id = $request['yl_id'];

    	return view('registrar.student-add', [
            // 'courses' => $courses,
            'strands' => $strands,
            'yl' => $yl,
            'sn' => $sn, // student number
            'firstname' => $firstname,
            'lastname' => $lastname,
            'middlename' => $middlename,
            'suffix' => $suffix,
            // 'course_id' => $course_id,
            // 'major_id' => $major_id,
            'curriculum_id' => $curriculum_id,
            // 'yl_id' => $yl_id
        ]);
    }


    // method use to add personal info of the student
    public function addStudentPersonalInfo(Request $request)
    {
        $request->validate([
            'student_number' => 'required|unique:users',
            'firstname' => 'nullable|regex:/^[\pL\s\-]+$/u',
            'lastname' => 'nullable|regex:/^[\pL\s\-]+$/u',
            'middlename' => 'nullable|regex:/^[\pL\s\-]+$/u',
            // 'course' => 'required',
            'curriculum' => 'required',
            // 'year_level' => 'required',
            'student_number' => 'nullable|numeric'
        ]);


        $sn = $request['student_number'];
        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $middlename = $request['middlename'];
        $suffix = $request['suffix_name'];
        // $course_id = $request['course'];
        // $major_id = $request['major'];
        $curriculum_id = $request['curriculum'];
        // $yl_id = $request['year_level'];

        $sex = $request['sex'];
        $civil_status = $request['civil_status'];
        $mobile_number = $request['mobile_number'];
        $email = $request['email'];
        $address = $request['address'];
        $nationality = $request['nationality'];
        $pob = $request['pob'];
        $dob = $request['dob'];
        $religion = $request['religion'];
        $father = $request['father'];
        $mother = $request['mother'];
        $guardian = $request['guardian'];
        $guardians_address = $request['guardians_address'];

        return view('registrar.student-add-personal-info', [
            'sn' => $sn, // student number
            'firstname' => $firstname,
            'lastname' => $lastname,
            'middlename' => $middlename,
            'suffix' => $suffix,
            // 'course_id' => $course_id,
            // 'major_id' => $major_id,
            'curriculum_id' => $curriculum_id,
            // 'yl_id' => $yl_id,

            'sex' => $sex,
            'civil_status' => $civil_status,
            'mobile_number' => $mobile_number,
            'email' => $email,
            'address' => $address,
            'nationality' => $nationality,
            'pob' => $pob,
            'dob' => $dob,
            'religion' => $religion,
            'father' => $father,
            'mother' => $mother,
            'guardian' => $guardian,
            'guardians_address' => $guardians_address
        ]);
    }


    // method to add educational info of the student
    public function addStudentEducationInfo(Request $request)
    {
        $request->validate([
            'sn' => 'unique:users,student_number',
            'mobile_number' => 'nullable|digits:11'
        ]);

        $sn = $request['sn'];
        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $middlename = $request['middlename'];
        $suffix = $request['suffix'];
        // $course_id = $request['course_id'];
        // $major_id = $request['major_id'];
        $curriculum_id = $request['curriculum_id'];
        // $yl_id = $request['yl_id'];

        $sex = $request['sex'];
        $civil_status = $request['civil_status'];
        $mobile_number = $request['mobile_number'];
        $email = $request['email'];
        $address = $request['address'];
        $nationality = $request['nationality'];
        $pob = $request['place_of_birth'];
        $dob = $request['date_of_birth'];
        $religion = $request['religion'];
        $father = $request['fathers_name'];
        $mother = $request['mothers_name'];
        $guardian = $request['guardians_name'];
        $guardians_address = $request['guardians_address'];

        return view('registrar.student-add-educational-info', [ 
            'sn' => $sn, // student number
            'firstname' => $firstname,
            'lastname' => $lastname,
            'middlename' => $middlename,
            'suffix' => $suffix,
            // 'course_id' => $course_id,
            // 'major_id' => $major_id,
            'curriculum_id' => $curriculum_id,
            // 'yl_id' => $yl_id,

            'sex' => $sex,
            'civil_status' => $civil_status,
            'mobile_number' => $mobile_number,
            'email' => $email,
            'address' => $address,
            'nationality' => $nationality,
            'pob' => $pob,
            'dob' => $dob,
            'religion' => $religion,
            'father' => $father,
            'mother' => $mother,
            'guardian' => $guardian,
            'guardians_address' => $guardians_address
        ]);
    }


    // method use to save new student
    public function postAddStudent(Request $request)
    {
        $request->validate([
            'sn' => 'unique:users,student_number'
        ]);
        
        $sn = $request['sn'];
        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $middlename = $request['middlename'];
        $suffix = $request['suffix'];

        // $course_id = $request['course_id'];
        // $major_id = $request['major_id'];
        $curriculum_id = $request['curriculum_id'];
        // $yl_id = $request['yl_id'];

        $sex = $request['sex'];
        $civil_status = $request['civil_status'];
        $mobile_number = $request['mobile_number'];
        $email = $request['email'];
        $address = $request['address'];
        $nationality = $request['nationality'];
        $pob = $request['pob'];
        $dob = $request['dob'];
        $religion = $request['religion'];
        $father = $request['father'];
        $mother = $request['mother'];
        $guardian = $request['guardian'];
        $guardians_address = $request['guardians_address'];

        $elem = $request['elementary_school'];
        $elem_year_graduated = $request['elementary_year_graduated'];
        $hs = $request['high_school'];
        $hs_year_graduated = $request['high_school_year_graduated'];
        // $college = $request['college'];
        // $college_year_graduated = $request['college_year_graduated'];
        // $school_last_attended = $request['school_last_attended'];
        // $school_address = $request['school_address'];
        // $year_graduated = $request['year_graduated'];

        // $year_level = YearLevel::find($yl_id);
        // $course = Course::find($course_id);
        // $curriculum = Curriculum::find($curriculum_id);

        // add to user as students
    	$student = new User();
    	$student->student_number = $sn;
    	$student->firstname = $firstname;
    	$student->lastname = $lastname;
    	$student->middle_name = $middlename;
    	$student->suffix_name = $suffix;
    	$student->save();

        // add course enrolled
        // $ce = new CourseEnrolled();
        // $ce->student_id = $student->id;
        // $ce->course_id = $course->id;
        // $ce->major_id = $major_id;
        // $ce->curriculum_id = $curriculum->id;
        // $ce->save();

        // add student info record
        $info = new StudentInfo();
        $info->student_id = $student->id;
        // $info->year_level_id = $year_level->id;
        $info->curriculum_id = $curriculum_id;
        $info->sex = $sex;
        $info->mobile_number = $mobile_number;
        $info->email = $email;
        $info->home_address = $address;
        $info->nationality = $nationality;
        $info->civil_status = $civil_status;
        $info->date_of_birth = date('Y-m-d', strtotime($dob));
        $info->place_of_birth = $pob;
        $info->religion = $religion;
        $info->fathers_name = $father;
        $info->mothers_name = $mother;
        $info->guardians_name = $guardian;
        $info->guardians_address = $guardians_address;
        $info->save();

        // add new previous school of student
        $prev = new StudentPreviousSchool();
        $prev->student_id = $student->id;
        $prev->elementary_school = $elem;
        $prev->elementary_year_graduated = $elem_year_graduated;
        $prev->high_school = $hs;
        $prev->high_school_year_graduated = $hs_year_graduated;
        // $prev->college_school = $college;
        // $prev->college_year_graduated = $college_year_graduated;
        // $prev->school_last_attended = $school_last_attended;
        // $prev->school_address = $school_address;
        // $prev->year_graduated = $year_graduated;
        $prev->save();

    	// add activitly log
        GeneralController::activity_log(Auth::guard('registrar')->user()->id, 3, 'Registrar Added Student');

    	// redirect back with success message
    	return redirect()->route('registrar.add.student')->with('success', 'Student Added!');
    }


    // method use to update students basic info
    public function updateStudent($id = null)
    {
        $student = User::findorfail($id);
        $courses = Course::where('active', 1)->orderBy('title', 'asc')->get();
        $strands = \App\Strand::where('active', 1)->orderBy('strand', 1)->get();
        $yl = YearLevel::get();

        return view('registrar.student-update', ['student' => $student, 'strands' => $strands,'courses' => $courses, 'yl' => $yl]);
    }


    // method use to get major oncourses
    public function getCourseMajor($id = null)
    {
        $majors = CourseMajor::where('course_id', $id)
                            ->where('active', 1)
                            ->get();

        return $majors;

    }


    // method use to continue update: personal info
    public function updateStudentPersonalInfo(Request $request)
    {
        $request->validate([
            'student_number' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            // 'course' => 'required',
            'curriculum' => 'required',
            // 'year_level' => 'required'
        ]);

        $student_id = $request['student_id'];
        $sn = $request['student_number'];
        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $middlename = $request['middlename'];
        $suffix = $request['suffix_name'];
        // $course_id = $request['course'];
        // $major_id = $request['major'];
        $curriculum_id = $request['curriculum'];
        // $yl_id = $request['year_level'];

        $student = User::findorfail($student_id);

        return view('registrar.student-update-personal-info', [
            'student' => $student,
            'student_id' => $student->id,
            'sn' => $sn, // student number
            'firstname' => $firstname,
            'lastname' => $lastname,
            'middlename' => $middlename,
            'suffix' => $suffix,
            // 'course_id' => $course_id,
            // 'major_id' => $major_id,
            'curriculum_id' => $curriculum_id,
            // 'yl_id' => $yl_id
        ]);
    }


    // method use to update student education information
    public function updateStudentEducationalInfo(Request $request)
    {

        $student_id = $request['student_id'];
        $sn = $request['sn'];
        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $middlename = $request['middlename'];
        $suffix = $request['suffix'];
        // $course_id = $request['course_id'];
        // $major_id = $request['major_id'];
        $curriculum_id = $request['curriculum_id'];
        // $yl_id = $request['yl_id'];

        $student = User::findorfail($student_id);

        $sex = $request['sex'];
        $civil_status = $request['civil_status'];
        $mobile_number = $request['mobile_number'];
        $email = $request['email'];
        $address = $request['address'];
        $nationality = $request['nationality'];
        $pob = $request['place_of_birth'];
        $dob = $request['date_of_birth'];
        $religion = $request['religion'];
        $father = $request['fathers_name'];
        $mother = $request['mothers_name'];
        $guardian = $request['guardians_name'];
        $guardians_address = $request['guardians_address'];

        return view('registrar.student-update-educational-info', [ 
            'student' => $student,
            'student_id' => $student->id,
            'sn' => $sn, // student number
            'firstname' => $firstname,
            'lastname' => $lastname,
            'middlename' => $middlename,
            'suffix' => $suffix,
            // 'course_id' => $course_id,
            // 'major_id' => $major_id,
            'curriculum_id' => $curriculum_id,
            // 'yl_id' => $yl_id,

            'sex' => $sex,
            'civil_status' => $civil_status,
            'mobile_number' => $mobile_number,
            'email' => $email,
            'address' => $address,
            'nationality' => $nationality,
            'pob' => $pob,
            'dob' => $dob,
            'religion' => $religion,
            'father' => $father,
            'mother' => $mother,
            'guardian' => $guardian,
            'guardians_address' => $guardians_address
        ]);
    }


    // method use to save student update
    public function postUpdateStudent(Request $request)
    {
        $student_id = $request['student_id'];
        $sn = $request['sn'];
        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $middlename = $request['middlename'];
        $suffix = $request['suffix'];

        // $course_id = $request['course_id'];
        // $major_id = $request['major_id'];
        $curriculum_id = $request['curriculum_id'];
        // $yl_id = $request['yl_id'];

        $sex = $request['sex'];
        $civil_status = $request['civil_status'];
        $mobile_number = $request['mobile_number'];
        $email = $request['email'];
        $address = $request['address'];
        $nationality = $request['nationality'];
        $pob = $request['pob'];
        $dob = $request['dob'];
        $religion = $request['religion'];
        $father = $request['father'];
        $mother = $request['mother'];
        $guardian = $request['guardian'];
        $guardians_address = $request['guardians_address'];

        $elem = $request['elementary_school'];
        $elem_year_graduated = $request['elementary_year_graduated'];
        $hs = $request['high_school'];
        $hs_year_graduated = $request['high_school_year_graduated'];
        $college = $request['college'];
        $college_year_graduated = $request['college_year_graduated'];
        $school_last_attended = $request['school_last_attended'];
        $school_address = $request['school_address'];
        $year_graduated = $request['year_graduated'];

        $student = User::findorfail($student_id);

        // student number existence
        $check_sn = User::where('student_number', $sn)->first();

        if(!empty($check_sn) && $student->student_number != $sn) {
            return redirect()->back()->with('error', 'LRN Already Exist!');
        }

        // $year_level = YearLevel::findorfail($yl_id);
        // $course = Course::findorfail($course_id);
        // $curriculum = Curriculum::findorfail($curriculum_id);

        // save to user as students
        $student->student_number = $sn;
        $student->firstname = $firstname;
        $student->lastname = $lastname;
        $student->middle_name = $middlename;
        $student->suffix_name = $suffix;
        $student->save();

        // save to course enrolled
        // $ce = CourseEnrolled::whereStudentId($student->id)->first();
        // $ce->course_id = $course->id;
        // $ce->major_id = $major_id;
        // $ce->curriculum_id = $curriculum->id;
        // $ce->save();

        // save to student info record
        $info = StudentInfo::whereStudentId($student->id)->first();
        // $info->year_level_id = $year_level->id;
        $info->curriculum_id = $curriculum_id;
        $info->sex = $sex;
        $info->mobile_number = $mobile_number;
        $info->email = $email;
        $info->home_address = $address;
        $info->nationality = $nationality;
        $info->civil_status = $civil_status;
        $info->date_of_birth = date('Y-m-d', strtotime($dob));
        $info->place_of_birth = $pob;
        $info->religion = $religion;
        $info->fathers_name = $father;
        $info->mothers_name = $mother;
        $info->guardians_name = $guardian;
        $info->guardians_address = $guardians_address;
        $info->save();

        $prev = StudentPreviousSchool::whereStudentId($student->id)->first();
        $prev->elementary_school = $elem;
        $prev->elementary_year_graduated = $elem_year_graduated;
        $prev->high_school = $hs;
        $prev->high_school_year_graduated = $hs_year_graduated;
        // $prev->college_school = $college;
        // $prev->college_year_graduated = $college_year_graduated;
        // $prev->school_last_attended = $school_last_attended;
        // $prev->school_address = $school_address;
        // $prev->year_graduated = $year_graduated;
        $prev->save();

        // add activitly log
        GeneralController::activity_log(Auth::guard('registrar')->user()->id, 3, 'Registrar Updated Student');

        // redirect back with success message
        return redirect()->route('registrar.students')->with('success', 'Student Info Updated!');
    }


    // method use to import students
    public function importStudents()
    {
        $courses = Course::where('active', 1)->orderBy('title', 'asc')->get();
        $yl = YearLevel::get();
        $strands = \App\Strand::where('active', 1)->orderBy('strand', 'asc')->get();

        return view('registrar.students-import', ['courses' => $courses, 'yl' => $yl, 'strands' => $strands]);
    }


    // method use to save import students
    public function postImportStudents(Request $request)
    {
        $request->validate([
            'students' => 'required',
            // 'course' => 'required',
            'curriculum' => 'required',
            // 'year_level' => 'required'
        ]);

        // $course_id = $request['course'];
        $curriculum_id = $request['curriculum'];
        // $year_level_id = $request['year_level'];
        // $major_id = $request['major'];

        // $year_level = YearLevel::findorfail($year_level_id);
        // $course = Course::findorfail($course_id);
        // $curriculum = Curriculum::findorfail($curriculum_id);

        if(Input::hasFile('students')){
            $path = Input::file('students')->getRealPath();
            $data[] = Excel::selectSheetsByIndex(0)->load($path, function($reader) {
                    // $reader->get();
                    $reader->skipColumns(1);
                })->get();
        }
        else {
            return redirect()->back()->with('error', 'Error! Please Try Again!');
        }

        $insert = [];
        $info = [];
        $enrolled = [];
        $last_school = [];

        // get last student id of student in the student_infos table
        $last_student = StudentInfo::orderBy('id', 'desc')->first(['id']);
        if(!empty($last_student)) {
            $ref_id = $last_student->id + 1;
        }
        else {
            $ref_id = 1;
        }

        foreach ($data as $value) {
            
            foreach ($value as $row) {
                if($row->student_number != null) {

                    // add validation on Stuent number LRN

                    // check each student number if it is already in database
                    $check_student_number = User::where('student_number', $row->lrn)->first();


                    if(!empty($check_student_number)) {
                        return redirect()->back()->with('error', 'Student Exist! Please Remove Student with LRN: ' . $row->lrn . ' - ' . ucwords($row->firstname . ' ' . $row->lastname));
                    }

                    else {

                        // for users table
                        $insert[] = [
                                'lrn' => $row->lrn,
                                'lastname' => $row->lastname,
                                'firstname' => $row->firstname
                            ];


                        // $enrolled[] = [
                        //         'student_id' => $ref_id,
                        //         'course_id' => $course->id,
                        //         'curriculum_id' => $curriculum->id,
                        //         'major_id' => $major_id
                        //     ];

                        // change to strand

                        // for student info table
                        $info[] = [
                                'student_id' => $ref_id,
                                'esc_scholar' => $row->esc_scholar,
                                // 'year_level_id' => $year_level->id,
                                'curriculum_id' => $curriculum_id,
                                'sex' => $row->sex,
                                'date_of_birth' => date('Y-m-d', strtotime($row->birthday)),
                                'home_address' => $row->address,
                                'email' => $row->email,
                                'mobile_number' => $row->number,
                                'nationality' => $row->nationality,
                                'civil_status' => $row->civil_status,
                                'place_of_birth' => $row->place_of_birth,
                                'religion' => $row->religion,
                                'fathers_name' => $row->father,
                                'mothers_name' => $row->mother
                            ];

                        // for previous schools record
                        $last_school[] = [
                                'student_id' => $ref_id,
                                'elementary_school' => $row->elementary_school,
                                'elementary_year_graduated' => $row->elem_year_graduated,
                                // 'high_school' => $row->high_school,
                                // 'high_school_year_graduated' => $row->hs_year_graduated,
                                // 'college_school' => $row->college_degree,
                                // 'college_year_graduated' => $row->college_year_graduated,
                                // 'school_last_attended' => $row->school_last_attended,
                                // 'school_address' => $row->school_address,
                                // 'year_graduated' => $row->year_graduated
                            ];

                    }

                    $ref_id += 1;
                }

            }
            
        }

        // insert in users and student_infos tables
        if(!empty($insert)) {
            // insert data to users
            DB::table('users')->insert($insert);

            // insert import data to studentimport
            DB::table('student_infos')->insert($info);

            // insert to course_enrolled
            // DB::table('course_enrolleds')->insert($enrolled);

            // strand enrolled

            // insert to student_previous_schools
            DB::table('student_previous_schools')->insert($last_school);

            // add activtiy log
            GeneralController::activity_log(Auth::guard('registrar')->user()->id, 3, 'Registrar Import Students');


            // return with success message
            return redirect()->route('registrar.students')->with('success', 'Students Import Successful!');

        }

        return redirect()->route('registrar.students')->with('error', 'Students Import Error!');
        
    }


    // method use to get all enrooled students in the current semester
    public function getCurrentEnrolledStudents()
    {
        $ay = AcademicYear::whereActive(1)->first();
        // $sem = Semester::whereActive(1)->first();

        if(empty($ay)) {
            return redirect()->back()->with('info', 'Please Check AcademicYear and Semester in Admin!');
        }


        $stds = EnrolledStudent::whereAcademicYearId($ay->id)
                                // ->whereSemesterId($sem->id)
                                ->whereStatus(1)
                                ->distinct('student_id')
                                ->get();


        if(count($stds) < 1) {
            return redirect()->back()->with('info', 'No Enrolled Students!');
        }

        $students = array();

        foreach($stds as $s) {
            array_push($students, [
                'Student' => ucwords($s->student->firstname . ' ' . $s->student->lastname),
                'LRN' => $s->student->student_number,
                'Curriculum' => $s->student->info->year_level->name,
                // 'Course' => $s->student->enrolled->course->title
            ]);
        }

        // download in excel format
        $filename = 'Students Enrolled in ' . $ay->from . '-' . $ay->to;

        Excel::create($filename, function($excel) use ($students) {
            $excel->sheet('Enrolled Students', function($sheet) use ($students)
            {
                $sheet->fromArray($students);
            });
       })->export('xls');

    }


    // method use to view personal info of students
    public function studentPersonalInfo($id = null)
    {
        $student = User::findorfail($id);

        return view('registrar.student-personal-info', ['student' => $student]);
    }


    // method use to view education info of students
    public function studentEducationalInfo($id = null)
    {
        $student = User::findorfail($id);

        return view('registrar.student-education-info', ['student' => $student]);
    }


    // method use to view current subjects that a student can take
    public function studentCurrentSubjects($id = null)
    {
        $student = User::findorfail($id);

        $ay = AcademicYear::whereActive(1)->first();
        // $sem = Semester::whereActive(1)->first();

        if(empty($ay)) {
            return redirect()->back()->with('error', 'No Active AcademicYear or Semester. Contact Admin!');
        }

        // $curriculum_id = $student->enrolled->curriculum_id;
        $yl_id = $student->info->curriculum_id;

        $subjects = Subject::
                        // whereCurriculumId($curriculum_id)
                        whereYearLevelId($yl_id)
                        // ->whereSemesterId($sem->id)
                        ->get();

        return view('registrar.student-subjects', ['subjects' => $subjects, 'student' => $student]);
    }


    // method use to view/print student data
    public function studentViewDataPrint($id = null)
    {
        $student = User::findorfail($id);

        // view print
        return view('registrar.student-print-data', ['student' => $student]);
    }



    // method use to view subjects
    public function subjects()
    {
        $subjects = Subject::where('active', 1)
                        ->orderBy('code', 'asc')
                        ->paginate(15);

        return view('registrar.subjects', ['subjects' => $subjects]);
    }


    // method use to add subject
    public function addSubject()
    {
        // $courses = Course::where('active', 1)->get();
        $strands = \App\Strand::where('active', 1)->get();
        $subjects = Subject::where('active', 1)->get(['id', 'code']);
        $yl = YearLevel::get();
        $sem = Semester::get();

        return view('registrar.subject-add', ['strands' => $strands, 'subjects' => $subjects, 'yl' => $yl, 'sem' => $sem]);
    }


    // method use to save new subject
    public function postAddSubject(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:subjects',

            // 'code' => 'required|unique:subjects,code,NULL,NULL,strand, ' . $request['course'],
            // 'course' => 'required|unique:subjects,course_id,NULL,NULL,code, ' . $request['code'],

            'description' => 'required',
            // 'units' => 'required|numeric',
            // 'course' => 'required',
            'year_level' => 'required',
            // 'semester' => 'required',
            // 'curriculum' => 'required',
            'strand' => 'nullable'
        ]);

        $code = $request['code'];
        $description = $request['description'];
        // $units = $request['units'];
        // $lab_units = $request['lab_units'];
        // $course_id = $request['course'];
        // $major_id = $request['major'];
        $year_level_id = $request['year_level']; // curriculu
        $semester_id = $request['semester'];
        // $curriculum_id = $request['curriculum'];
        // $prerequisite = $request['prerequisite'];
        $strand = $request['strand'];

        // $course = Course::findorfail($course_id);
        // $major = CourseMajor::find($major_id);
        // 
        // 
        /*
         * Add condition if grade 11 and 12 as strand
         */
        if($year_level_id > 3) {
            if($strand == NULL) {
                return redirect()->back()->with('error', 'Strand is Required!');
            }
        }


        /*
         * No strand if grade 10 and below
         */
        if($year_level_id < 4) {
            if($strand != NULL) {
                return redirect()->back()->with('error', 'Strand Must be Null!');
            }
        }

        // save new subject
        $sub = new Subject();
        $sub->code = $code;
        $sub->description = $description;
        // $sub->units = $units;
        // $sub->lab_units = $lab_units;
        // $sub->course_id = $course->id;
        // if(!empty($major)) {
        //     $sub->major_id = $major->id;
        // }
        // else {
        //     $sub->major_id = null;
        // }
        // $sub->prerequisite = $prerequisite;
        // $sub->curriculum_id = $curriculum_id;
        $sub->strand_id = $strand;
        $sub->year_level_id = $year_level_id; // curriculum
        // $sub->semester_id = $semester_id;
        $sub->save();

        GeneralController::activity_log(Auth::guard('registrar')->user()->id, 3, 'Registrar Added New Subject');

        return redirect()->back()->with('success', 'Subject Added!');

    }


    // method use to update subject
    public function updateSubject($id = null)
    {
        $subject = Subject::findorfail($id);
        $subjects = Subject::where('active', 1)->get(['id', 'code']);
        // $courses = Course::orderBy('title', 'asc')->get();
        $strands = \App\Strand::where('active', 1)->get();
        $yl = YearLevel::get();
        $sem = Semester::get();

        return view('registrar.subject-update', ['subject' => $subject, 'subjects' => $subjects, 'strands' => $strands, 'yl' => $yl, 'sem' => $sem]);
    }


    // method use to save update on subject
    public function postUpdateSubject(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'description' => 'required',
            // 'units' => 'required|numeric',
            // 'course' => 'required',
            'year_level' => 'required',
            // 'semester' => 'required',
            // 'curriculum' => 'required',
            'strand' => 'nullable',
        ]);

        $subject_id = $request['subject_id'];
        $code = $request['code'];
        $description = $request['description'];
        // $units = $request['units'];
        // $lab_units = $request['lab_units'];
        // $course_id = $request['course'];
        // $major_id = $request['major'];
        $year_level_id = $request['year_level'];
        // $semester_id = $request['semester'];
        // $curriculum_id = $request['curriculum'];
        // $prerequisite = $request['prerequisite'];
        $strand = $request['strand'];

        /*
         * Add condition if grade 11 and 12 as strand
         */
        if($year_level_id > 3) {
            if($strand == NULL) {
                return redirect()->back()->with('error', 'Strand is Required!');
            }
        }


        /*
         * No strand if grade 10 and below
         */
        if($year_level_id < 4) {
            if($strand != NULL) {
                return redirect()->back()->with('error', 'Strand Must be Null!');
            }
        }

        // $course = Course::findorfail($course_id);
        // $major = CourseMajor::find($major_id);

        $sub = Subject::findorfail($subject_id);

        // removed pre requisite
        // if($sub->id == $prerequisite) {
        //     return redirect()->back()->with('error', 'Error in Prerequisite!');
        // }

        // check if code exists
        $check_code = Subject::where('code', $code)->first();

        if(!empty($check_code) && $sub->code != $code) {
            return redirect()->back()->with('error', 'Subject Code Exists. Please Check your input');
        }

        $sub->code = $code;
        $sub->description = $description;
        // $sub->units = $units;
        // $sub->lab_units = $lab_units;
        // $sub->course_id = $course->id;
        // if(!empty($major)) {
        //     $sub->major_id = $major->id;
        // }
        // else {
        //     $sub->major_id = null;
        // }
        // $sub->prerequisite = $prerequisite;
        // $sub->curriculum_id = $curriculum_id;
        $sub->strand_id = $strand;
        $sub->year_level_id = $year_level_id;
        // $sub->semester_id = $semester_id;
        $sub->save();

        GeneralController::activity_log(Auth::guard('registrar')->user()->id, 3, 'Admin Updated Subject');

        return redirect()->route('registrar.subjects')->with('success', 'Subject Updated!');
    }



    // remove subject
    public function removeSubject($id)
    {
        $subject = \App\Subject::findorfail($id);
        if($subject->delete()) {
            return redirect()->back()->with('success', 'Subject Removed!');
        }
        else {
            return redirect()->back()->with('error', 'Error on Subject Removal!');
        }
    }


    // method use to show subjects in a course
    public function courseSubjects($id = null)
    {
        $subjects = Subject::where('course_id', $id)
                        ->orderBy('code', 'asc')
                        ->get();

        return $subjects;
    }


    // method use to get course major to use in form add/update subject
    public function getCourseMajors($id = null)
    {
        $majors = CourseMajor::where('course_id', $id)->where('active', 1)->get();

        $course_majors = null;

        if(count($majors) < 1) {
            return null;
        }

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


    // method use to get major per curriculum in form add/update
    public function getMajorCurriculum($id = null)
    {
        $curriculum = Curriculum::where('major_id', $id)->where('active', 1)->get();

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


}
