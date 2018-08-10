<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\EnrollmentController;

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
use App\CourseEnrolled;
use App\Subject;
use App\UnitPrice;
use App\Miscellaneous;
use App\EnrolledStudent;


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


    // method use to show enrollment page to student
    public function enrollment()
    {
        // check active academic year and active semester
        $ay = AcademicYear::where('active', 1)->first();
        $sem = Semester::where('active', 1)->first();

        if(count($ay) < 1 && count($sem) < 1) {
            return redirect()->route('student.dashboard')->with('error', 'No active Academic Year or Semester!');
        }

        // check if enrollment is active
        $enrollment_status = EnrollmentSetting::find(1);

        if($enrollment_status->active == 0) {
            return redirect()->back()->with('error', 'Enrollment is Inactive!');
        }

        // check if paid for pre-registration
        $reg_payment = RegistrationPayment::where('student_id', Auth::user()->id)->where('active', 1)->first();

        if(count($reg_payment) < 1) {
            return redirect()->route('student.dashboard')->with('error', 'Registration Payment Not Paid!');
        } 

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

        // check if there is active balance in the balances tables
        // if there is existing, nothing to do
        // if there is not, create an active record to the database

        return view('student.enrollment', ['es' => $enrollment_status, 'subjects' => $subjects, 'total_units' => $total_units, 'total_misc' => $total_misc, 'total_payable' => $total_payable, 'ay' => $ay, 'sem' => $sem]);
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

        if(count($unfinished_payment) > 0) {
            return redirect()->route('student.dashboard')->with('info', 'Please Paying Try Again Later.');
        }

        if(count($rp) < 1) {
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
        // redirect back if regitration payment is paid
        
        return view('student.payment-registration-card');
    }


    // method use to review card payment registration
    public function reviewCardRegistrationPayment(Request $request)
    {
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

        // check if there is pending payment subject for finishing
        $unfinished_payment = Payment::where('student_id', Auth::user()->id)
                                    ->where('academic_year_id', $ay->id)
                                    ->where('semester_id', $sem->id)
                                    ->where('active', 0)
                                    ->first();

        if(count($unfinished_payment) > 0) {
            return redirect()->route('student.dashboard')->with('info', 'Please Paying Try Again Later.');
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
        $balance = new Balance();
        $balance->student_id = Auth::user()->id;
        $balance->academic_year_id = $ay->id;
        $balance->semester_id = $sem->id;
        $balance->balance = $total_payable - $payment->amount;
        $balance->total = $total_payable;
        $balance->save();

        // add student to enrolled to the current academic year and semester
        EnrollmentController::enroll_student(Auth::user()->id);

        // add to activity log

        // return message
        return redirect()->route('student.payments')->with('success', 'Payment using Card is Successful!');

    }


    // method use to pay tuition fee using payapl
    public function tuitionFeePaypalPayment()
    {
        $ay = AcademicYear::where('active', 1)->first();
        $sem = Semester::where('active', 1)->first();

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

        // check if there is pending payment subject for finishing
        $unfinished_payment = Payment::where('student_id', Auth::user()->id)
                                    ->where('academic_year_id', $ay->id)
                                    ->where('semester_id', $sem->id)
                                    ->where('active', 0)
                                    ->first();

        if(count($unfinished_payment) > 0) {
            return redirect()->route('student.dashboard')->with('info', 'Please Paying Try Again Later.');
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

        // check if there is pending payment subject for finishing
        $unfinished_payment = Payment::where('student_id', Auth::user()->id)
                                    ->where('academic_year_id', $ay->id)
                                    ->where('semester_id', $sem->id)
                                    ->where('active', 0)
                                    ->first();

        if(count($unfinished_payment) > 0) {
            return redirect()->route('student.dashboard')->with('info', 'Please Paying Try Again Later.');
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

        // add activity log

        // return with success message
        return redirect()->route('student.payments')->with('success', 'Payment using Card is Successful!');

    }
}
