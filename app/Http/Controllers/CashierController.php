<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\GeneralController;

use App\Cashier;
use App\Payment;
use App\Balance;
use App\RegistrationPayment;
use App\User;
use App\AcademicYear;
use App\Semester;

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

        if(count($check_id) > 0 && $cashier->id_number == $id_number && $id_number != null) {
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
            'password' => 'required|confirmed'
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


    // method use to view balances of students
    public function balances()
    {
        $ay = AcademicYear::where('active', 1)->first();
        $sem = Semester::where('active', 1)->first();

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

        $balance = Balance::where('student_id', $student->id)
                            ->where('academic_year_id', $ay->id)
                            ->where('semester_id', $sem->id)
                            ->first();

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

        // add to activity log

        // return in payment with message
        return redirect()->route('cashier.payments')->with('success', 'Payment Saved!');
    }


    // method use to generate report in payments
    public function generateReportPayment()
    {
        return 'Add Report Generate Module in Cashier';
    }

}
