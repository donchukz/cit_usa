<?php

namespace App\Http\Controllers\Auth;

use App\Models\Patient;
use App\Models\Registry;
use App\Models\paysummary;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

     public function index(Request $request)
   {
    return view('auth.login');
   }

    public function save(Request $request)
   {
         $this-> validate($request,[
            'email'=>'required|email',
            'password'=>'required',
         ]);

         //sign in user

         if (!auth()->attempt ($request->only('email','password','role'),$request->remember))
         {
            return back()->with('status','Invalid login details');
         }
         //redirect
         if(auth()->user()->role=='admin')
         {
            // dd('Admin');
          return redirect()->route('dashboard');
         }
         else
         {
            return redirect()->route('employee');

         }

   }


}