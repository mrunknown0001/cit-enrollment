<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\EnrollmentController;
use DB;
use App\Http\Controllers\PaymayaController;

use App\User;
use App\StudentInfo;
use App\Avatar;
use App\EnrollmentSetting;
use App\RegistrationPayment;
use App\AcademicYear;
use App\Semester;
use App\Payment;
use App\Balance;
use App\Curriculum;
use App\Course;
use App\CourseMajor;
use App\CourseEnrolled;
use App\Subject;
use App\UnitPrice;
use App\Miscellaneous;
use App\EnrolledStudent;
use App\Section;
use App\Schedule;
use App\YearLevel;
use App\Assessment;
use App\StudentLimit;
use App\AssessmentCounter;
use App\Grade;


class StudentController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }


    // method to show student dashboard
    public function dashboard()
    {

        // check status if regular or irregular
        
        $es = EnrollmentSetting::find(1);
        $rp = RegistrationPayment::where('student_id', Auth::user()->id)->where('active', 1)->first();

    	return view('student.dashboard', ['es' => $es, 'rp' => $rp]);
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
            'password' => 'required|confirmed|min:6|max:32'
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
        if(empty($avatar)) {
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


    // method use to assessment
    public function assessment()
    {
        $es = EnrollmentSetting::find(1);

        if($es->active == 0) {
            return redirect()->route('student.dashboard')->with('error', 'Enrollment is Inactive!');
        }

        $ay = AcademicYear::whereActive(1)->first();
        // $sem = Semester::whereActive(1)->first();

        if(empty($ay)) {
            return redirect()->route('student.dashboard')->with('error', 'Academic Year or Semester Not Set!');
        }




        $assessment = Assessment::where('student_id', Auth::user()->id)
                                ->whereActive(1)
                                ->first();

        if(!empty($assessment)) {
            return redirect()->route('student.enrollment')->with('info', 'Assessment Already Taken!');
        }

        // add conditions

        // get information of students that matched the 
        // course, curriculum, yearl level and what sem is active
        // to determine the subjects
        $student = User::find(Auth::user()->id);

        if(!empty($student->status)) {
            return redirect()->back()->with('error', 'Sorry You Cant Enroll!');
        }

        // check student if first year and if the semester is first they can't take assessment
        if($student->info->curriculum_id == 1 && $sem->id == 1) {
            return redirect()->route('student.dashboard')->with('info', 'Unable to take assessment. You can take next Semester! Study harder! God Bless!');
        }

        // $course_id = $student->enrolled->course_id;
        // $curriculum_id = $student->enrolled->curriculum_id;
        // $major_id = $student->enrolled->major_id;
        $yl_id = $student->info->curriculum_id;


        $section_ids = DB::table('schedules')
                    ->where('active', 1)
                    // ->where('course_id', $course_id)
                    ->where('curriculum_id', $yl_id)
                    // ->where('year_level_id', $yl_id)
                    ->distinct('section_id')
                    ->get(['section_id']);

        $sec_ids = array();

        foreach($section_ids as $s) {
            array_push($sec_ids, $s->section_id);
        }

        $sections = Section::find($sec_ids);

        // get course, curriculum, section, year level >>>> subjects schedules

        // get section subjects

        return view('student.assessment', ['sections' => $sections]);
    }


    // method use to show schedules of the section
    public function sectionSchedules($id = null)
    {

        $section = Section::findorfail($id);

        $student = User::find(Auth::user()->id);


        if(!empty($student->status)) {
            return redirect()->back()->with('error', 'Sorry You Cant Enroll!');
        }

        $course_id = $student->enrolled->course_id;
        $curriculum_id = $student->enrolled->curriculum_id;
        $major_id = $student->enrolled->major_id;
        $yl_id = $student->info->year_level_id;

        $course = Course::find($course_id);
        $curriculum = Curriculum::find($curriculum_id);
        $major = CourseMajor::find($major_id);
        $yl = YearLevel::find($yl_id);

        $ay = AcademicYear::whereActive(1)->first();
        $sem = Semester::whereActive(1)->first();

        // get scheudles
        $schedules = Schedule::where('course_id', $course_id)
                        ->where('curriculum_id', $curriculum_id)
                        ->where('year_level_id', $yl_id)
                        ->where('section_id', $section->id)
                        ->orderBy('day', 'asc')
                        ->orderBy('start_time', 'asc')
                        ->get();

        $subjects = Subject::where('course_id', $course_id)
                        ->where('curriculum_id', $curriculum_id)
                        ->where('year_level_id', $yl_id)
                        ->where('semester_id', $sem->id)
                        ->orderBy('code', 'asc')
                        ->get();

        // show the scheudle of the subjects in students
        return view('student.assessment-schedule-show', ['schedules' => $schedules, 'subjects' => $subjects, 'section' => $section, 'course' => $course, 'curriculum' => $curriculum, 'yl' => $yl, 'major' => $major, 'sem' => $sem]);
    }


    // method use to save assessment of the student
    public function postSaveAssessment(Request $request)
    {

        $section_id = $request['section_id'];

        $section = Section::findorfail($section_id);

        $student = User::find(Auth::user()->id);

        $course_id = $student->enrolled->course_id;
        $curriculum_id = $student->enrolled->curriculum_id;
        $major_id = $student->enrolled->major_id;
        $yl_id = $student->info->year_level_id;

        $course = Course::find($course_id);
        $curriculum = Curriculum::find($curriculum_id);
        $major = CourseMajor::find($major_id);
        $yl = YearLevel::find($yl_id);

        $ay = AcademicYear::whereActive(1)->first();
        $sem = Semester::whereActive(1)->first();


        // get the subject
        // count the number of lecture units multiplied by the unit price
        // add the miscellaneous and add 1k if there is lab units to get the total amount of tuition fee
        $subjects = Subject::where('course_id', $course_id)
                        ->where('curriculum_id', $curriculum_id)
                        ->where('year_level_id', $yl_id)
                        ->where('semester_id', $sem->id)
                        ->orderBy('code', 'asc')
                        ->get();


        // get the subject ids
        $subject_ids = Subject::where('course_id', $course_id)
                        ->where('curriculum_id', $curriculum_id)
                        ->where('year_level_id', $yl_id)
                        ->where('semester_id', $sem->id)
                        ->orderBy('code', 'asc')
                        ->get(['id']);



        // determine if the student has prerequisite subject that has failed




        // get the number of the limit
        $limit = StudentLimit::find(1);


        // check if the there is existing assessment counter for the section
        $check_counter = AssessmentCounter::where('course_id', $course->id)
                                    ->where('curriculum_id', $curriculum->id)
                                    ->where('year_level_id', $yl->id)
                                    ->where('semester_id', $sem->id)
                                    ->where('academic_year_id', $ay->id)
                                    ->where('section_id', $section->id)
                                    ->first();
        

        // if not exist, create a new counter
        // if exists increment by 1
        if(!empty($check_counter)) {
            // check if the number of students assess is less than the limi
            if($check_counter->student_count < $limit->limit) {
                // increment counter by 1
                $check_counter->student_count += 1; 
                $check_counter->save();

            }
            else {
                return redirect()->back()->with('error', 'The Section is Full! Take another section instead!');
            }
        }
        else {
            // create counter and the student count of 1
            $counter = new AssessmentCounter();
            $counter->course_id = $course->id;
            $counter->curriculum_id = $curriculum->id;
            $counter->year_level_id = $yl->id;
            $counter->semester_id = $sem->id;
            $counter->academic_year_id = $ay->id;
            $counter->section_id = $section->id;
            $counter->student_count = 1;
            $counter->save();
        }






        $total_units = $subjects->sum('units');
        $lab_units = $subjects->sum('lab_units');

        // get the price and misc
        $unit_price = UnitPrice::find(1);
        $misc = Miscellaneous::all();

        $total_misc = $misc->sum('amount');

        // total balance and/or payable of student 
        // (unit price * total units) + total misc
        $total_payable = ($total_units * $unit_price->amount) + $total_misc;

        if($lab_units > 0) {
            $total_payable += 1000;
        }

        $assessment = new Assessment();
        $assessment->student_id = $student->id;
        $assessment->academic_year_id = $ay->id;
        $assessment->semester_id = $sem->id;
        $assessment->year_level_id = $yl->id;
        $assessment->course_id = $course->id;
        $assessment->curriculum_id = $curriculum->id;
        $assessment->section_id = $section->id;
        $assessment->amount = $total_payable;
        $assessment->save();

        // create balance and deduct amount payment
        $balance = new Balance();
        $balance->student_id = $student->id;
        $balance->academic_year_id = $ay->id;
        $balance->semester_id = $sem->id;
        $balance->balance = $total_payable;
        $balance->total = $total_payable;
        $balance->save();

        // add activity log
        GeneralController::activity_log(Auth::user()->id, 6, 'Student Saved Assessment');

        // return to enrollment
        return redirect()->route('student.enrollment')->with('success', 'Assessment Saved!');

    }


    // method use to show enrollment page to student
    public function enrollment()
    {
        // check active academic year and active semester
        $ay = AcademicYear::where('active', 1)->first();
        $sem = Semester::where('active', 1)->first();

        $es = EnrollmentSetting::find(1);
        $rp = RegistrationPayment::where('student_id', Auth::user()->id)->where('active', 1)->first();

        if(empty($ay) && empty($sem)) {
            return redirect()->route('student.dashboard')->with('error', 'No active Academic Year or Semester!');
        }

        // check if enrollment is active
        $enrollment_status = EnrollmentSetting::find(1);

        if($enrollment_status->active == 0) {
            return redirect()->back()->with('error', 'Enrollment is Inactive!');
        }

        // check if there is active assessment
        $assessment = Assessment::where('student_id', Auth::user()->id)
                            ->where('active', 1)
                            ->first();

        if(!empty($assessment)) {
            return redirect()->route('student.dashboard')->with('error', 'No Assessment!');
        }

        // get all the data needed to display in the enrollment
        // active assessment for the student
        // sections
        // schedules and rooms
        $student = User::find(Auth::user()->id);

        $balance = Balance::where('student_id', $student->id)
                        ->where('academic_year_id', $ay->id)
                        ->where('semester_id', $sem->id)
                        ->first();

        $course_id = $student->enrolled->course_id;
        $curriculum_id = $student->enrolled->curriculum_id;
        $major_id = $student->enrolled->major_id;
        $yl_id = $student->info->year_level_id;

        $course = Course::find($course_id);
        $curriculum = Curriculum::find($curriculum_id);
        $major = CourseMajor::find($major_id);
        $yl = YearLevel::find($yl_id);
        $section = Section::find($assessment->section_id);


        $subjects = Subject::where('course_id', $course_id)
                        ->where('curriculum_id', $curriculum_id)
                        ->where('year_level_id', $yl_id)
                        ->where('semester_id', $sem->id)
                        ->orderBy('code', 'asc')
                        ->get();

        $schedules = Schedule::where('course_id', $course_id)
                        ->where('curriculum_id', $curriculum_id)
                        ->where('year_level_id', $yl_id)
                        ->where('section_id', $section->id)
                        ->orderBy('day', 'asc')
                        ->orderBy('start_time', 'asc')
                        ->get();



        return view('student.enrollment', [
                'assessment' => $assessment,
                'balance' => $balance,
                'subjects' => $subjects,
                'schedules' => $schedules,
                'es' => $es,
                'rp' => $rp,
                'student' => $student,
                'course' => $course,
                'curriculum' => $curriculum,
                'major' => $major,
                'section' => $section,
                'yl' => $yl,
                'sem' => $sem
            ]);

        // check if paid for pre-registration
        // $reg_payment = RegistrationPayment::where('student_id', Auth::user()->id)->where('active', 1)->first();

        // if(count($reg_payment) < 1) {
        //     return redirect()->route('student.dashboard')->with('error', 'Registration Payment Not Paid!');
        // } 

        // // check course/major/curriculum to load subject based on year level and semester
        // $course_enrolled = CourseEnrolled::where('student_id', Auth::user()->id)
        //                         ->where('active', 1)
        //                         ->first();

        // $subjects = Subject::where('course_id', $course_enrolled->course_id)
        //                 ->where('curriculum_id', $course_enrolled->curriculum_id)
        //                 ->where('year_level_id', Auth::user()->info->year_level_id)
        //                 ->where('semester_id', $sem->id)
        //                 ->get();

        // $total_units = $subjects->sum('units');

        // // get misc and unit price
        // $unit_price = UnitPrice::find(1);
        // $misc = Miscellaneous::all();

        // $total_misc = $misc->sum('amount');

        // // total balance and/or payable of student 
        // // (unit price * total units) + total misc
        // $total_payable = ($total_units * $unit_price->amount) + $total_misc;

        // // check if there is active balance in the balances tables
        // // if there is existing, nothing to do
        // // if there is not, create an active record to the database

        // return view('student.enrollment', ['es' => $enrollment_status, 'subjects' => $subjects, 'total_units' => $total_units, 'total_misc' => $total_misc, 'total_payable' => $total_payable, 'ay' => $ay, 'sem' => $sem]);
    }


    // method use to view grades
    public function grades()
    {
        $student = Auth::user();

        $ay = AcademicYear::whereActive(1)->first();
        // $sem = Semester::whereActive(1)->first();

        if(empty($ay)) {
            return redirect()->route('student.dashboard')->with('error', 'No Active Academic Year');
        }

        $prev_sem_id = 2;
        $prev_ay_id = null;

        if($ay) {
            $prev_ay_id = $ay->id - 1;
        }

        // $grades = Grade::where('student_id', $student->id)
        //                 ->where('academic_year_id', $ay->id)
        //                 ->where('semester_id', $sem->id)
        //                 ->get();
        

        $prev_ay = AcademicYear::find($prev_ay_id);

        if(!empty($prev_ay)) {
            $grades = Grade::where('student_id', $student->id)
                    ->where('academic_year_id', $prev_ay->id)
                    // ->where('semester_id', $prev_sem_id)
                    ->get();
        }
        else {
            $grades = null;
        }

    
        return view('student.grades', ['grades' => $grades]);
    }


    // method use to view all grades
    public function allGrades()
    {
        $grades = Grade::where('student_id', Auth::user()->id)->get();

        return view('student.grades-all', ['grades' => $grades]);
    }


    // method use to show balance for the current semester
    public function balance()
    {
        $ay = AcademicYear::where('active', 1)->first();
        $sem = Semester::where('active', 1)->first();

        if(count($ay) < 1 && count($sem) < 1) {
            return redirect()->route('student.dashboard')->with('error', 'Admin Setup not fisnished! No Active Academic Year!');
        } 

        $balance = Balance::where('student_id', Auth::user()->id)
                        ->where('academic_year_id', $ay->id)
                        ->where('semester_id', $sem->id)
                        ->first();

        $enrolled = EnrolledStudent::where('student_id', Auth::user()->id)
                        ->where('academic_year_id', $ay->id)
                        ->where('semester_id', $sem->id)
                        ->where('status', 1)
                        ->first();

        return view('student.balance', ['balance' => $balance, 'enrolled' => $enrolled]);
    }


    // method use to show payments
    public function payments()
    {
        $payments = Payment::where('student_id', Auth::user()->id)
                            ->where('active', 1)
                            ->orderBy('created_at', 'desc')
                            ->paginate(15);

        return view('student.payments', ['payments' => $payments]);
    }


    // method use to view payment details
    public function paymentDetails($id = null)
    {
        $payment = Payment::findorfail($id);

        $assessment = Assessment::orderBy('created_at', 'desc')->first();

        return view('student.payment-details', ['payment' => $payment, 'assessment' => $assessment]);
    }


    // method use to go to paypal registration payment
    public function paypalRegistrationPayment()
    {
        // redirect back if regitration payment is paid

        return view('student.payment-registration-paypal');
    }


    // method use to add record in registration payment and redirect to payWithPaypal method
    public function registrationPaymentWithPaypal(Request $request)
    {

        // add unconrfirmed registration payment for the student
        $ay = AcademicYear::where('active', 1)->first();
        $sem = Semester::where('active', 1)->first();

        if(empty($ay) || empty($sem)) {
            return redirect()->back()->with('error', 'Academic Year Not Found! Please Report to Admin!');
        }

        // registration for the first payment of the student
        // check if there is existing active payment in registration payment record of the student
        $rp = RegistrationPayment::where('student_id', Auth::user()->id)
                                ->where('active', 1)
                                ->first();

        // check if there is pending payment subject for finishing
        $unfinished_payment = Payment::where('student_id', Auth::user()->id)
                                    ->where('academic_year_id', $ay->id)
                                    ->where('semester_id', $sem->id)
                                    ->where('active', 0)
                                    ->first();

        

        if(!empty($unfinished_payment)) {
            // return redirect()->route('student.dashboard')->with('info', 'Please Paying Try Again Later.');
            $unfinished_payment->delete();
        }

        if(empty($rp)) {
            // add new record for registration payment
            // make student legible for enrollment
            $reg_payment = new RegistrationPayment();
            $reg_payment->student_id = Auth::user()->id;
            $reg_payment->mode_of_payment_id = 1;
            $reg_payment->academic_year_id = $ay->id;
            $reg_payment->semester_id = $sem->id;
            $reg_payment->amount = $request->get('amount');
            $reg_payment->active = 0;
            $reg_payment->save();

            $payment = new Payment();
            $payment->student_id = Auth::user()->id;
            $payment->academic_year_id = $ay->id;
            $payment->semester_id = $sem->id;
            $payment->mode_of_payment_id = 1;
            $payment->amount = $request->get('amount');
            $payment->description = 'Registration Payment Paypal';
            $payment->active = 0;
            $payment->save();
        }

        // new paypal payment instance
        $paypal = new PaymentController();

        return $paypal->payWithpaypal($request);
    }
    

    // method use to go to card registration payment
    public function cardRegistrationPayment()
    {
        // add to registration payment
        $ay = AcademicYear::where('active', 1)->first();
        $sem = Semester::where('active', 1)->first();

        if(empty($ay) || empty($sem)) {
            return redirect()->back()->with('error', 'Academic Year Not Found! Please Report to Admin!');
        }

        // check if there is pending payment subject for finishing
        $unfinished_payment = Payment::where('student_id', Auth::user()->id)
                                    ->where('academic_year_id', $ay->id)
                                    ->where('semester_id', $sem->id)
                                    ->where('active', 0)
                                    ->first();

        

        if(!empty($unfinished_payment)) {
            // return redirect()->route('student.dashboard')->with('info', 'Please Try Paying Again Later.');
            $unfinished_payment->delete();
        }
        
        // redirect back if regitration payment is paid
        
        return view('student.payment-registration-card');
    }


    // method use to review card payment registration
    public function reviewCardRegistrationPayment(Request $request)
    {
        // add to registration payment
        $ay = AcademicYear::where('active', 1)->first();
        $sem = Semester::where('active', 1)->first();

        // check if there is pending payment subject for finishing
        $unfinished_payment = Payment::where('student_id', Auth::user()->id)
                                    ->where('academic_year_id', $ay->id)
                                    ->where('semester_id', $sem->id)
                                    ->where('active', 0)
                                    ->first();



        if(!empty($unfinished_payment)) {
            // return redirect()->route('student.dashboard')->with('info', 'Please Try Paying Again Later.');
            $unfinished_payment->delete();
        }

        $amount = $request['amount'];
        $currency = $request['currency'];
        $name = $request['name'];
        $description = $request['description'];

        return view('student.payment-registration-card-review', ['amount' => $amount, 'currency' => $currency, 'name' => $name, 'description' => $description]);
    }


    // method use to process payment registration using card payment
    public function postCardRegistrationPayment(Request $request)
    {
        // add to registration payment
        $ay = AcademicYear::where('active', 1)->first();
        $sem = Semester::where('active', 1)->first();

        if(empty($ay) || empty($sem)) {
            return redirect()->back()->with('error', 'Academic Year Not Found! Please Report to Admin!');
        }

        // check if there is pending payment subject for finishing
        $unfinished_payment = Payment::where('student_id', Auth::user()->id)
                                    ->where('academic_year_id', $ay->id)
                                    ->where('semester_id', $sem->id)
                                    ->where('active', 0)
                                    ->first();


        if(!empty($unfinished_payment)) {
            // return redirect()->route('student.dashboard')->with('info', 'Please Paying Try Again Later.');
            $unfinished_payment->delete();
        }


        // \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        \Stripe\Stripe::setApiKey('sk_test_gUBJYfvvnCq1QvzEARJvLfGm');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $request['stripeToken'];
        $amount = $request['amount'];
        $description = $request['description'];


        $charge = \Stripe\Charge::create([
            'amount' => $amount,
            'currency' => 'php',
            'description' => $description,
            'source' => $token,
        ]);



        $reg_payment = new RegistrationPayment();
        $reg_payment->student_id = Auth::user()->id;
        $reg_payment->mode_of_payment_id = 2;
        $reg_payment->academic_year_id = $ay->id;
        $reg_payment->semester_id = $sem->id;
        $reg_payment->amount = substr($amount, 0, -2);
        $reg_payment->active = 1;
        $reg_payment->save();

        // add to payment and what type of payment 
        // to deduct to the total payable of the student to the current semester of the academic year
        $payment = new Payment();
        $payment->student_id = Auth::user()->id;
        $payment->academic_year_id = $ay->id;
        $payment->semester_id = $sem->id;
        $payment->mode_of_payment_id = 2;
        $payment->amount = substr($amount, 0, -2);
        $payment->description = 'Registration Payment using Card';
        $payment->save();

        // check course/major/curriculum to load subject based on year level and semester
        $course_enrolled = CourseEnrolled::where('student_id', Auth::user()->id)
                                ->where('active', 1)
                                ->first();

        $subjects = Subject::where('course_id', $course_enrolled->course_id)
                        ->where('curriculum_id', $course_enrolled->curriculum_id)
                        ->where('year_level_id', Auth::user()->info->year_level_id)
                        ->where('semester_id', $sem->id)
                        ->get();

        $total_units = $subjects->sum('units');

        // get misc and unit price
        $unit_price = UnitPrice::find(1);
        $misc = Miscellaneous::all();

        $total_misc = $misc->sum('amount');

        // total balance and/or payable of student 
        // (unit price * total units) + total misc
        $total_payable = ($total_units * $unit_price->amount) + $total_misc;

        // create balance and deduct amount payment
        $balance = Balance::where('student_id', Auth::user()->id)
                        ->where('academic_year_id', $ay->id)
                        ->where('semester_id', $sem->id)
                        ->first();

        $balance->balance = $total_payable - $payment->amount;
        $balance->save();

        $payment->current_balance = $balance->balance;
        $payment->save();

        // add student to enrolled to the current academic year and semester
        EnrollmentController::enroll_student(Auth::user()->id);

        // add to activity log
        GeneralController::activity_log(Auth::user()->id, 6, 'Student Payment using Card');

        // return message
        return redirect()->route('student.payments')->with('success', 'Payment using Card is Successful!');

    }


    // method use to pay registration
    public function paymayaRegistrationPayment()
    {
        // add to registration payment
        $ay = AcademicYear::where('active', 1)->first();
        $sem = Semester::where('active', 1)->first();

        if(empty($ay) || empty($sem)) {
            return redirect()->back()->with('error', 'Academic Year Not Found! Please Report to Admin!');
        }

        // check if there is pending payment subject for finishing
        $unfinished_payment = Payment::where('student_id', Auth::user()->id)
                                    ->where('academic_year_id', $ay->id)
                                    ->where('semester_id', $sem->id)
                                    ->where('active', 0)
                                    ->first();

        

        if(!empty($unfinished_payment)) {
            // return redirect()->route('student.dashboard')->with('info', 'Please Try Paying Again Later.');
            $unfinished_payment->delete();
        }
        
        // redirect back if regitration payment is paid
        
        return view('student.payment-registration-paymaya');
    }


    // method use to pay registration payment using paymaya
    // method use to process payment registration using card payment
    public function postPaymayaRegistrationPayment(Request $request)
    {
        // add to registration payment
        $ay = AcademicYear::where('active', 1)->first();
        $sem = Semester::where('active', 1)->first();

        if(empty($ay) || empty($sem)) {
            return redirect()->back()->with('error', 'Academic Year Not Found! Please Report to Admin!');
        }

        $amount = $request['amount'];
        $description = $request['description'];

        // check if there is pending payment subject for finishing
        $unfinished_payment = Payment::where('student_id', Auth::user()->id)
                                    ->where('academic_year_id', $ay->id)
                                    ->where('semester_id', $sem->id)
                                    ->where('active', 0)
                                    ->first();


        if(!empty($unfinished_payment)) {
            // return redirect()->route('student.dashboard')->with('info', 'Please Paying Try Again Later.');
            $unfinished_payment->delete();
        }


        $reg_payment = new RegistrationPayment();
        $reg_payment->student_id = Auth::user()->id;
        $reg_payment->mode_of_payment_id = 4;
        $reg_payment->academic_year_id = $ay->id;
        $reg_payment->semester_id = $sem->id;
        $reg_payment->amount = substr($amount, 0, -2);
        $reg_payment->active = 1;
        $reg_payment->save();

        // add to payment and what type of payment 
        // to deduct to the total payable of the student to the current semester of the academic year
        $payment = new Payment();
        $payment->student_id = Auth::user()->id;
        $payment->academic_year_id = $ay->id;
        $payment->semester_id = $sem->id;
        $payment->mode_of_payment_id = 4;
        $payment->amount = $amount;
        $payment->description = 'Registration Payment using Paymaya';
        $payment->save();

        // check course/major/curriculum to load subject based on year level and semester
        $course_enrolled = CourseEnrolled::where('student_id', Auth::user()->id)
                                ->where('active', 1)
                                ->first();

        $subjects = Subject::where('course_id', $course_enrolled->course_id)
                        ->where('curriculum_id', $course_enrolled->curriculum_id)
                        ->where('year_level_id', Auth::user()->info->year_level_id)
                        ->where('semester_id', $sem->id)
                        ->get();

        $total_units = $subjects->sum('units');

        // get misc and unit price
        $unit_price = UnitPrice::find(1);
        $misc = Miscellaneous::all();

        $total_misc = $misc->sum('amount');

        // total balance and/or payable of student 
        // (unit price * total units) + total misc
        $total_payable = ($total_units * $unit_price->amount) + $total_misc;

        // create balance and deduct amount payment
        $balance = Balance::where('student_id', Auth::user()->id)
                        ->where('academic_year_id', $ay->id)
                        ->where('semester_id', $sem->id)
                        ->first();

        $balance->balance = $total_payable - $payment->amount;
        $balance->save();

        $payment->current_balance = $balance->balance;
        $payment->save();

        // add student to enrolled to the current academic year and semester
        EnrollmentController::enroll_student(Auth::user()->id);

        // add to activity log
        GeneralController::activity_log(Auth::user()->id, 6, 'Student Payment using Paymaya');

        // return message
        return redirect()->route('student.payments')->with('success', 'Payment using Paymaya is Successful!');

    }


    // method use to pay tuition fee using payapl
    public function tuitionFeePaypalPayment()
    {
        // add to registration payment
        $ay = AcademicYear::where('active', 1)->first();
        $sem = Semester::where('active', 1)->first();

        if(empty($ay) || empty($sem)) {
            return redirect()->back()->with('error', 'Academic Year Not Found! Please Report to Admin!');
        }

        // check if there is pending payment subject for finishing
        $unfinished_payment = Payment::where('student_id', Auth::user()->id)
                                    ->where('academic_year_id', $ay->id)
                                    ->where('semester_id', $sem->id)
                                    ->where('active', 0)
                                    ->first();


        if(!empty($unfinished_payment)) {
            // return redirect()->route('student.dashboard')->with('info', 'Please Paying Try Again Later.');
            $unfinished_payment->delete();
        }

        $balance = Balance::where('student_id', Auth::user()->id)
                            ->where('academic_year_id', $ay->id)
                            ->where('semester_id', $sem->id)
                            ->first();

        if(ceil($balance->balance) < 1) {
            return redirect()->route('student.balance')->with('info', 'You have zero balance in Tuition fee.');
        }

        return view('student.payment-paypal', ['balance' => $balance]);
    }


    // method use to perform payment in paypal
    public function postTuitionFeePaypalPayment(Request $request)
    {
        // add unconrfirmed registration payment for the student
        $ay = AcademicYear::where('active', 1)->first();
        $sem = Semester::where('active', 1)->first();

        if(empty($ay) || empty($sem)) {
            return redirect()->back()->with('error', 'Academic Year Not Found! Please Report to Admin!');
        }

        // check if there is pending payment subject for finishing
        $unfinished_payment = Payment::where('student_id', Auth::user()->id)
                                    ->where('academic_year_id', $ay->id)
                                    ->where('semester_id', $sem->id)
                                    ->where('active', 0)
                                    ->first();


        if(!empty($unfinished_payment)) {
            // return redirect()->route('student.dashboard')->with('info', 'Please Paying Try Again Later.');
            $unfinished_payment->delete();
        }

        $payment = new Payment();
        $payment->student_id = Auth::user()->id;
        $payment->academic_year_id = $ay->id;
        $payment->semester_id = $sem->id;
        $payment->mode_of_payment_id = 1;
        $payment->amount = $request->get('amount');
        $payment->description = 'Tuition Fee Payment Paypal';
        $payment->active = 0;
        $payment->save();

        $paypal = new PaymentController();

        return $paypal->payWithpaypal($request);
    }


    // method use to pay tuition fee card payment
    public function tuitionFeeCardPayment()
    {
        $ay = AcademicYear::where('active', 1)->first();
        $sem = Semester::where('active', 1)->first();

        if(empty($ay) || empty($sem)) {
            return redirect()->back()->with('error', 'Academic Year Not Found! Please Report to Admin!');
        }

        // check if there is pending payment subject for finishing
        $unfinished_payment = Payment::where('student_id', Auth::user()->id)
                                    ->where('academic_year_id', $ay->id)
                                    ->where('semester_id', $sem->id)
                                    ->where('active', 0)
                                    ->first();


        if(!empty($unfinished_payment) ) {
            // return redirect()->route('student.dashboard')->with('info', 'Please Paying Try Again Later.');
            $unfinished_payment->delete();
        }

        $balance = Balance::where('student_id', Auth::user()->id)
                            ->where('academic_year_id', $ay->id)
                            ->where('semester_id', $sem->id)
                            ->first();

        if(ceil($balance->balance) < 1) {
            return redirect()->route('student.balance')->with('info', 'You have zero balance in Tuition fee.');
        }

        return view('student.payment-card', ['balance' => $balance]);
    }


    // method use to pay tuition fee using card
    public function reviewTuitionFeeCardPayment(Request $request)
    {
        $amount = $request['amount'];
        $currency = $request['currency'];
        $name = $request['name'];
        $description = $request['description'];

        return view('student.payment-card-review', ['amount' => $amount, 'currency' => $currency, 'name' => $name, 'description' => $description]);
    }


    // method use to make tuition fee payment using card
    public function postTuitionFeeCardPayment(Request $request)
    {
        $ay = AcademicYear::where('active', 1)->first();
        $sem = Semester::where('active', 1)->first();

        if(empty($ay) || empty($sem)) {
            return redirect()->back()->with('error', 'Academic Year Not Found! Please Report to Admin!');
        }

        // check if there is pending payment subject for finishing
        $unfinished_payment = Payment::where('student_id', Auth::user()->id)
                                    ->where('academic_year_id', $ay->id)
                                    ->where('semester_id', $sem->id)
                                    ->where('active', 0)
                                    ->first();


        if(!empty($unfinished_payment)) {
            // return redirect()->route('student.dashboard')->with('info', 'Please Paying Try Again Later.');
            $unfinished_payment->delete();
        }

        // \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        \Stripe\Stripe::setApiKey('sk_test_gUBJYfvvnCq1QvzEARJvLfGm');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $request['stripeToken'];
        $amount = $request['amount'];
        $description = $request['description'];


        $charge = \Stripe\Charge::create([
            'amount' => $amount,
            'currency' => 'php',
            'description' => $description,
            'source' => $token,
        ]);



        // add to payment and what type of payment 
        // to deduct to the total payable of the student to the current semester of the academic year
        $payment = new Payment();
        $payment->student_id = Auth::user()->id;
        $payment->academic_year_id = $ay->id;
        $payment->semester_id = $sem->id;
        $payment->mode_of_payment_id = 2;
        $payment->amount = substr($amount, 0, -2);
        $payment->description = 'Tuition Fee Payment using Card';
        $payment->save();

        // deduct in balance
        $balance = Balance::where('student_id', Auth::user()->id)
                        ->where('academic_year_id', $ay->id)
                        ->where('semester_id', $sem->id)
                        ->first();

        $balance->balance -= $payment->amount;
        $balance->save();

        $payment->current_balance = $balance->balance;
        $payment->save();

        // add activity log
        GeneralController::activity_log(Auth::user()->id, 6, 'Student Payment using card');

        // return with success message
        return redirect()->route('student.payments')->with('success', 'Payment using Card is Successful!');

    }


    // method use to pay tuiton using paymaya
    public function tuitionFeePaymaya()
    {
        $ay = AcademicYear::where('active', 1)->first();
        $sem = Semester::where('active', 1)->first();

        if(empty($ay) || empty($sem)) {
            return redirect()->back()->with('error', 'Academic Year Not Found! Please Report to Admin!');
        }

        // check if there is pending payment subject for finishing
        $unfinished_payment = Payment::where('student_id', Auth::user()->id)
                                    ->where('academic_year_id', $ay->id)
                                    ->where('semester_id', $sem->id)
                                    ->where('active', 0)
                                    ->first();


        if(!empty($unfinished_payment)) {
            // return redirect()->route('student.dashboard')->with('info', 'Please Paying Try Again Later.');
            $unfinished_payment->delete();
        }

        $balance = Balance::where('student_id', Auth::user()->id)
                            ->where('academic_year_id', $ay->id)
                            ->where('semester_id', $sem->id)
                            ->first();

        if(ceil($balance->balance) < 1) {
            return redirect()->route('student.balance')->with('info', 'You have zero balance in Tuition fee.');
        }

        return view('student.payment-paymaya', ['balance' => $balance]);
    }


    // method use to make payment using paymaya
    public function postTuitionFeePaymaya(Request $request)
    {
        $request->validate([
            'card_number' => 'required|numeric|digits:16',
            'amount' => 'required|numeric'
        ]);

        $amount = $request['amount'];

        $ay = AcademicYear::where('active', 1)->first();
        $sem = Semester::where('active', 1)->first();

        if(empty($ay) || empty($sem)) {
            return redirect()->back()->with('error', 'Academic Year Not Found! Please Report to Admin!');
        }

        // check if there is pending payment subject for finishing
        $unfinished_payment = Payment::where('student_id', Auth::user()->id)
                                    ->where('academic_year_id', $ay->id)
                                    ->where('semester_id', $sem->id)
                                    ->where('active', 0)
                                    ->first();


        if(!empty($unfinished_payment)) {
            // return redirect()->route('student.dashboard')->with('info', 'Please Paying Try Again Later.');
            $unfinished_payment->delete();
        }



        // add to payment and what type of payment 
        // to deduct to the total payable of the student to the current semester of the academic year
        $payment = new Payment();
        $payment->student_id = Auth::user()->id;
        $payment->academic_year_id = $ay->id;
        $payment->semester_id = $sem->id;
        $payment->mode_of_payment_id = 4;
        $payment->amount = $amount;
        $payment->description = 'Tuition Fee Payment using Paymaya';
        $payment->save();

        // deduct in balance
        $balance = Balance::where('student_id', Auth::user()->id)
                        ->where('academic_year_id', $ay->id)
                        ->where('semester_id', $sem->id)
                        ->first();

        $balance->balance -= $payment->amount;
        $balance->save();


        $payment->current_balance = $balance->balance;
        $payment->save();

        // add activity log
        GeneralController::activity_log(Auth::user()->id, 6, 'Student Payment using Paymaya');

        // return with success message
        return redirect()->route('student.payments')->with('success', 'Payment using Paymaya is Successful!');
    }
}
