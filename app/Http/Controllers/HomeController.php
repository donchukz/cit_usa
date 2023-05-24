<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DailyPay;
use App\Models\PayReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

     public function EditPassword()
   {
    return view('auth.passwords.reset');
   }

   public function UpdatePassword(Request $request)
   {
    $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
   }
   public function invoice(Request $request, $id)
    {
       $pay = PayReport::with('employee')->findOrFail($id);
       $pays= DailyPay::with('patient')
        ->where('emp_id', $pay->emp_id)
        ->where('pay_period_id', $pay->pay_period)
        ->orderBy('visit_date', 'ASC')
        ->paginate(10);
        return view('invoice', compact('pay', 'pays'));
    }
}
