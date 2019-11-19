<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\GeneralController;
use Excel;

use App\Cashier;
use App\Payment;
use App\Balance;
use App\RegistrationPayment;
use App\User;
use App\AcademicYear;
use App\Semester;
use App\EnrolledStudent;


class CashierController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:cashier');
    }


    // method use to view dashboard of cashier
    public function dashboard()
    {
    	return view('cashier.dashboard');
    }


    // method use to view profile of cashier
    public function profile()
    {
    	return view('cashier.profile');
    }


    // method use to update profile of cashier
    public function updateProfile()
    {
    	return view('cashier.profile-update');
    }


    // method use to save profile update
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

        $cashier = Cashier::find(Auth::guard('cashier')->user()->id);

        // check id number existence
        $check_id = Cashier::where('id_number')->first();

        if(!empty($check_id) && $cashier->id_number == $id_number && $id_number != null) {
            return redirect()->back()->with('error', 'ID Number Exists!');
        }

        $cashier->firstname = $firstname;
        $cashier->middle_name = $middlename;
        $cashier->lastname = $lastname;
        $cashier->suffix_name = $suffix;
        $cashier->id_number = $id_number;
        $cashier->save();

        // add activity log
        GeneralController::activity_log(Auth::guard('cashier')->user()->id, 4, 'Cashier Updated Profile');

        return redirect()->route('cashier.profile')->with('success', 'Profile Updated!');
    }


    // method use to changep password for cashier
    public function changePassword()
    {
    	return view('cashier.password-change');
    }


    // method use to save new password for cashier
    public function postChangePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6|max:32'
        ]);

        $old_password = $request['old_password'];
        $password = $request['password'];

        // check old password if matched to the correct password
        if(!password_verify($old_password, Auth::guard('cashier')->user()->password)) {
            return redirect()->back()->with('error', 'Incorrect Old Password!');
        }

        // check if the new password is same as the old
        if(password_verify($password, Auth::guard('cashier')->user()->password)) {
            return redirect()->back()->with('error', 'New Password Entered is Same as Old Password!');
        }

        // change password
        $cashier = Cashier::find(Auth::guard('cashier')->user()->id);
        $cashier->password = bcrypt($password);
        $cashier->save();

        // add activty log
        GeneralController::activity_log(Auth::guard('cashier')->user()->id, 4, 'Cashier Change Password');

        // return to deans and add admin with message
        return redirect()->route('cashier.dashboard')->with('success', 'Password Changed!');
    }



    // method use in payment tagging
    public function paymentTagging()
    {
        return view('cashier.tagging');
    }





    // full payment tagging
    public function fullPaymentTagging($id)
    {
        // student 
        $student = \App\User::findorfail($id);
        $ay = AcademicYear::where('active', 1)->first();


        
        //  get assessment
        $assessment = \App\Assessment::where('student_id', $student->id)->first();

        // make assessment paid
        if(!empty($assessment)) {
            $assessment->paid = 1;

            $enrolled = new \App\EnrolledStudent();
            $enrolled->student_id = $student->id;
            $enrolled->academic_year_id = $ay->id;
            $enrolled->save();


            return redirect()->back()->with('success', 'Tagging Full Payment!');
        }
        else {
            return redirect()->route('cashier.payment.tagging')->with('error', 'NO Assessment Found!');
        }
    }


    public function partialPaymentTagging($id)
    {
         // student 
        $student = \App\User::findorfail($id);

        $ay = AcademicYear::where('active', 1)->first();


        
        //  get assessment
        $assessment = \App\Assessment::where('student_id', $student->id)->first();

        // make assessment paid
        if(!empty($assessment)) {
            $assessment->partial = 1;

            $enrolled = new \App\EnrolledStudent();
            $enrolled->student_id = $student->id;
            $enrolled->academic_year_id = $ay->id;
            $enrolled->save();

            return redirect()->back()->with('success', 'Tagging Partial Payment!');
        }
        else {
            return redirect()->route('cashier.payment.tagging')->with('error', 'NO Assessment Found!');
        }
    }



    // method use to view balances of students
    public function balances()
    {
        $ay = AcademicYear::where('active', 1)->first();
        // $sem = Semester::where('active', 1)->first();

        if(empty($ay) || empty($sem)) {
            return redirect()->back()->with('error', 'Academic Year Not Found! Please Report to Admin!');
        }

        $balances = Balance::where('academic_year_id', $ay->id)
                        ->where('semester_id', $sem->id)
                        ->paginate(15);

        return view('cashier.balances', ['balances' => $balances]);
    }


    // method use to view payments
    public function payments()
    {
        $payments = Payment::where('active', 1)
                        ->orderBy('created_at', 'desc')
                        ->paginate(15);

        return view('cashier.payments', ['payments' => $payments]);
    }


    // method use to make over the counter payment for the student
    public function studentCounterPayment()
    {
        return view('cashier.payment-student-cashier');
    }


    // method use to search students
    public function studentSearch(Request $request)
    {
        $keyword = $request['q'];

        $students = GeneralController::students_search($keyword);

        return view('cashier.payment-student-search-cashier', ['students' => $students, 'keyword' => $keyword]);
    }


    // method use to make payment by the cashier
    public function makePayment($id = null)
    {
        $student = User::findorfail($id);

        return view('cashier.payment-make', ['student' => $student]);
    }


    // method use to finalize payment of the walkin
    public function postMakePayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric'
        ]);

        $student_id = $request['student_id'];
        $amount = $request['amount'];
        $remark = $request['remark'];

        $student = User::findorfail($student_id);
        $ay = AcademicYear::whereActive(1)->first();
        $sem = Semester::whereActive(1)->first();

        if(empty($ay) && empty($sem)) {
            return redirect()->back()->with('error', 'No Active School Year! Please Report to Admin!');
        }

        $balance = Balance::where('student_id', $student->id)
                            ->where('academic_year_id', $ay->id)
                            ->where('semester_id', $sem->id)
                            ->first();

        // add registration payment if there is none
        // first payment even in over the counter is registration payment
        $rp = RegistrationPayment::where('student_id', $student->id)
                        ->where('academic_year_id', $ay->id)
                        ->where('semester_id', $sem->id)
                        ->whereActive(1)
                        ->first();

        if(empty($rp)) {
            $reg_p = new RegistrationPayment();
            $reg_p->student_id = $student->id;
            $reg_p->mode_of_payment_id = 3;
            $reg_p->academic_year_id = $ay->id;
            $reg_p->semester_id = $sem->id;
            $reg_p->amount = $amount;
            $reg_p->save();

            // enrolled students
            $enrolled = new EnrolledStudent();
            $enrolled->student_id = $student->id;
            $enrolled->academic_year_id = $ay->id;
            $enrolled->semester_id = $sem->id;
            $enrolled->save();
        }


        // make the deduction of payed amount to the current balance of student
        $payment = new Payment();
        $payment->student_id = $student->id;
        $payment->academic_year_id = $ay->id;
        $payment->semester_id = $sem->id;
        $payment->mode_of_payment_id = 3;
        $payment->amount = $amount;
        $payment->description = $remark;
        $payment->save();

        $balance->balance -= $payment->amount;
        $balance->save();


        $payment->current_balance = $balance->balance;
        $payment->save();

        // add to activity log
        GeneralController::activity_log(Auth::guard('cashier')->user()->id, 4, 'Cashier Student Payment with Student No.: ' . $student->student_number);

        // return in payment with message
        return redirect()->route('cashier.payments')->with('success', 'Payment Saved!');
    }


    // method use to generate report in payments
    public function generateReportPayment()
    {
        return view('cashier.report-generate');
    }


    // method use to generate all report
    public function generateAllReportPayment()
    {
        $pays = Payment::get(['student_id', 'mode_of_payment_id', 'amount', 'created_at']);

        if(count($pays) < 1) {
            return redirect()->back()->with('error', 'No Payment Found!');
        }

        $payments = array();

        foreach($pays as $p) {
            array_push($payments, [
                'Student' => $p->student->firstname . ' ' . $p->student->lastname,
                'Student Number' => $p->student->student_number,
                'Mof of Payment' => $p->mop->name,
                'Amount' => $p->amount,
                'Date & Time' => date('F j, Y g:i:s a', strtotime($p->created_at))
            ]);
        }

        $filename = 'All Payments Made';

        GeneralController::activity_log(Auth::guard('cashier')->user()->id, 4, 'Cashier Downloaded All Payment Made');

        Excel::create($filename, function($excel) use ($payments) {
            $excel->sheet('payment', function($sheet) use ($payments)
            {
                $sheet->fromArray($payments);
            });
       })->download('xls');
    }


    // method use to generate current semester payment
    public function currentSemesterPayment()
    {
        $ay = AcademicYear::whereActive(1)->first();
        $sem = Semester::whereActive(1)->first();

        if(empty($ay) && empty($sem)) {
            return redirect()->back()->with('info', 'Please Contact Admin to check for active AY and Semester!');
        }

        // get all the payment made
        $pays = Payment::where('academic_year_id', $ay->id)->where('semester_id', $sem->id)->get(['student_id', 'mode_of_payment_id', 'amount', 'created_at']);

        if(count($pays) < 1) {
            return redirect()->back()->with('error', 'No Payment Found!');
        }

        $payments = array();

        foreach($pays as $p) {
            array_push($payments, [
                'Student' => $p->student->firstname . ' ' . $p->student->lastname,
                'Student Number' => $p->student->student_number,
                'Mode of Payment' => $p->mop->name,
                'Amount' => $p->amount,
                'Date & Time' => date('F j, Y g:i:s a', strtotime($p->created_at))
            ]);
        }

        $filename = $ay->from . '-' . $ay->to . '--' . $sem->name . '--' . 'Payments';

        GeneralController::activity_log(Auth::guard('cashier')->user()->id, 4, 'Cashier Downloaded Current Payment Made in the Current Semester');

        Excel::create($filename, function($excel) use ($payments) {
            $excel->sheet('payment', function($sheet) use ($payments)
            {
                $sheet->fromArray($payments);
            });
       })->export('xls');
    }


    // method use to generate payment report using custom date range
    public function generateReportPaymentCustomDate(Request $request)
    {
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        $start = $request['start_date'];
        $end = $request['end_date'];

        $pays = Payment::where('created_at', '>=', $start)->where('created_at', '<=', $end)->get(['student_id', 'mode_of_payment_id', 'amount', 'created_at']);

        if(count($pays) < 1) {
            return redirect()->back()->with('error', 'No Payment Found!');
        }

        $payments = array();

        foreach($pays as $p) {
            array_push($payments, [
                'Student' => $p->student->firstname . ' ' . $p->student->lastname,
                'Student Number' => $p->student->student_number,
                'Mode of Payment' => $p->mop->name,
                'Amount' => $p->amount,
                'Date & Time' => date('F j, Y g:i:s a', strtotime($p->created_at))
            ]);
        }

        $filename = $start . '--' . $end . '--' . 'Payments';

        GeneralController::activity_log(Auth::guard('cashier')->user()->id, 4, 'Cashier Downloaded Payment with Custom Date Range');

        Excel::create($filename, function($excel) use ($payments) {
            $excel->sheet('payment', function($sheet) use ($payments)
            {
                $sheet->fromArray($payments);
            });
       })->download('xls');
    }


    // method use to generate balance report
    public function generateReportBalance()
    {
        $bal = Balance::where('balance', '>', 0)->get(['student_id', 'academic_year_id', 'semester_id', 'balance', 'total', 'created_at']);


        if(count($bal) < 1) {
            return redirect()->back()->with('error', 'No Balance Found!');
        }

        $balances = array();

        foreach($bal as $p) {
            array_push($balances, [
                'Student' => $p->student->firstname . ' ' . $p->student->lastname,
                'Student Number' => $p->student->student_number,
                'Amount Balance' => $p->balance,
                'Date & Time' => date('F j, Y g:i:s a', strtotime($p->created_at))
            ]);
        }

        $filename = date('F j, Y', strtotime(now())) . '-' . 'Balance';

        GeneralController::activity_log(Auth::guard('cashier')->user()->id, 4, 'Cashier Generate Balance Report');

        Excel::create($filename, function($excel) use ($balances) {
            $excel->sheet('balance', function($sheet) use ($balances)
            {
                $sheet->fromArray($balances);
            });
       })->download('xls');        
    }














    // check if full payment or partial payment
    public static function checkPayment($id)
    {
        $assessment = \App\Assessment::where('student_id', $id)->first();

        if(!empty($assessment)) {
            return "With Assessment";
        }
        else {
            return "No Assessment";
        }
    }

}
