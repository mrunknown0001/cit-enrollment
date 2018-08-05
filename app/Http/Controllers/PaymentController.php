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
use App\RegistrationPayment;
use App\Payment as PaymentTable;
use App\AcademicYear;
use App\Semester;

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
                                    ->where('active', 1)
                                    ->first();

            if(count($rp) > 0) {
                // add new record for registration payment
                // make student legible for enrollment
                
                $rp->active = 1;
                $rp ->save();

                // get the last payment with inactive status
                $payment = PaymentTable::where('student_id', Auth::user()->id)
                                        ->where('active', 0)
                                        ->orderBy('created_at', 'desc')
                                        ->first();
                if(count($payment) > 0) {
                    $payment->active = 1;
                    $payment->save();
                }
            }

            // add to payment and what type of payment 
            // to deduct to the total payable of the student to the current semester of the academic year

            // add to status enrolled a student, if registered and paid the firs paymnet of the tuition
            // if paid the second payment: note: first payment is registration, second payment is the first payment if the tuition fee that is divisible by four


            return redirect()->route('student.payments')->with('success', 'Paypal Payment Successful! ');

        }

        // \Session::put('error', 'Payment failed');
        return redirect()->route('student.dashboard')->with('error', 'Payment Failed');

    }

}
