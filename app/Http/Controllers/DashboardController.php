<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Rate;

use App\Models\User;

use App\Models\EmpTime;

use App\Models\Patient;

use App\Models\Setting;

use App\Models\DailyPay;
use App\Models\EmpAvail;
use App\Models\Employee;
use App\Models\Registry;
use App\Models\UserRate;
use App\Models\PayPeriod;
use App\Models\PayReport;
use App\Models\Specialty;
use App\Models\paysummary;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class DashboardController extends Controller
{
    //get all employees belonging to the logged in user
    public function index(Request $request)
    {
        $visits = Rate::latest()->paginate(10);
        $times = EmpTime::latest()->paginate(10);
        $employees=Employee::paginate(10);
       // $employees = addEmployee::where('user_id',auth()->user()->id)->get();
        return view('employees',[
            'employees'=>$employees,
            'visits' => $visits,
            'times' => $times
        ]);
    }

    public function newEmployee()
    {
        return view('add-employee');
    }

    public function Patients()
    {
        $patients = Patient::latest()->paginate(10);
        return view('patients', compact('patients'));
    }

    public function addPatient(Request $request)
    {
        Patient::create([
            'name' => $request->name,
            'address'=> $request->address,
            'status' => $request->status
        ]);
        return back()->with('status', 'Patient added successfully');
    }

    public function updatePatient(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);
        $patient->name = $request->name;
        $patient->address = $request->address;
        $patient->status = $request->status;
        $patient->save();
        return back()->with('status', 'Patient record updated successfully');
    }

    public function Visits()
    {
        $visits = Rate::latest()->paginate(10);
        return view('visit', compact('visits'));
    }

    public function AddVisit(Request $request)
    {
        $visit = Rate::create([
            'name' => $request->name
        ]);

        return back()->with('status', 'Visit type added successfully');
    }

    public function UpdateVisit(Request $request, $id)
    {
        $visit = Rate::findOrFail($id);
        $visit->name = $request->name;
        $visit->save();
        return back()->with('status', 'visit type updated successfully');
    }

    public function Settings()
    {
        $settings = Setting::latest()->paginate(10);
        return view('settings', compact('settings'));
    }

    public function AddSettings(Request $request)
    {
        $setting = Setting::create([
            'multiplier1' => $request->multiplier1,
            'multiplier2' => $request->multiplier2
        ]);

        return back()->with('status', 'Setting added successfully');
    }

    public function editSettings(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);
        $setting->multiplier1 = $request->multiplier1;
        $setting->multiplier2 = $request->multiplier2;
        $setting->save();
        return back()->with('status', 'Setting updated successfully');
    }

    public function EmpTime()
    {
        $settings = EmpTime::latest()->paginate(10);
        return view('emp_time', compact('settings'));
    }

    public function AddTime(Request $request)
    {
        $setting = EmpTime::create([
            'from_time' => $request->from_time,
            'to_time' => $request->to_time
        ]);

        return back()->with('status', 'Time added successfully');
    }

    public function UpdateTime(Request $request, $id)
    {
        $setting = EmpTime::findOrFail($id);
        $setting->from_time = $request->from_time;
        $setting->to_time = $request->to_time;
        $setting->save();
        return back()->with('status', 'Time updated successfully');
    }

    public function AssignPatient()
    {
        return view('assign-patient');
    }

    public function addEmployee(Request $request)
    {
        // dd($request->all());
           $validator = Validator::make($request->all(),  [
            'name'=>'required|max:255',
            'date'=>'required|max:20',
            'hourly_rate'=>'required|max:100',
            'rate'=>'required|max:200',
            'status'=>'required|max:100',
            'email' => 'required|string|email|max:255|unique:users',
            'employment'=>'required|max:100',
            'discipline'=>'required|max:100',
            'specialty'=>'required|max:100',
            'address'=>'required|max:100',
            'priority1'=>'required|max:100',
            'priority2'=>'required|max:100',
            'priority3'=>'required|max:100',
            'other_area'=>'required|max:100',
            'day'=>'required|max:200',
            'time'=>'required|max:200',

       ]);
//   dd($validator->fails());
       //check if user already exists
       if(User::where('email',$request->email)->exists()||Employee::where('email',$request->email)->exists())
       {
           return back()->with('status2','Email already exists');
       }

           //save details
          if($validator->fails())
           {
            // dd('failed');
             return back()->with('status','Employee not Added');

           }
            else
            {
            $user= User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make('12345678'),
                'role'=>'employee',
            ]);


            // dd('success');
            $emp=  Employee::create([
                'user_id'=>$user->id,
                'name'=>$request->name,
                'date'=>$request->date,
                'visit_rate'=>'',
                'status'=>$request->status,
                'email'=>$request->email,
                'emp_type'=> $request->employment ?? '',
                'discipline'=> $request->discipline ?? '',
                'specialty'=> json_encode($request->specialty) ?? '',
                'address'=> $request->address ?? '',
                'priority1'=> $request->priority1 ?? '',
                'priority2'=> $request->priority2 ?? '',
                'priority3'=> $request->priority3 ?? '',
                'other_area'=> $request->other_area ?? '',
                'emp_availability'=> '',
            ]);
            $e = $emp->id;
            $emp_avail = array();
            foreach ($request->day as $key => $item) {
               $emp = EmpAvail::create([
                'emp_id' => $e,
                'day' => $item,
                'time' => $request->time[$key]
               ]);
               array_push($emp_avail, $emp->id);
            }


            $emp_visit = array();
            foreach ($request->rate as $key => $rate) {
                $visit = UserRate::create([
                    'emp_id' => $e,
                    'rate_id' =>  $rate,
                    'amount' => $request->hourly_rate[$key]
                ]);
                array_push($emp_visit, $visit->id);
            }
            $emp = Employee::findOrFail($e);
            $emp->emp_availability = json_encode($emp_avail);
            $emp->visit_rate = json_encode($emp_visit);
            $emp->save();

            Registry::create([
                'user_id'=>$user->id,
                'emp_id'=>$emp->id,
                'typeofemployment'=> $request->employment ?? 'Full Time',
                'registrytype'=> 'N/A',
                'status'=>$request->status,
            ]);

            return redirect()->route('dashboard')->with('status',"Employee Added successfully");

            }

        //get employee details


        //save employee details

              //function to logout after 5 minutes
                 function logoutAfterFiveMinutes()
                 {
                        $timeout = 5; // Set timeout minutes
                        $logout_redirect_url = "/"; // Set logout URL

                        $timeout = $timeout * 60; // Converts minutes to seconds
                        if (isset($_SESSION['start_time'])) {
                            $elapsed_time = time() - $_SESSION['start_time'];
                            if ($elapsed_time >= $timeout) {
                                session_destroy();
                                echo "<script>alert('Your session has expired!')</script>";
                                echo "<script>window.location.href='$logout_redirect_url'</script>";
                            }
                        }
                        $_SESSION['start_time'] = time();

                 }




    }


    public function UpdateEmployee(Request $request, $id)
    {

        $employee = Employee::find($id);
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->discipline = $request->discipline;
        // $employee->emp_type = $request->employment;
        // $employee->specialty = $request->specialty;
        $employee->address = $request->address;
        $employee->priority1 = $request->priority1;
        $employee->priority2 = $request->priority2;
        $employee->priority3 = $request->priority3;
        $employee->other_area = $request->other_area;
        $employee->date = $request->date;
        $employee->status = $request->status;
        $employee->save();


         return redirect()->back()->with('status','employee Updated Successfully');
       }

       public function PayPeriod()
       {
        $payperiods = PayPeriod::get();
        return view('pay-period', compact('payperiods'));
       }

       public function AddPayPeriod(Request $request)
       {
        PayPeriod::create([
            'period' => $request->period,
            'from_date' => $request->from_date,
            'to_date' => $request->to_date
        ]);
        return back()->with('status', 'Pay period added successfully');
       }

       public function UpdatePayPeriod(Request $request)
       {
        $pay = PayPeriod::findOrFail($request->id);
        $pay->period = $request->period;
        $pay->from_date = $request->from_date;
        $pay->to_date = $request->to_date;
        $pay->save();
        return back()->with('status', 'Pay period updated successfully');

       }

       public function PayApproval(Request $request, $id)
       {

            $pay = PayReport::findOrFail($id);
            $pay->status = $request->status;
            $pay->save();
            if( $request->pid != 0)
            {
                foreach (explode(',', $request->pid) as $key => $pid) {
                    $dailypay = DailyPay::findOrFail($pid);
                    $dailypay->status = $request->status;
                    $dailypay->save();
                }
            }else{
                $dailypay = DailyPay::where('pay_report_id', $id)->get();
                foreach ($dailypay as $key => $dpay) {
                    $dpay->status = $request->status;
                    $dpay->save();
                }
            }

            $emp_id  = Employee::findOrFail($pay->emp_id);
            $period = PayPeriod::findOrFail($pay->pay_period);
            $year = date('Y', strtotime($pay->year));
            $p_FromDay = date('d', strtotime($period->from_date));
            $p_FromMonth = date('m', strtotime($period->from_date));
            $p_ToDay = date('d', strtotime($period->to_date));
            $p_ToMonth = date('m', strtotime($period->to_date));
            $fromDate = $year.'-'.$p_FromMonth.'-'.$p_FromDay;
            $toDate =   $year.'-'.$p_ToMonth.'-'.$p_ToDay;

            $dates = DailyPay::select('visit_date')->where('emp_id', $emp_id->id)->whereBetween('visit_date', [ $fromDate, $toDate])->distinct()->get();
            $pays = DailyPay::with('patient')->whereBetween('visit_date', [ $fromDate, $toDate])->where('emp_id', $emp_id->id)->where('status', 'Approved')->orderBy('time', 'asc')->get();
            $patient_count= DailyPay::select('patient_id')->whereBetween('visit_date', [ $fromDate, $toDate])->where('emp_id', $emp_id->id)->where('status', 'Approved')->count();
            $payreport = PayReport::where('pay_period', $period->id)->where('emp_id', $emp_id->id)->where('year', $year)->first();

            $result = app('geocoder')->geocode($emp_id->address)->get();
            $coordinates = $result[0]->getCoordinates();
            $emp_lat = deg2rad($coordinates->getLatitude());
            $emp_long = deg2rad($coordinates->getLongitude());

            $amount = array();
            $distance = array();

            foreach($dates as $date)
            {
                foreach ($pays as $key => $pay) {
                    $result = app('geocoder')->geocode($pay->patient->address)->get();
                    $coordinates = $result[0]->getCoordinates();
                    $pat_lat = deg2rad($coordinates->getLatitude());
                    $pat_long = deg2rad($coordinates->getLongitude());
                    // dd($pat_lat);
                    if ($pay->visit_date == $date->visit_date) {
                        if ($key == 0) {
                            # calculate distance and amount
                            $earth_radius = 6371;
                            $dLat = $pat_lat - $emp_lat;
                            $dLon = $pat_long - $emp_long;
                            $a = 2 * asin(sqrt(pow(sin($dLat/2), 2) + cos($emp_lat) * cos($pat_lat) * pow(sin($dLon / 2), 2)));
                            $miles = $earth_radius * $a + $pay->adj_miles;
                            // dd($miles);
                            if ($miles < 30) {
                                $amounts = $miles * 0.655;

                            } else {
                                $remainder = $miles - 29;
                                $amounts = 29 * 0.655 + $remainder * 1.5;
                            }
                            $patient_amount = DailyPay::findOrFail($pay->id);
                            $patient_amount->amount = $amounts;
                            $patient_amount->miles = $miles - $pay->adj_miles;
                            $patient_amount->save();
                            array_push($amount, $amounts);
                            array_push($distance, $miles);

                        }
                        else {
                            $patient = $pays[$key - 1];
                            $result = app('geocoder')->geocode($patient->patient->address)->get();
                            $coordinates1 = $result[0]->getCoordinates();
                            $pat1_lat = deg2rad($coordinates1->getLatitude());
                            $pat1_long = deg2rad($coordinates1->getLongitude());
                            $earth_radius = 6371;
                            $dLat = $pat1_lat - $pat_lat;
                            $dLon = $pat1_long - $pat_long;
                            $a = 2 * asin(sqrt(pow(sin($dLat/2), 2) + cos($emp_lat) * cos($pat1_lat) * pow(sin($dLon / 2), 2)));
                            $miles = $earth_radius * $a + $pay->adj_miles;

                            if ($miles < 30) {
                                $amounts = $miles * 0.655;
                            } else {
                                $remainder = $miles - 29;
                                $amounts = 29 * 0.655 + $remainder * 1.5;
                            }
                            $patient_amount = DailyPay::findOrFail($pay->id);
                            $patient_amount->amount = $amounts;
                            $patient_amount->miles = $miles - $pay->adj_miles;
                            $patient_amount->pay_report_id = $payreport->id;
                            $patient_amount->save();
                            array_push($amount, $amounts);
                            array_push($distance, $miles);
                        }

                    }

                }
            }

            $amount = array_sum($amount);
            $distance = array_sum($distance);


            $payreport->date = Carbon::now()->format('M d Y');
            $payreport->total_miles = $distance;
            $payreport->total_amount = $amount;
            $payreport->no_visits = $pays->count();
            $payreport->no_patients = $patient_count;
            $payreport->save();


            return redirect()->route('paysummary')->with('status', 'Invoice status has been updated');
       }

       public function UpdateVistType(Request $request, $id)
       {
        $pay = Rate::findOrFail($request->id);
        $pay->name = $request->name;
        $pay->save();
        return back()->with('status', 'Visit Type updated successfully');

       }

       public function Specialty()
       {
        $specialties = Specialty::get();
        return view('specialty', compact('specialties'));

       }
       public function AddSpecialty(Request $request)
       {
        $pay = Specialty::create([
            'name' => $request->name
        ]);
        return back()->with('status', 'Specialty added successfully');

       }
       public function UpdateSpecialty(Request $request, $id)
       {
        $pay = Specialty::findOrFail($request->id);
        $pay->name = $request->name;
        $pay->save();
        return back()->with('status', 'Specialty updated successfully');

       }


}
