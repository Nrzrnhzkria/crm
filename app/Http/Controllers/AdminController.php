<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Role;
use App\Permission;
use App\Student;
use App\Payment;
use App\Product;
use App\Package;
use App\Ticket;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | AdminController
    |--------------------------------------------------------------------------
    |   This controller is for managing user, role and dashboard
    | 
    */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /*-- Dashboard --------------------------------------------------------*/
    public function dashboard(Request $request){      
        
        // get date and time
        $date_today = Carbon::now('Asia/Kuala_Lumpur')->format('d-m-Y');
        $current_time = Carbon::now('Asia/Kuala_Lumpur')->format('h:i a');
        $time = Carbon::now('Asia/Kuala_Lumpur')->format('H:i');
        
        // show the duration of current 2 hours
        // the $time is +1 hour from the duration
        if ($time < "08:10") {

            $from = date('Y-m-d 16:00:00');
            $to = date('Y-m-d 23:59:59');
            $duration = "12 am - 8 am"; 
            $greetings = "Good Morning!";

        } elseif ($time >= "08:10" && $time < "09:10") {

            $from = date('Y-m-d 00:00:00');
            $to = date('Y-m-d 00:59:59');
            $duration = "8 am - 9 am"; 
            $greetings = "Good Morning!";

        } elseif ($time >= "09:10" && $time < "10:10") {

            $from = date('Y-m-d 01:00:00');
            $to = date('Y-m-d 01:59:59');
            $duration = "9 am - 10 am"; 
            $greetings = "Good Morning!";

        } elseif ($time >= "10:10" && $time < "11:10") {

            $from = date('Y-m-d 02:00:00');
            $to = date('Y-m-d 02:59:59');
            $duration = "10 am - 11 am"; 
            $greetings = "Good Morning!";

        } elseif ($time >= "11:10" && $time < "12:10") {

            $from = date('Y-m-d 03:00:00');
            $to = date('Y-m-d 03:59:59');
            $duration = "11 am - 12 pm"; 
            $greetings = "Good Morning!";

        } elseif ($time >= "12:10" && $time < "13:10") {

            $from = date('Y-m-d 04:00:00');
            $to = date('Y-m-d 04:59:59');
            $duration = "12 pm - 1 pm"; 
            $greetings = "Good Afternoon!";

        } elseif ($time >= "13:10" && $time < "14:10") {

            $from = date('Y-m-d 05:00:00');
            $to = date('Y-m-d 05:59:59');
            $duration = "1 pm - 2 pm"; 
            $greetings = "Good Afternoon!";

        } elseif ($time >= "14:10" && $time < "15:10") {

            $from = date('Y-m-d 06:00:00');
            $to = date('Y-m-d 06:59:59');
            $duration = "2 pm - 3 pm"; 
            $greetings = "Good Afternoon!";

        } elseif ($time >= "15:10" && $time < "16:10") {

            $from = date('Y-m-d 07:00:00');
            $to = date('Y-m-d 07:59:59');
            $duration = "3 pm - 4 pm"; 
            $greetings = "Good Evening!";

        } elseif ($time >= "16:10" && $time < "17:10") {

            $from = date('Y-m-d 08:00:00');
            $to = date('Y-m-d 08:59:59');
            $duration = "4 pm - 5 pm"; 
            $greetings = "Good Evening!";

        } elseif ($time >= "17:10" && $time < "18:10") {

            $from = date('Y-m-d 09:00:00');
            $to = date('Y-m-d 09:59:59');
            $duration = "5 pm - 6 pm"; 
            $greetings = "Good Evening!";

        } elseif ($time >= "18:10" && $time < "19:10") {

            $from = date('Y-m-d 10:00:00');
            $to = date('Y-m-d 10:59:59');
            $duration = "6 pm - 7 pm"; 
            $greetings = "Good Evening!";

        } elseif ($time >= "19:10" && $time < "20:10") {

            $from = date('Y-m-d 11:00:00');
            $to = date('Y-m-d 11:59:59');
            $duration = "7 pm - 8 pm"; 
            $greetings = "Good Evening!";
            
        } elseif ($time >= "20:10" && $time < "21:10") {

            $from = date('Y-m-d 12:00:00');
            $to = date('Y-m-d 12:59:59');
            $duration = "8 pm - 9 pm"; 
            $greetings = "Good Evening!";
            
        } elseif ($time >= "21:10" && $time < "22:10") {

            $from = date('Y-m-d 13:00:00');
            $to = date('Y-m-d 13:59:59');
            $duration = "9 pm - 10 pm"; 
            $greetings = "Good Evening!";

        } elseif ($time >= "22:10" && $time < "23:10") {

            $from = date('Y-m-d 14:00:00');
            $to = date('Y-m-d 14:59:59');
            $duration = "10 pm - 11 pm"; 
            $greetings = "Good Evening!";

        } elseif ($time >= "23:10" && $time <= "00:00") {

            $from = date('Y-m-d 15:00:00');
            $to = date('Y-m-d 15:59:59');
            $duration = "11 pm - 12 am";
            $greetings = "Good Evening!";

        } else {

            $from = date('Y-m-d 15:00:00');
            $to = date('Y-m-d 15:59:59');
            $duration = "11 pm - 12 am";
            $greetings = "Good Evening!";

        }

        // get product id
        $product = Product::where('status', 'active')->first();
        $product_id = $product->product_id;

        // get package
        $package = Package::where('product_id', $product_id)->get();
        $count_package = Package::where('product_id', $product_id)->count();

        for ($i = 0; $i < $count_package; $i++)
        {

            // get report by 2 hours
            $registration[$i] = Payment::where('status','paid')->where('product_id', $product_id)->where('package_id', $package[$i]->package_id)->whereBetween('created_at', [ $from , $to ])->count();
            $paidticket[$i] = Ticket::where('ticket_type', 'paid')->where('product_id', $product_id)->where('package_id', $package[$i]->package_id)->whereBetween('created_at', [ $from , $to ])->count();
            $freeticket[$i] = Ticket::where('ticket_type', 'free')->where('product_id', $product_id)->where('package_id', $package[$i]->package_id)->whereBetween('created_at', [ $from , $to ])->count();
            
            // get total registration
            $totalpackage[$i] = Payment::where('status','paid')->where('product_id', $product_id)->where('package_id', $package[$i]->package_id)->count();

            // get total collection
            $collection[$i] = Payment::where('status','paid')->where('product_id', $product_id)->where('package_id', $package[$i]->package_id)->sum('totalprice');
            
        }
        
        // get the total 
        $total_yesterday = Payment::where('product_id', $product_id)->where('status', 'paid')->whereBetween('created_at', [ date('Y-m-d 00:00:00', strtotime("-1 day")) , date('Y-m-d 23:59:59', strtotime("-1 day")) ])->count();
        $total_now = Payment::where('product_id', $product_id)->where('status', 'paid')->whereBetween('created_at', [ date('Y-m-d 00:00:00') , date('Y-m-d H:i:s') ])->count();
        
        $totalregister = Payment::where('status','paid')->where('product_id', $product_id)->count();
        $totalpaid = Ticket::where('ticket_type', 'paid')->where('product_id', $product_id)->count();
        $totalfree = Ticket::where('ticket_type', 'free')->where('product_id', $product_id)->count();
        $totalticket = Ticket::where('product_id', $product_id)->count();        
        $pendingticket = $totalregister - $totalpaid;
        $totalcollection = Payment::where('status','paid')->where('product_id', $product_id)->sum('totalprice');

        //getting report for each day
        $mon = Payment::where('product_id', $product_id)->where('status', 'paid')->whereBetween('created_at', [ date('Y-m-d 00:00:00', strtotime('monday this week')) , date('Y-m-d 23:59:59', strtotime('monday this week')) ])->count();
        $fri = Payment::where('product_id', $product_id)->where('status', 'paid')->whereBetween('created_at', [ date('Y-m-d 00:00:00', strtotime('friday this week')) , date('Y-m-d 23:59:59', strtotime('friday this week')) ])->count();
        $sat = Payment::where('product_id', $product_id)->where('status', 'paid')->whereBetween('created_at', [ date('Y-m-d 00:00:00', strtotime('saturday this week')) , date('Y-m-d 23:59:59', strtotime('saturday this week')) ])->count();
        $sun = Payment::where('product_id', $product_id)->where('status', 'paid')->whereBetween('created_at', [ date('Y-m-d 00:00:00', strtotime('sunday this week')) , date('Y-m-d 23:59:59', strtotime('sunday this week')) ])->count();
        $thu = Payment::where('product_id', $product_id)->where('status', 'paid')->whereBetween('created_at', [ date('Y-m-d 00:00:00', strtotime('thursday this week')) , date('Y-m-d 23:59:59', strtotime('thursday this week')) ])->count();
        $wed = Payment::where('product_id', $product_id)->where('status', 'paid')->whereBetween('created_at', [ date('Y-m-d 00:00:00', strtotime('wednesday this week')) , date('Y-m-d 23:59:59', strtotime('wednesday this week')) ])->count();
        $tue = Payment::where('product_id', $product_id)->where('status', 'paid')->whereBetween('created_at', [ date('Y-m-d 00:00:00', strtotime('tuesday this week')) , date('Y-m-d 23:59:59', strtotime('tuesday this week')) ])->count();
       
        // // check duplicate student data --------------------------------//
        // $users = Student::whereIn('stud_id', function ( $query ) {
        //     $query->select('stud_id')->from('student')->groupBy('stud_id')->havingRaw('count(*) > 1');
        // })->orderBy('id','Desc')->get();

        // foreach ($users as $user) 
        // {
        //     echo $user->stud_id . "<br>";
        // }

        // // check duplicate payment data --------------------------------//
        // $users = Payment::whereIn('payment_id', function ( $query ) {
        //     $query->select('payment_id')->from('payment')->groupBy('payment_id')->havingRaw('count(*) > 1');
        // })->orderBy('id','Desc')->get();

        // foreach ($users as $user) 
        // {
        //     echo $user->payment_id . "<br>";
        // }
        
        return view('admin.dashboard', compact('product', 'package', 'count_package', 'date_today', 'current_time', 'from', 'to', 'duration', 'greetings', 'totalregister', 'totalpaid', 'totalfree', 'totalticket', 'total_now', 'total_yesterday', 'registration', 'paidticket', 'freeticket', 'totalpackage', 'pendingticket', 'collection', 'totalcollection', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'));
    }

    /*-- Manage User --------------------------------------------------------*/
    public function manage()
    {
        $users = User::orderBy('id', 'asc')->paginate(15);
        $roles = Role::orderBy('id','asc')->get();
        return view('admin.manageuser', compact('users','roles'));
        
    }

    public function create()
    {
        $roles = Role::orderBy('id','asc')->paginate(10);
        return view('admin.adduser', compact('roles'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $request)
    {
        return Validator::make($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function adduser(Request $request)
    {
        $user = User::orderBy('id','desc')->first();

        $auto_inc_user = $user->id + 1;
        $userId = 'UID' . 0 . 0 . $auto_inc_user;

        User::create(array(
            'user_id'=> $userId,
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role_id' => $request['optradio'],
            
        ));

        return redirect('manageuser')->with('success', 'User Successfully Created');
    }

    public function update($id, Request $request)
    {
        $users = User::where('user_id', $id)->first();
        $roles = Role::orderBy('id','asc')->get();
        
		
		// shauqi edit
        
        $payment = Payment::where('user_invite', $id)->get();
        $payment_detail = [];

        if(count($payment) != 0) {
            foreach($payment as $p) {
                $user = Student::where('stud_id', $p->stud_id);

                if($user->count() > 0) {
                    $user = $user->first();
                    $name = $user->first_name . " " . $user->last_name;
                    $p->name = $name;
                }else {
                    $p->name = "";
                }

                $payment_detail[] = $p;
            }
        }
        
        $data = $this->paginate($payment_detail, 10);
        $data->setPath('updateUser');
        $data_count = count($data);

        return view('admin.updateuser', compact('users','roles', 'data', 'data_count'));
    }
	
	public function paginate($items, $perPage, $page = null, $options = []){
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function updateuser($id, Request $request){
        
        foreach($request->optradio as $key => $value){

            $users = User::where('user_id', $id)->first();  

            $users->name = $request->name;
            $users->email = $request->email;
            $users->password = Hash::make($request['password']);
            $users->role_id = $value;
            $users->save();
            
        }

        return redirect('manageuser')->with('updatesuccess','User updated successfully!');      
    }

    public function destroy($id){
        $users = User::where('user_id', $id);
        
        $users->delete();
        return redirect('manageuser')->with('delete','User Successfully Deleted!');
    }

    /*-- Manage Role --------------------------------------------------------*/
    public function managerole()
    {
        $roles = Role::orderBy('id','asc')->paginate(10);
        return view('admin.managerole', compact('roles'));
    }

    public function addrole(Request $request){
        
        $role = Role::orderBy('id','desc')->first();

        $auto_inc_role = $role->id + 1;
        $roleId = 'ROD' . 0 . 0 . $auto_inc_role;

        Role::create(array(
            'role_id'=> $roleId,
            'name' => $request['name'],
            'description' => $request['description'],
            'permission' => $request['permission'],
            
        ));

        return redirect()->back()->with('rolesuccess', 'Role Successfully Created!');
    }

    public function details($id)
    {
        $roles = Role::where('role_id', $id)->first();
        return view('admin.updaterole', compact('roles'));
    }

    public function updaterole($id, Request $request)
    {
        $roles = Role::where('role_id', $id)->first();        

        $roles->name = $request->name;
        $roles->description = $request->description;

        $roles->save();

        foreach($request->permission as $key => $value){

            $p = Permission::where('role_id', $id)->where('permission_id', $request->permission_id[$key])->first();

            $p->name = $value;

            $p->save();
            

        }

        return redirect('managerole')->with('updatesuccess','Role Successfully Updated!');
    }

    public function deleterole($id){
        $roles = Role::where('role_id', $id);
        
        $roles->delete();
        return redirect('managerole')->with('deletesuccess','Role Successfully Deleted!');
    }

    /*-- Manage Profile --------------------------------------------------------*/
    public function profile()
    {
        return view('admin.updateprofile');
    }

    public function manageprofile($id, Request $request){
        
        $users = User::where('user_id', $id)->first();  

        // $users->name = $request->name;
        // $users->email = $request->email;
        $users->password = Hash::make($request['password']);
        $users->save();

        return redirect('dashboard')->with('updateprofile','Password Successfully Updated!');      
    }
}

