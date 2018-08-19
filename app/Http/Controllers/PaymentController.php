<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;

/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;


use Auth;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\EnrollmentController;
use App\RegistrationPayment;
use App\Payment as PaymentTable;
use App\AcademicYear;
use App\Semester;
use App\Balance;
use App\EnrolledStudent;
use App\CourseEnrolled;
use App\Subject;
use App\UnitPrice;
use App\Miscellaneous;


class PaymentController extends Controller
{
    private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);

    }

    public function payWithpaypal($request)
    {

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();

        $item_1->setName($request->get('name')) /** item name **/
            ->setCurrency('PHP')
            ->setQuantity(1)
            ->setPrice($request->get('amount')); /** unit price **/

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('PHP')
            ->setTotal($request->get('amount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription($request->get('description'));

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(route('student.paypal.payment.status')) /** Specify return URL **/
            ->setCancelUrl(route('student.paypal.payment.status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {

            $payment->create($this->_api_context);

        } catch (\PayPal\Exception\PPConnectionException $ex) {

            if (\Config::get('app.debug')) {

                \Session::put('error', 'Connection timeout');
                return redirect()->route('student.dashboard');

            } else {

                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return redirect()->route('student.dashboard');

            }

        }

        foreach ($payment->getLinks() as $link) {

            if ($link->getRel() == 'approval_url') {

                $redirect_url = $link->getHref();
                break;

            }

        }

        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());

        if (isset($redirect_url)) {

            /** redirect to paypal **/
            return Redirect::away($redirect_url);

        }

        \Session::put('error', 'Unknown error occurred');
        return redirect()->route('student.dashboard');

    }

    public function getPaymentStatus()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');

        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

            // \Session::put('error', 'Payment failed');
            PaymentTable::where('active', 0)->delete();
            return redirect()->route('student.dashboard')->with('error', 'Payment Failed!');

        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {

            $ay = AcademicYear::where('active', 1)->first();
            $sem = Semester::where('active', 1)->first();

            // registration for the first payment of the student
            // check if there is existing active payment in registration payment record of the student
            $rp = RegistrationPayment::where('student_id', Auth::user()->id)
                                    ->where('active', 0)
                                    ->where('academic_year_id', $ay->id)
                                    ->where('semester_id', $sem->id)
                                    ->orderBy('created_at', 'desc')
                                    ->first();

            if(count($rp) > 0) {
                // add new record for registration payment
                // make student legible for enrollment
                
                $rp->active = 1;
                $rp ->save();

                // get the last payment with inactive status
                $s_payment = PaymentTable::where('student_id', Auth::user()->id)
                                        ->where('active', 0)
                                        ->where('academic_year_id', $ay->id)
                                        ->where('semester_id', $sem->id)
                                        ->orderBy('created_at', 'desc')
                                        ->first();

                if(count($s_payment) > 0) {
                    $s_payment->active = 1;
                    $s_payment->save();
                }

                // add student to enrolled to the current academic year and semester
                EnrollmentController::enroll_student(Auth::user()->id);
            }
            else {
                $s_payment = PaymentTable::where('student_id', Auth::user()->id)
                                    ->where('mode_of_payment_id', 1)
                                    ->where('academic_year_id', $ay->id)
                                    ->where('semester_id', $sem->id)
                                    ->where('active', 0)
                                    ->orderBy('created_at', 'desc')
                                    ->first();

                if(count($s_payment) > 0) {
                    $s_payment->active = 1;
                    $s_payment->save();
                }
            }

            // compute balance if not created and deduct
            $balance = Balance::where('student_id', Auth::user()->id)
                            ->where('academic_year_id', $ay->id)
                            ->where('semester_id', $sem->id)
                            ->first();

            if(count($balance) > 0) {
                // deduct payment
                $balance->balance -= $s_payment->amount;
                $balance->save();
            }
            else {
                // get total payable for the sem
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
                $balance->balance = $total_payable - $s_payment->amount;
                $balance->total = $total_payable;
                $balance->save();
            }

            GeneralController::activity_log(Auth::user()->id, 6, 'Student Payment using Paypal');

            return redirect()->route('student.payments')->with('success', 'Paypal Payment Successful! ');

        }

        // \Session::put('error', 'Payment failed');
        PaymentTable::where('active', 0)->delete();

        return redirect()->route('student.dashboard')->with('error', 'Payment Failed');

    }


}
