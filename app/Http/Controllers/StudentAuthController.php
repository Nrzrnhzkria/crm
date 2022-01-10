<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Route;
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\Auth\LoginController as DefaultLoginController;

class StudentAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:student')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.students.login');
    }

    public function username()
    {
        return 'stud_id';
    }

    protected function guard()
    {
        return Auth::guard('student');
    }

    public function index()
    {
        return view('auth.students.login');
    }  
      

    public function StudentLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        if (Auth::guard('student')->attempt(['email' => $request->email, 'student_password' => $request->password])) {
            // if successful, then redirect to their intended location
            return redirect()->intended(route('student.dashboard'));
        } 

        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'));
   
        // $credentials = $request->only('email', 'password');
        // if (Auth::attempt($credentials)) {
        //     return redirect()->intended('auth.students.dashboard')
        //                 ->withSuccess('Signed in');
        // }
  
        // return redirect("/student/login")->withSuccess('Login details are not valid');
    }



    public function registration()
    {
        return view('auth.students.registration');
    }
      

    public function StudentRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("/student/dashboard")->withSuccess('You have signed-in');
    }


    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }    
    

    public function dashboard()
    {
        if(Auth::check()){
            return view('auth.students.dashboard');
        }
  
        return redirect("/student/login")->withSuccess('You are not allowed to access');
    }
    

    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('/student/login');
    }
}