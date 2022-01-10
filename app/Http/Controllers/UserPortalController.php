<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use App\Payment;
use App\Student;
use App\Offer;
use App\Product;
use App\Package;
use Hash;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Factory;

class UserPortalController extends Controller
{
    use AuthenticatesUsers;

    // protected $redirectTo = '/staff/dashboard';

    public function __construct() {
        // $this->middleware('guest')->except('logout');
    }

    public function checkRole() {
        if(!Session::has('role_id') || Session::get('role_id') != 'ROD005') {
            // return view('staff.login');
            return redirect()->route('staff.login');
        }
    }

    public function showLink() {
        $this->checkRole();
        $offers = Offer::orderBy('id','desc')->get();
        $product = Product::orderBy('id','desc')->paginate(15);

        return view('staff.event_links', compact('offers', 'product'));
    }

    public function linkDetail(Request $request, $product_id) {
        $this->checkRole();
        
        $product = Product::where('product_id', $product_id)->first();
        $package = Package::where('product_id', $product_id)->paginate(15);
        
        $link = request()->getSchemeAndHttpHost().'/pendaftaran/'. $product->product_id . '/';

        return view('staff.link_detail', compact('product', 'package', 'link'));   
    }

    public function login(Request $request) {
        $input = $request->all();
        
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $user_details = User::where('email', $request->email)->first();
        
        if($user_details) {
            if(Hash::check($request->password, $user_details->password) && $user_details->role_id == 'ROD005') {
                Session::put('user_id', $user_details->user_id);
                Session::put('role_id', $user_details->role_id);
                Session::put('isLogin', 1);
    
                return redirect()->route('staff.dashboard');
            }else {
                return redirect()->route('staff.login')->with('error','Email-Address And Password Are Wrong.');
            }
        }else {
            return redirect()->route('staff.login')->with('error','Email-Address And Password Are Wrong.');
        }

        // if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))){
        //     return redirect()->route('staff.dashboard');
        // }else{
        //     return redirect()->route('staff.login')->with('error','Email-Address And Password Are Wrong.');
        // }
    }

    public function showLoginForm() {
        if(Session::get('isLogin')) {
            return redirect()->route('staff.dashboard');
        }
        return view('staff.login');
    }

    public function index() {
        $this->checkRole();
        $payment = Payment::where('user_invite', Session::get('user_id'))->get();
        // $pay = Payment::where('user_invite', Session::get('user_id'))->paginate(2);
        
        // dd($pay);
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
        $data->setPath('dashboard');
        $data_count = count($data);

        return view('staff.dashboard', compact('data', 'data_count'));
    }

    public function paginate($items, $perPage, $page = null, $options = []){
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function logout() {
        Session::flush();

        return redirect("staff/login");
    }

    public function invite($id, Request $request) {
        Session::put('staff_invite_id', $id);
        $user_details = User::where('user_id', $id)->first();

        return view('staff.invite', compact('user_details'));
    }
}