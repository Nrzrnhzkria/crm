<?php

namespace App\Http\Controllers;

use PDF;
use App\Exports\StatementMembership;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Student;
use App\Product;
use App\Package;
use App\Payment;
use App\Ticket;
use App\Membership;
use App\Offer;
use App\Membership_Level;
use App\Comment;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\User;
use App\StudentStaff;
use App\BussinessDetail;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Services\Billplz;
use App\Invoice;
use App\UserChatModel;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Factory;

class StudentPortal extends Controller
{
    // Lepas login akan ke dashboard
    public function index()
    {
        if(Session::get('student_login_id')){

			return redirect("studentportal.dashboard");

		}else{

			return redirect('/student/login');
		}
    }

    public function redirectLogin()
    {
        $student_authenticated = session('student_login_id');

        if($student_authenticated == (null||"")){

            return redirect('/student/login');

        }else{

            return redirect(route("student.dashboard"));
        }
    }

    // login form
    public function loginForm(Request $request)
    {
        return view("studentportal.login");
    }


    public function registerForm() 
    {
        $student_id = Session::get("student_login_id");
        return view("studentportal.bussiness-form", compact('student_id'));
    }

    public function bussinessForm(Request $request) 
    {
        if($request->filled('income') && $request->filled('bussiness')) {
            
            $bussInsert = BussinessDetail::create([
                'student_id' => Session::get("student_login_id"),
                'training_course_id' => 'TEST123',
                'bussiness_type' => $request->bussiness,
                'monthly_income' => $request->income
            ]);

            if($bussInsert) 
            {

                return redirect()->route('student.regForm')->with('success','Success.');

            }else{

                return redirect()->route('student.regForm')->with('error','Problem on inserting data.');

            }

        }else{

            return redirect()->route('student.regForm')->with('error','Problem on inserting data.');
        }
    }

    // authenticated login request
    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // dd(Hash::make('password'));

        $student_detail = Student::where('email', '=',$validatedData['email'])->first();
        $student_chat = UserChatModel::where('stud_id', '=', $student_detail->stud_id)->first();

        // Kalau emel takde, pergi ke student login semula
        if($student_detail == (null || ""))
        {
            Session::put("student_login", "fail");

            return redirect('/student/login');

        // tak perlu sign in kalau dah pernah sign in
        }else if(Session::has('student_login_id')){

            return redirect(route('student.dashboard'));
        
        }else{

            $stud_id = $student_detail->stud_id;

            // semak password
            if (Hash::check($validatedData['password'], $student_detail->student_password)) 
            {

                // if student tak aktif
				if($student_detail->status == 'Deactive')
                {

                    Session::put("student_block", "fail");

                    return view("studentportal.login");
                
                // student yang takde level
                }elseif($student_detail->level_id == null || ""){

                    Session::forget("student_block", "success");
                    Session::put("student_block", "not membership");

                    return view("studentportal.login");

                // if student active
                }else{

                    if($student_chat == null){

                        $userChat = new UserChatModel();

                        $userChat->name = $student_detail->first_name.$student_detail->last_name;
                        $userChat->phone = $student_detail->phoneno;
                        $userChat->email = $student_detail->email;
                        $userChat->stud_id = $student_detail->stud_id;
                        $userChat->topic_id = "0";
                        $userChat->user_id = "0";
                        $userChat->notes = "0";
                        $userChat->channel = 'UID' . uniqid() . uniqid();

                        $userChat->save();
                        Session::put("chat_channel", $userChat->channel);

                    }else{

                        Session::put("chat_channel", $student_chat->channel);

                    }

                    Session::put('student_login_id', $stud_id);
                    Session::put('student_detail', $student_detail);
                    Session::put("student_block", "success");
                    // Session::put('payment_id',$payment_id);
                    Session::save();

                    Session::forget('student_login');
                    Session::forget('student_block');
                    
                    return redirect('/student/dashboard');
                }
            
            // Kalau password salah pergi ke login
            }else{

                Session::put("student_login", "fail");

                return redirect('/student/login');
            }
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->session()->flush();

        return redirect("student/login");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        Session::forget('successful_reset');
        Session::save();
        $student_authenticated = session('student_login_id');

        if($student_authenticated == (null||"")){

            return redirect('/student/login');

        }else{

            $invoices = Invoice::where('student_id', $student_authenticated)->get();

            $stud_id = Session::get('student_login_id');

            $student_detail = Student::where('stud_id', $student_authenticated)->firstOrFail();
    
            $member_lvl = Membership_Level::where('level_id', $student_detail->level_id)->first()->name;

            $membership_level = Membership_Level::where('level_id', $student_detail->level_id)->first();
            /*
            |--------------------------------------------------------------------------
            | Comment Section
            |--------------------------------------------------------------------------
            */

            $comment = Comment::where('stud_id', $student_authenticated)->get();
            $ncomment = [];
            if(count($comment) != 0) {
                foreach($comment as $c) {
                    $name = User::where('user_id', $c->add_user);
    
                    if($name->count() > 0) {
                        $name = $name->first();
                        $c->author = $name->name;
                    }else{
                        $c->author = "";
                    }
                    
                    $ncomment[] = $c;
                }
            }
    
            /*
            |--------------------------------------------------------------------------
            | Monthly payment
            |--------------------------------------------------------------------------
            */

            $paymentMonth = Payment::where('stud_id', $student_authenticated)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('status', 'paid')->get();
            $total_paid_month = 0;
            if(count($paymentMonth) != 0) {
                foreach($paymentMonth as $pm) {
                    $total_paid_month += (int)$pm->pay_price;
                }
            }
            
            /*
            |--------------------------------------------------------------------------
            | Overall payment
            |--------------------------------------------------------------------------
            */

            $payment = Payment::where('stud_id', $student_authenticated)->where('status', 'paid')->orderBy('created_at', 'DESC')->get();
            $total_paid = 0;
            if(count($payment) != 0) {
                foreach($payment as $p) {
                    $total_paid += (int)$p->pay_price;
                }
            }
            
            $payment_data = [];
            $type = [];
    
            foreach($payment as $pt) {
                if($pt->product_id != (null || '')){
                    $product1 = Product::where('product_id', $pt->product_id);
    
                    if($product1->count() > 0){
                        $product1 = $product1->first();
                        $payment_data[] = $product1;
                        $type[] = 'Event';
                    }

                }elseif($pt->level_id != (null || '')){
                    $level1 = Membership_Level::where('level_id', $pt->level_id);
    
                    if($level1->count() > 0){
                        $level1 = $level1->first();
                        $payment_data[] = $level1;
                        $type[] = 'Membership';
                    }
                }
            }
            
            /*
            |--------------------------------------------------------------------------
            | Display timeline
            | Display total ticket
            |--------------------------------------------------------------------------
            */
            $ticket = Ticket::where('ic', $student_detail['ic'])->get();

            // Total Event
            $total_event = count($ticket);
            $data = [];
            
            // Timeline
            foreach($ticket as $t) {
                $product = Product::where('product_id', $t->product_id);
    
                if($product->count() > 0){
                    $product = $product->first();
                    $data[] = $product;
                }
            }
    
            return view('studentportal.dashboard', compact( 'stud_id','student_detail', 'payment', 'data', 'total_paid', 'total_event', 'member_lvl', 'membership_level', 'total_paid_month', 'payment_data', 'ncomment', 'type'));
           
        }
    }

    // form check current password
    public function showCheckPassword()
    {   
        if (Session::get('student_login_id')) {

            return view("studentportal.checkCurrentPassword");

        } else {

            return redirect("student/login");

        }

    }

    // Request reset password
    public function checkCurrentPassword(Request $request)
    {

        $validatedData = $request->validate([
            'password' => 'required',
        ]);

        $stud_id = Session::get('student_login_id');

        $student_detail = Student::where('stud_id', '=',$stud_id)->first();

        if (Hash::check($validatedData['password'], $student_detail->student_password)) {
            
            Session::forget('check_current_password');
            Session::save();

            return redirect('/student/form-reset-password');

        }else{
            
            Session::put("check_current_password", "fail");
            
            return view("studentportal.checkCurrentPassword");
        }
    }

    // display form reset password
    public function showResetPassword()
    {
        if (Session::get('student_login_id')) {

            return view("studentportal.formResetPassword");

        } else {

            return redirect("student/login");

        }

    }

    // request reset password
    public function resetPassword(Request $request)
    {
        $stud_id = Session::get('student_login_id');

        $student_detail = Student::where('stud_id', '=',$stud_id)->first();

        $validatedData = $request->validate([
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);

        if (Hash::check($validatedData['new_password'], $student_detail->student_password)) 
        {
            
            Session::put("same_password", "fail");

            return redirect('/student/form-reset-password');

        }else{

            $student_detail->student_password = Hash::make($validatedData['new_password']);
            $student_detail->save();

            Session::forget('same_password');
            Session::save();
            Session::forget('success_check');
            Session::save();
            Session::put("successful_reset", "success");
            
            return redirect('/student/form-reset-password');
        }
        
    }

    // reset password at login
    public function resetPasswordForm()
    {
        return view('studentportal.resetpassword');
    }

    // request reset new password
    public function resetnewpassword(Request $request)
    {
        $student_detail = Student::where('email', $request->email)->first();

        $validatedData = $request->validate([
            'email' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);

        if (Hash::check($validatedData['new_password'], $student_detail->student_password)) {

            // Session::put("same_password", "fail");

            return redirect('/student/login/reset-password')->with('error', 'Password cannot same with old password');

        } else {

            $student_detail->student_password = Hash::make($validatedData['new_password']);
            $student_detail->save();

            // Session::forget('same_password');
            // Session::save();
            // Session::forget('success_check');
            // Session::save();
            // Session::put("successful_reset", "success");

            return redirect('/student/login/reset-password')->with('success', 'Password successfully updated');

        }

    }

    // List not paid invoices
    public function listInvoice()
    {

        $stud_id = Session::get('student_login_id');
        $stud_detail = Session::get('student_detail');
       
        if($stud_id== (null||"")){

            return redirect('/student/login');
            
        }else{

            $invoices = Invoice::where('student_id', $stud_detail->id)->where('status', 'not paid')->paginate(10);

            //dapatkan membership_id student
            $membership_lvl_id = $stud_detail->level_id;

            //dapatkan membership detail
            $membership_level = Membership_Level::where('level_id', $membership_lvl_id)->first();

            $no = 1;

            return view('invoice.listInvoice', compact('stud_detail', 'membership_level', 'invoices', 'no'));
        }
    }

    public function searchInvoice(Request $request)
    {

        $query = $request->search;

        $stud_id = Session::get('student_login_id');
        $stud_detail = Session::get('student_detail');

        if($stud_id== (null||"")){

            return redirect('/student/login');

        }else{

            $invoices = Invoice::where('student_id', $stud_detail->id)
            ->where('status', 'not paid')
            ->where('for_date', 'LIKE','%'.$query.'%')
            ->paginate(10);

            //dapatkan membership_id student
            $membership_lvl_id = $stud_detail->level_id;

            //dapatkan membership detail
            $membership_level = Membership_Level::where('level_id', $membership_lvl_id)->first();
            // dd($membership_level);

            $no = 1;

            return view('invoice.listInvoice', compact('stud_detail', 'membership_level', 'invoices', 'no','payment'));
        }
    }

    public function linkBill($level, $invoice, $student)
    {

        $stud_detail = Student::where('stud_id', $student)->first();
        $lvl_detail = Membership_Level::where('level_id', $level)->first();

        // Test Link
        // $link = Billplz::test_create_bill($stud_detail, $lvl_detail, $invoice)->url;

        // Ultimate Plus
        if($level == 'MBL001')
        {
            // $ultimate_plus_link = Billplz::ultimateplus($stud_detail, $lvl_detail, $invoice)->url;

            // return redirect($ultimate_plus_link);

            $test_link = Billplz::test_create_bill($stud_detail, $lvl_detail, $invoice)->url;

            return redirect($test_link);

        // Ultimate Partner
        }elseif ($level == 'MBL002') {
            
            // $ultimate_partner_link = Billplz::ultimatepartner($stud_detail, $lvl_detail, $invoice)->url;

            // return redirect($ultimate_partner_link);

            $test_link = Billplz::test_create_bill($stud_detail, $lvl_detail, $invoice)->url;

            return redirect($test_link);
            

        // Platinum Pro
        }elseif ($level == 'MBL003') {

            // $platinum_pro_link = Billplz::platinumpro($stud_detail, $lvl_detail, $invoice)->url;

            // return redirect($platinum_pro_link);

            $test_link = Billplz::test_create_bill($stud_detail, $lvl_detail, $invoice)->url;

            return redirect($test_link);

    
        // Platinum Lite
        }elseif ($level == 'MBL004') {

            // $platinum_lite_link = Billplz::platinumlite($stud_detail, $lvl_detail, $invoice)->url;

            // return redirect($platinum_lite_link);

            $test_link = Billplz::test_create_bill($stud_detail, $lvl_detail, $invoice)->url;

            return redirect($test_link);

    
        }
        
        //real
        // $link = Billplz::create_bill($stud_detail, $lvl_detail, $invoice)->url;
    }

    public function receivePayment(Request $request, $stud, $level, $invoice){

        $billplz = $request->billplz;

        $stud_detail = Student::where('stud_id', $stud)->first();
        $lvl_detail = Membership_Level::where('level_id', $level)->first();

        $payment = new Payment();
        $payment->payment_id = 'OD'.uniqid();
        $payment->pay_price = $lvl_detail->price;
        $payment->totalprice = $lvl_detail->price;
        $payment->quantity = 1;
        $payment->pay_method = 'transfer online';
        $payment->email_status = 'sent';
        $payment->stud_id = $stud_detail->stud_id;
        $payment->offer_id = '';
        $payment->membership_id = $lvl_detail->membership_id;
        $payment->level_id = $lvl_detail->level_id;
        $payment->billplz_id = $billplz['id'];
        $payment->invoiceId = $invoice;

        // dd($billplz['paid']);

        if($billplz['paid'] == "true")
        {
            $payment->status = 'paid';
            $payment->save();

            $invoiceDetail = Invoice::where('invoice_id',$invoice)->first();
            $invoice = Invoice::find($invoiceDetail->id);
            $invoice->status = 'paid';
            $invoice->save();

            return redirect('student/success_payment');

        }else{

            $payment->status = 'due';
            $payment->save();

            return redirect('student/fail_payment');
        }
    }

    // shauqi edit
    // public function showLink() {
        // $offers = Offer::orderBy('id','desc')->get();
        // $product = Product::orderBy('id','desc')->paginate(15);
        
        // return view('studentportal.event_links', compact('offers', 'product'));
    // }

    // public function linkDetail(Request $request, $product_id) {
        // $product = Product::where('product_id', $product_id)->first();
        // $package = Package::where('product_id', $product_id)->paginate(15);
        
        // $link = request()->getSchemeAndHttpHost().'/pendaftaran/'. $product->product_id . '/';

        // return view('studentportal.link_detail', compact('product', 'package', 'link'));   
    // }

    public function showList() {
		$payment = StudentStaff::where('student_invite_id', Session::get('student_login_id'))->paginate(10);
        $count = count($payment);
		
		return view('studentportal.inviteList', compact('payment', 'count'));
    }

    //add new download statement of account
    public function exportstatement_format()
    {
        $stud_id = Session::get('student_login_id');
        $stud_detail = Session::get('student_detail');
        

        if($stud_id== (null||"")){

            return redirect('/student/login');
            
        }else{

            //dapatkan membership_id student
            $invoice_student = $stud_detail->id;
            $member_student = $stud_detail->level_id;
            $student_id = $stud_detail->student_id;

            // connect ke database melalui table student
            $payment_id_student = Payment::where('level_id', $member_student)->first();
            $invoice_id_student = Invoice::where('student_id', $invoice_student)->first();
            $member = Membership_level::where('level_id', $member_student)->first();
            $date = Invoice::where('student_id', $invoice_student)->pluck('for_date');

            // dapatkan total table
            $balance_due = Invoice::where('student_id', $invoice_student)->where('status', 'not paid')->sum('price');
            $amount_received = Invoice::where('student_id', $invoice_student)->where('status', 'paid')->sum('price');
            $invoice_amount = Invoice::where('student_id', $invoice_student)->where('status','not paid')->sum('price');

            // formula due date
            $date_receive = date('d-m-Y');
            $daystosum = '7';
            $datesum = date('d-m-Y', strtotime($date_receive.' + '.$daystosum.' days'));

            // calculation
            $balance = ($invoice_id_student->price)-($payment_id_student->pay_price);

            // details of customer
            $data['name']=$stud_detail->first_name; //
            $data['secondname']=$stud_detail->last_name; //
            $data['date_receive']=date('d-m-Y');
            $data['membership']=$member->name;
        
            // invoice
            $data['invoice']=Invoice::where('student_id', $invoice_student)->get(); //
            $data['sumprice']=Invoice::where('student_id', $invoice_student)->get();
            $data['invoice_amount'] = $invoice_amount; //

            // payment
            $data['payment']=Payment::where('level_id', $member_student)->get();
            $data['price']=$payment_id_student->pay_price; //
            $data['total']=$payment_id_student->totalprice; //
            $data['quantity']=$payment_id_student->quantity;
            $data['upgrade_count']=$payment_id_student->upgrade_count;
            $data['amount_received'] = $amount_received; //
            $data['payment_id']=$payment_id_student;  
            
            // balance 
            $data['balance_due'] = $balance_due; //
            $data['balance']=$balance; //

            $pdf = PDF::loadView('emails.statement', $data);
            return $pdf->download( 'Statement.pdf' );
            
        }
    }

    //download invoice
    public function downloadInvoice($level, $invoice, $student)
    {

        $stud_id = Session::get('student_login_id');
        $stud_detail = Session::get('student_detail');
        

        if($stud_id== (null||"")){

            return redirect('/student/login');
            
        }else{

            // connect ke database melalui table student
            $payment_student_id = $stud_detail->level_id;
            $invoice_student = $stud_detail->id;
            $member_student = $stud_detail->level_id;

            $level_id = $level;
            $member_student = $student;

            $payment_id_student = Payment::where('level_id', $level)->first();
            $member = Membership_level::where('level_id', $level)->first();
            $invoice_id = Invoice::where('student_id', $member_student)->where('invoice_id', $invoice)->first();
            $inv = Invoice::where('student_id', $student)->where('invoice_id', $invoice)->first();
            $balance = ($payment_id_student->totalprice)-($payment_id_student->pay_price);

            //calculation for taxes ultimate
            $subtotal = (($inv->price)+($member->add_on_price));

            // due date format
            $date_receive = date('d-m-Y');
            $daystosum = '7';
            $datesum = date('d-m-Y', strtotime($date_receive.' + '.$daystosum.' days'));

            $no = 1;
            
            $data['subtotal'] = $subtotal;
            $data['balance'] = $balance;
            $data['member'] = $member; // 
            $data['inv'] = $inv; // 
            $data['name'] = $stud_detail->first_name; //
            $data['secondname'] = $stud_detail->last_name; //
            $data['invoice'] = $invoice_id->invoice_id; //
            $data['no'] = $invoice_id->id; //

            $data['price'] = $payment_id_student->pay_price; //
            $data['quantity'] = $payment_id_student->quantity; //

            $data['date_receive'] = date('d-m-Y'); //
            $data['bulan'] = date('M Y'); //
            $data['datesum'] = $datesum; //

            $data['membership'] = $member->name; //

            $pdf = PDF::loadView('emails.downloadinvoice', $data)->setPaper('a4');
            return $pdf->download('Invoice.pdf');
            
        }
    }

    //download receipt
    public function downloadResit($level, $payment, $student){

        $stud_id = Session::get('student_login_id');
        $stud_detail = Session::get('student_detail');
        

        if($stud_id== (null||"")){

            return redirect('/student/login');
            
        }else{

            $payment_student_id = $stud_detail->level_id;
            $invoice_student = $stud_detail->id;
            $member_student = $stud_detail->level_id;

            $level_id = $level;
            $invoice_student = $stud_detail->id;
            $member_student = $student;

            //testing dari downloadinvoice
            $payment_id_student = Payment::where('payment_id', $payment)->first();
            $member = Membership_level::where('level_id', $level_id)->first();
            $invoice_id = Invoice::where('student_id', $stud_detail->id)->first();
            $receipt = Payment::where('payment_id',$payment)->first();
            $inv = Invoice::where('invoice_id', $invoice_id)->first();
            $membership_level = Membership_Level::where('membership_id', $level)->where('level_id', $level_id)->first();

            // $inv = Invoice::where('student_id', $invoice_student)->where('status', 'not paid')->first();

            //dapatkan membership_id student
            $payment_student_id = $stud_detail->level_id;
            $invoice_student = $stud_detail->id;
            $member_student = $stud_detail->level_id;

            $payment_id_student = Payment::where('level_id', $payment_student_id)->first();
            $payment = Payment::where('payment_id', $payment)->first();
            $invoice_id = Invoice::where('student_id', $invoice_student)->first();
            $member = Membership_level::where('level_id', $member_student)->first();

            $no = 1;

            $balance = ($payment_id_student->totalprice)-($payment_id_student->pay_price);

            // add
            $data['receipt'] = $receipt;
            $data['name']=$stud_detail->first_name;
            $data['secondname']=$stud_detail->last_name;
            $data['ic']=$stud_detail->ic;
            $data['email']=$stud_detail->email;
            $data['phoneno']=$stud_detail->phoneno;
        
            $data['invoice']=Invoice::where('student_id', $invoice_student)->get();
            $data['paymentinv']=$payment->invoiceId;
            

            $data['date']=$invoice_id->for_date;
            $data['no']=$invoice_id->id;
            $data['invid']=$invoice_id->invoice_id;

            $data['price']=$payment_id_student->pay_price;
            $data['total']=$payment_id_student->totalprice;
            $data['pay_id']=$payment_id_student->payment_id;
            $data['method']=$payment_id_student->pay_method;
            $data['billplz']=$payment_id_student->billplz_id;

            $data['balance']=$balance;

            $data['quantity']=$payment_id_student->quantity;
            $data['upgrade_count']=$payment_id_student->upgrade_count;

            $data['date_receive']=$payment_id_student->created_at;
            $data['due_date']=date('d-m-Y');
            $data['bulan']=date('M Y');

            $data['payment_id']=$payment_id_student;       
            $data['student_id']=$stud_id;

            $data['membership']=$member->name;

            $pdf = PDF::loadView('emails.resitmember', $data);
            return $pdf->download('Receipt.pdf');
            
        }
    }

    // Dashboard Invoices & Receipt
    public function invoicesAndreceipt()
    {   
        $stud_id = Session::get('student_login_id');
        

        if($stud_id== (null||"")){

            return redirect('/student/login');

        }else{

            return view('studentportal.invoicesandreceipt');

        }
    }

    public function invoices()
    {
        $stud_id = Session::get('student_login_id');
        $stud_detail = Session::get('student_detail');

        if ($stud_id == (null || "")) {

            return redirect('/student/login');

        } else {

            // keluarkan senarai invois
            $invoices = Invoice::where('student_id', $stud_detail->id)->paginate(10);

            //dapatkan membership_id student
            $membership_lvl_id = $stud_detail->level_id;

            //dapatkan membership detail
            $membership_level = Membership_Level::where('level_id', $membership_lvl_id)->first();

            $no = 1;

            $date_receive = date('d-m-Y');
            $daystosum = '7';
            $datesum = date('d-m-Y', strtotime($date_receive.' + '.$daystosum.' days'));

            return view('studentportal.invoicesreceipt.invoices', compact('stud_detail', 'membership_level', 'invoices', 'no', 'datesum', 'date_receive', 'daystosum'));
        }
    }

    public function receipt()
    {
        $stud_id = Session::get('student_login_id');
        $stud_detail = Session::get('student_detail');

        if($stud_id == (null||"")) {

            return redirect('/student/login');

        }else{

            $payment = Payment::where('stud_id', $stud_detail->stud_id)->where('status', 'paid')->orderBy('created_at', 'DESC')->paginate(10);
            $membership_level = Membership_level::where('level_id', $stud_detail->level_id)->first();
            $student = Student::where('stud_id', $stud_detail->stud_id)->first();

            $payment_data = [];
            $type = [];

            foreach ($payment as $pt) {
                if ($pt->product_id != (null || '')) {
                    $product1 = Product::where('product_id', $pt->product_id);

                    if ($product1->count() > 0) {
                        $product1 = $product1->first();
                        $payment_data[] = $product1;
                        $type[] = 'Event';
                    }

                } elseif ($pt->level_id != (null || '')) {
                    $level1 = Membership_Level::where('level_id', $pt->level_id);

                    if ($level1->count() > 0) {
                        $level1 = $level1->first();
                        $payment_data[] = $level1;
                        $type[] = 'Membership';
                    }
                }
            }

            return view('studentportal.invoicesreceipt.receipt', compact('student','stud_detail','payment','payment_data','type','membership_level'));
        }
    }

    // Others function
    public function paginate($items, $perPage, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
