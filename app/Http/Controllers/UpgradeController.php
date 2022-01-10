<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Package;
use App\Student;
use App\Payment;
use App\Feature;
use App\Ticket;
use Stripe;
use Billplz\Client;
use App\Jobs\UpgradeJob;

class UpgradeController extends Controller
{
    /*-- Participant Registration ------------------------------------------*/
    public function check_ic($product_id)
    {
        $product = Product::where('product_id', $product_id)->first();

        return view('upgrade_ticket.upgrade_participant', compact('product'));
    }
    
    public function not_participant($product_id)
    {
        $product = Product::where('product_id', $product_id)->first();

        return view('upgrade_ticket.not_participant', compact('product'));
    }

    public function verify_ic($product_id, Request $request)
    {
        $student = Student::where('ic', $request->ic)->first();

        if ($student == NULL){
            
            //if customer not found in database
            return view('certificate.not_found');
            
        }else{

            $payment = Payment::where('stud_id', $student->stud_id)->where('product_id', $product_id)->where('status', 'paid')->first();
            $ticket = Ticket::where('ic', $request->ic)->where('product_id', $product_id)->first();

            // Check if ic exist
            if($ticket){
                
                //if participant check in
                $package_id = $ticket->package_id;
                return redirect('upgrade-ticket/' . $product_id . '/' . $package_id . '/' . $ticket->ticket_id);

            }else if ($payment){

                //if buyer check in
                return redirect('not-participant/' . $product_id);

            }else{

                //if customer not found in database
                return view('certificate.not_found');

            }

        }
        
    }

    public function upgrade_ticket($product_id, $package_id, $ticket_id, Request $request){

        $product = Product::where('product_id', $product_id)->first();
        $package = Package::where('product_id', $product_id)->get(); //Show all package
        $current_package = Package::where('package_id', $package_id)->first(); //Package registered
        $feature = Feature::orderBy('id','asc')->get();
        $ticket = Ticket::where('ticket_id', $ticket_id)->where('product_id', $product_id)->where('package_id', $package_id)->first();
        $student = Student::where('ic', $ticket->ic)->first();
        
        $new_package = $request->session()->get('ticket');

        if($ticket->ticket_type == 'paid'){

            return view('upgrade_ticket.choose_package', compact('product', 'package', 'current_package', 'student', 'feature', 'ticket', 'new_package'));

        }else{

            return view('upgrade_ticket.no_access');

        }
    }

    public function store_package($product_id, $package_id, $ticket_id, Request $request){
        $validatedData = $request->validate([
            'product_id' => 'required',
            'package_id' => 'required'
        ]);

        if(empty($request->session()->get('ticket'))){
            $new_package = Ticket::where('ticket_id', $ticket_id)->where('product_id', $product_id)->where('package_id', $package_id)->first(); //Update new package upgrade
            $new_package->fill($validatedData);
            $request->session()->put('ticket', $new_package);
        }else{
            $new_package = $request->session()->get('ticket');
            $new_package->fill($validatedData);
            $request->session()->put('ticket', $new_package);
        }

        return redirect('ticket-details/'.  $product_id . '/' . $package_id . '/' . $ticket_id);
    }

    public function ticket_details($product_id, $package_id, $ticket_id, Request $request){

        $product = Product::where('product_id', $product_id)->first();
        $package = Package::where('product_id', $product_id)->get();
        $current_package = Package::where('package_id', $package_id)->first();
        $ticket = Ticket::where('ticket_id', $ticket_id)->where('product_id', $product_id)->where('package_id', $package_id)->first();
        $student = Student::where('ic', $ticket->ic)->first();

        $new_package = $request->session()->get('ticket');

        return view('upgrade_ticket.details', compact('product', 'package', 'current_package', 'student', 'ticket', 'new_package'));
    }

    public function store_details($product_id, $package_id, $ticket_id, Request $request){
        $validatedData = $request->validate([
            'pay_price' => 'required|numeric'
        ]);

        $new_package = $request->session()->get('ticket');
        $new_package->fill($validatedData);
        $request->session()->put('ticket', $new_package);

        return redirect('upgrade-payment/'.  $product_id . '/' . $package_id . '/' . $ticket_id);
    }

    public function upgrade_payment($product_id, $package_id, $ticket_id, Request $request){

        $product = Product::where('product_id', $product_id)->first();
        $package = Package::where('package_id', $package_id)->first();
        $current_package = Package::where('package_id', $package_id)->first();
        $ticket = Ticket::where('ticket_id', $ticket_id)->where('product_id', $product_id)->where('package_id', $package_id)->first();
        $student = Student::where('ic', $ticket->ic)->first();

        $new_package = $request->session()->get('ticket');
        $stripe = 'Debit/Credit Card';
        $billplz = 'FPX';
        
        return view('upgrade_ticket.payment', compact('product', 'package', 'current_package', 'student', 'ticket', 'new_package', 'stripe', 'billplz'));
    }

    public function store_payment($product_id, $package_id, $ticket_id, Request $request){
        $validatedData = $request->validate([
            'pay_method' => 'required',
        ]);

        $new_package = $request->session()->get('ticket');
        $new_package->fill($validatedData);
        $request->session()->put('ticket', $new_package);

        return redirect('payment-option/'.  $product_id . '/' . $package_id . '/' . $ticket_id);
    }

    public function payment_option($product_id, $package_id, $ticket_id, Request $request)
    {
        $product = Product::where('product_id', $product_id)->first();
        $package = Package::where('package_id', $package_id)->first();
        $current_package = Package::where('package_id', $package_id)->first();
        $ticket = Ticket::where('ticket_id', $ticket_id)->where('product_id', $product_id)->where('package_id', $package_id)->first();
        $student = Student::where('ic', $ticket->ic)->first();

        $new_package = $request->session()->get('ticket');
  
        //Check the payment method
        if($new_package->pay_method == 'Debit/Credit Card'){

            return redirect('card-option/'.  $product_id . '/' . $package_id . '/' . $ticket_id );

        }else if($new_package->pay_method == 'FPX'){

            return redirect('billplz-option/'.  $product_id . '/' . $package_id . '/' . $ticket_id );

        }else{

            echo 'Error 404';

        }
    }

    public function card_option($product_id, $package_id, $ticket_id, Request $request){

        $product = Product::where('product_id', $product_id)->first();
        $package = Package::where('package_id', $package_id)->first();
        $current_package = Package::where('package_id', $package_id)->first();
        $ticket = Ticket::where('ticket_id', $ticket_id)->where('product_id', $product_id)->where('package_id', $package_id)->first();
        $student = Student::where('ic', $ticket->ic)->first();

        $new_package = $request->session()->get('ticket');

        return view('upgrade_ticket.use_card', compact('product', 'package', 'current_package', 'student', 'ticket', 'new_package'));
    }

    public function store_stripe($product_id, $package_id, $ticket_id, Request $request)
    {        
        $product = Product::where('product_id', $product_id)->first();
        $package = Package::where('package_id', $package_id)->first();
        $current_package = Package::where('package_id', $package_id)->first();
        $ticket = Ticket::where('ticket_id', $ticket_id)->where('product_id', $product_id)->where('package_id', $package_id)->first();
        $student = Student::where('ic', $ticket->ic)->first();

        $new_package = $request->session()->get('ticket');
        $get_package = $new_package->package_id; //get package name
        $package_name = Package::where('package_id', $get_package)->first();

        /*-- Stripe ---------------------------------------------------------*/
        //Make Payment
        $stripe = Stripe\Stripe::setApiKey('sk_live_B9VWddnqzpICNS9gsPBI4jSc00v60OUVak');

        try {

            // Generate token
            $token = Stripe\Token::create(array(
                "card" => array(
                    "number"    => $request->cardnumber,
                    "exp_month" => $request->month,
                    "exp_year"  => $request->year,
                    "cvc"       => $request->cvc,
                    "name"      => $request->cardholder
                )
            ));

            // If not generate view error
            if (!isset($token['id'])) {

                return redirect()->back()->with('error','Token is not generate correct');
            
            }   else{
    
                // Create a Customer:
                $customer = \Stripe\Customer::create([

                    'name' => $student->first_name,
                    'source' => $token['id'],
                    'email' => $student->email,
                ]);

                // Make a Payment
                Stripe\Charge::create([
                    "currency" => "myr",
                    "description" => "MIMS - " . $package_name->name,
                    "customer" => $customer->id,
                    "amount" => $new_package->pay_price * 100,
                ]);
            }

            $addData = array(
                'status' => 'paid',
                'upgrade_count' => '1',
                'stripe_id' => $customer->id
            );

            $new_package->fill($addData);
            $request->session()->put('ticket', $new_package);

        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
        /*-- End Stripe -----------------------------------------------------*/

        /*-- Manage Email ---------------------------------------------------*/
                
        $send_mail = $student->email;
        $product_name = $product->name;   
        $package_name = $package->name;   
        $date_from = $product->date_from;
        $date_to = $product->date_to;
        $time_from = $product->time_from;
        $time_to = $product->time_to;
        $packageId = $new_package->package_id;
        $productId = $product_id;        
        $student_id = $student->stud_id;
        $survey_form = $product->survey_form;

        $new_package->save();

        dispatch(new UpgradeJob($send_mail, $product_name, $package_name, $date_from, $date_to, $time_from, $time_to, $packageId, $ticket_id, $productId, $student_id, $survey_form));
        
        /*-- End Email -----------------------------------------------------------*/
  
        $request->session()->forget('package');
        $request->session()->forget('ticket');
        
        return redirect('naik-taraf-berjaya');
    }

    public function billplz_option($product_id, $package_id, $ticket_id, Request $request)
    {        
        $product = Product::where('product_id', $product_id)->first();
        $package = Package::where('package_id', $package_id)->first();
        $current_package = Package::where('package_id', $package_id)->first();
        $ticket = Ticket::where('ticket_id', $ticket_id)->where('product_id', $product_id)->where('package_id', $package_id)->first();
        $student = Student::where('ic', $ticket->ic)->first();

        $new_package = $request->session()->get('ticket');
        $get_package = $new_package->package_id; //get package name
        $package_name = Package::where('package_id', $get_package)->first();

        $billplz = Client::make(env('BILLPLZ_API_KEY', '3f78dfad-7997-45e0-8428-9280ba537215'), env('BILLPLZ_X_SIGNATURE', 'S-jtSalzkEawdSZ0Mb0sqmgA'));

        $bill = $billplz->bill();

        $response = $bill->create(
            $product->collection_id,
            $student->email,
            $student->phoneno,
            $student->first_name,
            \Duit\MYR::given($new_package->pay_price * 100),
            'https://mims.momentuminternet.my/redirect-page/'.  $product_id . '/' . $package_id . '/' . $ticket_id,
            $product->name . ' - ' . $package_name->name,
            ['redirect_url' => 'https://mims.momentuminternet.my/redirect-page/'.  $product_id . '/' . $package_id . '/' . $ticket_id]
        );

        $pay_data = $response->toArray();
        
        $addData = array(
            'upgrade_count' => '1',
            'billplz_id' => $pay_data['id']
        );

        $new_package->fill($addData);
        $request->session()->put('ticket', $new_package);

        return redirect($pay_data['url']);
    }

    public function redirect_page($product_id, $package_id, $ticket_id, Request $request)
    {
        $new_package = $request->session()->get('ticket');
        
        $billplz = Client::make(env('BILLPLZ_API_KEY', '3f78dfad-7997-45e0-8428-9280ba537215'), env('BILLPLZ_X_SIGNATURE', 'S-jtSalzkEawdSZ0Mb0sqmgA'));

        $bill = $billplz->bill();
        $response = $bill->get($new_package->billplz_id);
        $pay_data = $response->toArray();

        $addData = array(
            'status' => $pay_data['state']
        );

        $new_package->fill($addData);
        $request->session()->put('ticket', $new_package);

        if ($new_package->status == 'paid')
        {
            /*-- Manage Email ---------------------------------------------------*/

            $product = Product::where('product_id', $new_package->product_id)->first();
            $package = Package::where('package_id', $new_package->package_id)->first();
            $student = Student::where('ic', $new_package->ic)->first();  
            
            $send_mail = $student->email;
            $product_name = $product->name;   
            $package_name = $package->name;       
            $date_from = $product->date_from;
            $date_to = $product->date_to;
            $time_from = $product->time_from;
            $time_to = $product->time_to;
            $packageId = $package_id;
            $productId = $product_id;        
            $stud_id = $student->stud_id;
            $survey_form = $product->survey_form;

            $new_package->save();

            dispatch(new UpgradeJob($send_mail, $product_name, $package_name, $date_from, $date_to, $time_from, $time_to, $packageId, $ticket_id, $productId, $stud_id, $survey_form));
            
            /*-- End Email -----------------------------------------------------------*/
    
            $request->session()->forget('student');
            $request->session()->forget('ticket');

            return redirect('naik-taraf-berjaya');  

        } else {

            $new_package->save();
    
            $request->session()->forget('student');
            $request->session()->forget('ticket');

            return redirect('pendaftaran-tidak-berjaya');
            
        }
        
    }

    public function success_upgrade()
    {
        return view('upgrade.thankyou_upgrade');
    }
}
