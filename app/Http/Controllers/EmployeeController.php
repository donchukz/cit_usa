<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\User;

use App\Models\Patient;

use App\Models\DailyPay;
use App\Models\Employee;
use App\Models\Registry;

use App\Models\PayPeriod;
use App\Models\PayReport;
use App\Models\UserRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function enterPaySummary()
    {
        $employee = Employee::where('user_id',auth()->user()->id)->first();
        $periods = PayPeriod::get();
        $patients=Patient::get();
        $paysummaries = PayReport::query()->with(['payperiod'])->where('id', 0)->get();
        $pay = PayReport::query()->with(['payperiod'])->where('id', 0)->first();
        $invoices = DailyPay::query()->with(['userRate'])->where('pay_report_id', 0)->orderBy('visit_date', 'ASC')->get();
        $pp = 0;


        return view('enter_employee_pay', compact('employee', 'periods', 'patients','paysummaries','pay','invoices','pp'));
    }

    public function getPaySummaryPreview(Request $request)
    {
        dd($request->collect());
    }

    public function index(Request $request)

    {
        $query = PayReport::query();
        $data = $request->all();
        if($request->status)
        {
            $query= $query->where('status', $request->status);
        }
        if($request->year)
        {
            $query= $query->where('year', $request->year);
        }

        $patients=Patient::get();
        $employee = Employee::where('user_id',auth()->user()->id)->first();
        $Registry = Registry::where('user_id',auth()->user()->id)->first();
        $daily_pays= DailyPay::with('patient')->where('emp_id',$employee->id)->latest()->paginate(20);
        $paysummary= $query->where('emp_id',$employee->id)->with('payperiod')->latest()->paginate(20);
        $periods = PayPeriod::get();
        $status = $request->status ?? null;
        $year = $request->year ?? null;
        return view('employeeAccount',[
            'employee'=>$employee,
            'registries'=>$Registry,
            'paysummaries'=>$paysummary,
            'patients'=>$patients,
            'daily_pays'=> $daily_pays,
            'periods' => $periods,
            'status' => $status,
            'year' => $year
        ]);


    }

    public function DailyPay(Request $request)
    {
        // ddd($request->all());
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'time' => 'required',
            'visit_type' => 'required',
            'patient' => 'required',
            'period' => 'required'
        ]);
        // ddd($validator);

        if ($validator->passes()) {
        $date = $request->date;
        $time = $request->time;
        $emp = $request->employee;
        $emp_visit= $request->visit_type;
        $year = date('Y', strtotime($date));
        $checkData = DailyPay::where('patient_id', $request->patient)->where('pay_period_id',  $request->period)->where('visit_date', $request->date)->where('emp_id',$emp)->first();
        if ($checkData) {
            return back()->with('error', 'Pay data already exist');
        }

        $checkPeriod = DailyPay::selectRaw('YEAR(visit_date) AS year, id')->where('pay_period_id', $request->period)->where('emp_id', $emp)->having('year', $year)->first();

        $emp_id = Employee::findOrFail($emp);
        $pay_report_id = 0;
        $period = PayPeriod::findOrFail($request->period);
        $p_FromDay = date('d', strtotime($period->from_date));
        $p_FromMonth = date('m', strtotime($period->from_date));
        $p_ToDay = date('d', strtotime($period->to_date));
        $p_ToMonth = date('m', strtotime($period->to_date));
        $fromDate = $year.'-'.$p_FromMonth.'-'.$p_FromDay;
        $toDate =   $year.'-'.$p_ToMonth.'-'.$p_ToDay;
        $pat = $request->patient;


        if ($checkPeriod) {

            $isVisitDateValid = $fromDate <= $date && $toDate >= $date;
            if (!$isVisitDateValid){
                return back()->with( 'error','The visit date must fall within the pay period. Please select a pay period that corresponds to the visit date or contact the admin to create the pay period before trying again.');
            }
            else{
                $checkPay = DailyPay::where('emp_id', $emp)->where('visit_date', $date)->where('pay_period_id', $request->period)->where('patient_id',$pat)->first();
                if($request->hasFile('file'))
                {
                    $fileName = time().'.'.$request->file->extension();

                    $request->file->move(public_path('uploads'), $fileName);

                }
                if($checkPay)
                {
                    $checkPay->visit_date = $date;
                    $checkPay->time = $time;
                    $checkPay->patient_id = $pat;
                    $checkPay->emp_id = $emp;
                    $checkPay->user_rate_id = $emp_visit;
                    $checkPay->signature = $fileName ?? '';
                    $checkPay->sign = 1;
                    $checkPay->pay_period_id = $request->period;
                    $checkPay->comment = $request->comment ?? '';
                    $checkPay->save();
                }else{
                    $d_pay = DailyPay::create([
                        'visit_date' => $date,
                        'time' => $time,
                        'patient_id' => $pat,
                        'emp_id' => $emp,
                        'user_rate_id' => $emp_visit,
                        'signature' => $fileName ?? '',
                        'sign' => 1,
                        'pay_period_id' => $request->period,
                        'comment' => $request->comment ?? ''
                    ]);
                }

            }

            //calculate the distances and amount
            $dates = DailyPay::select('visit_date')->where('emp_id', $emp_id->id)->whereBetween('visit_date', [$fromDate, $toDate])->distinct()->get();
            $pays = DailyPay::with('patient')->whereBetween('visit_date', [$fromDate, $toDate])->where('emp_id', $emp_id->id)->orderBy('time', 'asc')->get();
            $patient_count = DailyPay::select('patient_id')->whereBetween('visit_date', [$fromDate, $toDate])->where('emp_id', $emp_id->id)->count();
            $payreport = PayReport::where('pay_period', $period->id)->where('emp_id', $emp_id->id)->where('year', $year)->first();
            $pay_report_id = $payreport->id;
            $result = app('geocoder')->geocode($emp_id->address)->get();
            $coordinates = $result[0]->getCoordinates();
            $emp_lat = deg2rad($coordinates->getLatitude());
            $emp_long = deg2rad($coordinates->getLongitude());

            $amount = array();
            $distance = array();

            foreach ($dates as $date) {
                foreach ($pays as $key => $pay) {
                    $result = app('geocoder')->geocode($pay->patient->address)->get();
                    $coordinates = $result[0]->getCoordinates();
                    $pat_lat = deg2rad($coordinates->getLatitude());
                    $pat_long = deg2rad($coordinates->getLongitude());
                    if ($pay->visit_date == $date->visit_date) {
                        if ($key == 0) {
                            # calculate distance and amount
                            $earth_radius = 6371;
                            $dLat = $pat_lat - $emp_lat;
                            $dLon = $pat_long - $emp_long;
                            $a = 2 * asin(sqrt(pow(sin($dLat / 2), 2) + cos($emp_lat) * cos($pat_lat) * pow(sin($dLon / 2), 2)));
                            $miles = $earth_radius * $a;
                            // dd($miles);
                            if ($miles < 30) {
                                $amounts = $miles * 0.655;

                            } else {
                                $remainder = $miles - 29;
                                $amounts = 29 * 0.655 + $remainder * 1.5;
                            }
                            // dd($miles);
                            $patient_amount = DailyPay::findOrFail($pay->id);
                            $patient_amount->amount = $amounts;
                            $patient_amount->miles = $miles;
                            $patient_amount->pay_report_id = $payreport->id;
                            $patient_amount->status = 'Pending';
                            $patient_amount->save();
                            array_push($amount, $amounts);
                            array_push($distance, $miles);

                        } else {
                            $patient = $pays[$key - 1];
                            $result = app('geocoder')->geocode($patient->patient->address)->get();
                            $coordinates1 = $result[0]->getCoordinates();
                            $pat1_lat = deg2rad($coordinates1->getLatitude());
                            $pat1_long = deg2rad($coordinates1->getLongitude());
                            $earth_radius = 6371;
                            $dLat = $pat1_lat - $pat_lat;
                            $dLon = $pat1_long - $pat_long;
                            $a = 2 * asin(sqrt(pow(sin($dLat / 2), 2) + cos($emp_lat) * cos($pat1_lat) * pow(sin($dLon / 2), 2)));
                            $miles = $earth_radius * $a;

                            if ($miles < 30) {
                                $amounts = $miles * 0.655;
                            } else {
                                $remainder = $miles - 29;
                                $amounts = 29 * 0.655 + $remainder * 1.5;
                            }
                            $patient_amount = DailyPay::findOrFail($pay->id);
                            $patient_amount->amount = $amounts;
                            $patient_amount->miles = $miles;
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
            $payreport->status = 'Pending';
            $payreport->save();
        } else {
                $pat = $request->patient ;
                $year = date('Y', strtotime($date));
                $p_FromDay = date('d', strtotime($period->from_date));
                $p_FromMonth = date('m', strtotime($period->from_date));
                $p_ToDay = date('d', strtotime($period->to_date));
                $p_ToMonth = date('m', strtotime($period->to_date));
                $fromDate = $year.'-'.$p_FromMonth.'-'.$p_FromDay;
                $toDate =   $year.'-'.$p_ToMonth.'-'.$p_ToDay;
                $isVisitDateValid = $fromDate <= $date && $toDate >= $date;
                if (!$isVisitDateValid){
                    return back()->with( 'error','The visit date must fall within the pay period. Please select a pay period that corresponds to the visit date or contact the admin to create the pay period before trying again.');
                }
                if($request->hasFile('file'))
                {
                    $fileName = time().'.'.$request->file->extension();

                    $request->file->move(public_path('uploads'), $fileName);

                }

                DailyPay::create([
                    'visit_date' => $date,
                    'time' => $time,
                    'patient_id' => $pat,
                    'emp_id' => $emp,
                    'user_rate_id' => $emp_visit,
                    'signature' => $fileName ?? '',
                    'sign' => 1,
                    'pay_period_id' => $request->period,
                    'comment' => $request->comment ?? ''
                ]);


                //calculate the distances and amount
                $period = PayPeriod::findOrFail($request->period);
                $dates = DailyPay::select('visit_date')->where('emp_id', $emp_id->id)->whereBetween('visit_date', [$fromDate, $toDate])->distinct()->get();
                $pays = DailyPay::with('patient')->whereBetween('visit_date', [$fromDate, $toDate])->where('emp_id', $emp_id->id)->orderBy('time', 'asc')->get();
                $patient_count = DailyPay::select('patient_id')->whereBetween('visit_date', [$fromDate, $toDate])->where('emp_id', $emp_id->id)->count();

                $result = app('geocoder')->geocode($emp_id->address)->get();

                $coordinates = $result[0]->getCoordinates();
                $emp_lat = deg2rad($coordinates->getLatitude());
                $emp_long = deg2rad($coordinates->getLongitude());

                $amount = array();
                $distance = array();

                foreach ($dates as $date) {
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
                                $a = 2 * asin(sqrt(pow(sin($dLat / 2), 2) + cos($emp_lat) * cos($pat_lat) * pow(sin($dLon / 2), 2)));
                                $miles = $earth_radius * $a;
                                // dd($miles);
                                if ($miles < 30) {
                                    $amounts = $miles * 0.655;

                                } else {
                                    $remainder = $miles - 29;
                                    $amounts = 29 * 0.655 + $remainder * 1.5;
                                }
                                $patient_amount = DailyPay::findOrFail($pay->id);
                                $patient_amount->amount = $amounts;
                                $patient_amount->miles = $miles;
                                $patient_amount->save();
                                array_push($amount, $amounts);
                                array_push($distance, $miles);

                            } else {
                                $patient = $pays[$key - 1];
                                $result = app('geocoder')->geocode($patient->patient->address)->get();
                                $coordinates1 = $result[0]->getCoordinates();
                                $pat1_lat = deg2rad($coordinates1->getLatitude());
                                $pat1_long = deg2rad($coordinates1->getLongitude());
                                $earth_radius = 6371;
                                $dLat = $pat1_lat - $pat_lat;
                                $dLon = $pat1_long - $pat_long;
                                $a = 2 * asin(sqrt(pow(sin($dLat / 2), 2) + cos($emp_lat) * cos($pat1_lat) * pow(sin($dLon / 2), 2)));
                                $miles = $earth_radius * $a;

                                if ($miles < 30) {
                                    $amounts = $miles * 0.655;
                                } else {
                                    $remainder = $miles - 29;
                                    $amounts = 29 * 0.655 + $remainder * 1.5;
                                }
                                $patient_amount = DailyPay::findOrFail($pay->id);
                                $patient_amount->amount = $amounts;
                                $patient_amount->miles = $miles;
                                $patient_amount->save();
                                array_push($amount, $amounts);
                                array_push($distance, $miles);
                            }

                        }

                    }
                }

                $amount = array_sum($amount);
                $distance = array_sum($distance);


                $payreport = PayReport::create([
                    'emp_id' => $emp_id->id,
                    'date' => Carbon::now()->format('M d Y'),
                    'pay_period' => $request->period,
                    'total_miles' => $distance,
                    'total_amount' => $amount,
                    'no_visits' => $pays->count(),
                    'no_patients' => $patient_count,
                    'invoice' => 'INV' . rand(0000000, 9999999),
                    'year' => $year
                ]);
                $pay_report_id = $payreport->id;
                foreach ($pays as $key => $pay) {
                    $pay->pay_report_id = $payreport->id;
                    $pay->save();
                }
        }

        $paysummaries = PayReport::query()->with(['payperiod'])->where('id', $pay_report_id)->get();
        $pay = PayReport::query()->with(['payperiod'])->where('id', $pay_report_id)->first();
        $invoices = DailyPay::query()->with(['userRate'])->where('pay_report_id', $pay_report_id)->orderBy('visit_date', 'ASC')->get();
        $employee = Employee::where('user_id',auth()->user()->id)->first();
        $periods = PayPeriod::get();
        $patients=Patient::get();
        $pp = $request->period;


        return redirect()->route('invoicesummary')->with(['employee'=> $employee, 'periods' => $periods, 'patients' => $patients, 'paysummarries' => $paysummaries, 'invoices'=>$invoices, 'pay'=>$pay, 'pp'=>$request->period]);

        // return view('refreshPayPreviewSummary', compact('paysummaries', 'invoices', 'pay'));

        // return view('enter_employee_pay',compact('paysummaries', 'invoices', 'pay','employee','periods','patients'))->with('status', 'Pay Summary Submitted Successfully');
    }
    return response()->json(['code' => 400, 'error'=>$validator->errors()->all()]);
    }

    public function InvoiceSummary()
    {
        // dd(session()->get('invoices'));
        $employee = Employee::where('user_id',auth()->user()->id)->first();
        $periods = PayPeriod::get();
        $patients=Patient::get();
        $paysummaries=session()->get('paysummaries');
        $invoices= session()->get('invoices');
        $pay=session()->get('pay');
        $pp= session()->get('pp');
        $pays= DailyPay::with('patient')
        ->where('emp_id', $pay->emp_id)
        ->where('pay_period_id', $pay->pay_period)
        ->where('pay_report_id', $pay->id)->get();
        $rates = UserRate::where('emp_id', $pay->emp_id)->get();
        $visit = [];
        foreach ($rates as $key => $rate) {
            foreach ($pays as $key => $total) {
                if ($rate->id == $total->user_rate_id) {
                    $visit[] = $rate->amount;
                }
            }
        }
        $rates = array_sum($visit);
        $app_pays =DailyPay::select('user_rate_id')->where('pay_report_id', $pay->id)->where('status', 'Approved')->get();
        $pen_pays =DailyPay::select('user_rate_id')->where('pay_report_id', $pay->id)->where('status', 'Pending')->get();
        $app_miles =DailyPay::select('amount')->where('pay_report_id', $pay->id)->where('status', 'Approved')->sum('amount');
        $pen_miles =DailyPay::select('amount')->where('pay_report_id', $pay->id)->where('status', 'Pending')->sum('amount');
        $gen_rates = \App\Models\UserRate::where('emp_id', $pay->emp_id)->get();
        $app_visit = [];
        foreach ($gen_rates as $key => $rate) {
            foreach ($app_pays as $key => $total) {
                if ($rate->id == $total->user_rate_id) {
                    $app_visit[] = $rate->amount;
                }
            }
        }
        $pen_visit = [];
        foreach ($gen_rates as $key => $rate) {
            foreach ($pen_pays as $key => $total) {
                if ($rate->id == $total->user_rate_id) {
                    $pen_visit[] = $rate->amount;
                }
            }
        }

        $rates = array_sum($visit);
        $app_rates = array_sum($app_visit);
        $pen_rates = array_sum($pen_visit);
        $emp_id = $pay->emp_id;
        $app_pat = DailyPay::select('patient_id')->where('pay_report_id', $pay->id)->where('status', 'Approved')->count();
        $pen_pat = DailyPay::select('patient_id')->where('pay_report_id', $pay->id)->where('status', 'Pending')->count();


        return view('enter_employee_pay', compact('employee', 'periods', 'patients','paysummaries','pay','invoices','pp','rates', 'emp_id', 'app_pat', 'pen_pat', 'app_miles', 'pen_miles', 'app_rates', 'pen_rates'))->with('status', 'Pay Summary Added Successfully');
    }




    public function UpdateDailyPay(Request $request, $id)
    {
        $checkPeriod = DailyPay::findOrFail($request->id);
           $emp_id  = Employee::findOrFail($checkPeriod->emp_id);
        $period = PayPeriod::findOrFail($checkPeriod->pay_period_id);
        $year = date('Y', strtotime($checkPeriod->visit_date));
        $p_FromDay = date('d', strtotime($period->from_date));
        $p_FromMonth = date('m', strtotime($period->from_date));
        $p_ToDay = date('d', strtotime($period->to_date));
        $p_ToMonth = date('m', strtotime($period->to_date));
        $fromDate = $year.'-'.$p_FromMonth.'-'.$p_FromDay;
        $toDate =   $year.'-'.$p_ToMonth.'-'.$p_ToDay;
        $isVisitDateValid = $fromDate <= $request->visit_date && $toDate >= $request->visit_date;
                if (!$isVisitDateValid){
                    return back()->with( 'error','The visit date must fall within the pay period. Please select a date that corresponds to the pay period.');
                }

        if($request->visit_date)
        {
            $checkPeriod->visit_date = $request->visit_date;
        }
        if($request->user_rate_id)
        {
            $checkPeriod->user_rate_id = $request->user_rate_id;
        }

        if($request->time)
        {
            $checkPeriod->time = $request->time;
        }
        if($request->adj_miles)
        {
            $checkPeriod->adj_miles = $request->adj_miles;
        }
        $checkPeriod->status = 'Pending';
        $checkPeriod->save();



        $dates = DailyPay::select('visit_date')->where('emp_id', $emp_id->id)->whereBetween('visit_date', [ $fromDate, $toDate])->distinct()->get();
        $pays = DailyPay::with('patient')->whereBetween('visit_date', [ $fromDate, $toDate])->where('emp_id', $emp_id->id)->orderBy('time', 'asc')->get();
        $patient_count= DailyPay::select('patient_id')->whereBetween('visit_date', [ $fromDate, $toDate])->where('emp_id', $emp_id->id)->count();
        $payreport = PayReport::where('pay_period', $period->id)->where('emp_id', $emp_id->id)->where('year', $year)->first();
        $result = app('geocoder')->geocode($emp_id->address)->get();
        $coordinates = $result[0]->getCoordinates();
        $emp_lat = deg2rad($coordinates->getLatitude());
        $emp_long = deg2rad($coordinates->getLongitude());
        // dd($payreport);
        $amount = array();
        $distance = array();

        foreach($dates as $date)
        {
            foreach ($pays as $key => $pay) {
                $result = app('geocoder')->geocode($pay->patient->address)->get();
                $coordinates = $result[0]->getCoordinates();
                $pat_lat = deg2rad($coordinates->getLatitude());
                $pat_long = deg2rad($coordinates->getLongitude());

                if ($pay->visit_date == $date->visit_date) {
                    if ($key == 0) {
                        # calculate distance and amount
                        $earth_radius = 6371;
                        $dLat = $pat_lat - $emp_lat;
                        $dLon = $pat_long - $emp_long;
                        $a = 2 * asin(sqrt(pow(sin($dLat/2), 2) + cos($emp_lat) * cos($pat_lat) * pow(sin($dLon / 2), 2)));
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
                        $patient_amount->miles = $miles - $pay->adj_miles ;
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
        $payreport = PayReport::where('pay_period', $period->id)->where('emp_id', $emp_id->id)->where('year', $year)->first();
        if($payreport){
        $payreport->date = Carbon::now()->format('M d Y');
        $payreport->total_miles = $distance;
        $payreport->total_amount = $amount;
        $payreport->no_visits = $pays->count();
        $payreport->no_patients = $patient_count;
        $payreport->status = 'Pending';
        $payreport->save();
        }
        if (auth()->user()->role == 'admin') {
            return back()->with('status', 'Invoice updated succcessfully');
        } else {
            return back()->with('status', 'Invoice updated succcessfully');
        }

    }

    public function DeleteDailyPay(Request $request, $id)
    {
        $checkPeriod = DailyPay::findOrFail($id);
        $checkPeriod->delete();
        $emp_id  = Employee::findOrFail($checkPeriod->emp_id);

        $period = PayPeriod::findOrFail($checkPeriod->pay_period_id);
        $year = date('Y', strtotime($checkPeriod->visit_date));
        $p_FromDay = date('d', strtotime($period->from_date));
        $p_FromMonth = date('m', strtotime($period->from_date));
        $p_ToDay = date('d', strtotime($period->to_date));
        $p_ToMonth = date('m', strtotime($period->to_date));
        $fromDate = $year.'-'.$p_FromMonth.'-'.$p_FromDay;
        $toDate =   $year.'-'.$p_ToMonth.'-'.$p_ToDay;

        $dates = DailyPay::select('visit_date')->where('emp_id', $emp_id->id)->whereBetween('visit_date', [$fromDate, $toDate])->distinct()->get();
        $pays = DailyPay::with('patient')->whereBetween('visit_date', [$fromDate, $toDate])->where('emp_id', $emp_id->id)->orderBy('time', 'asc')->get();
        $patient_count= DailyPay::select('patient_id')->whereBetween('visit_date', [$fromDate, $toDate])->where('emp_id', $emp_id->id)->count();
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
                        $patient_amount->miles = $miles;
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
                        $patient_amount->miles = $miles;
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
       return back()->with('status', 'Invoice updated succcessfully');
    }


    public function paysummary(Request $request)
    {

        $emp_id  = Employee::where('email',auth()->user()->email)->first();
        $dates = DailyPay::select('visit_date')->where('emp_id', $emp_id->id)->whereBetween('visit_date', [$request->from_date, $request->to_date])->distinct()->get();
        $pays = DailyPay::with('patient')->whereBetween('visit_date', [$request->from_date, $request->to_date])->where('emp_id', $emp_id->id)->orderBy('time', 'asc')->get();
        $patient_count= DailyPay::select('patient_id')->whereBetween('visit_date', [$request->from_date, $request->to_date])->where('emp_id', $emp_id->id)->distinct('patient_id')->count();

        $result = app('geocoder')->geocode($emp_id->address)->get();
        $coordinates = $result[0]->getCoordinates();
        $emp_lat = deg2rad($coordinates->getLatitude());
        $emp_long = deg2rad($coordinates->getLongitude());

        $amount = array();
        $distance = array();
        // dd($pays);
        foreach($dates as $date)
        {
            foreach ($pays as $key => $pay) {
                $result = app('geocoder')->geocode($pay->patient->address)->get();
                $coordinates = $result[0]->getCoordinates();
                $pat_lat = deg2rad($coordinates->getLatitude());
                $pat_long = deg2rad($coordinates->getLongitude());

                if ($pay->visit_date == $date->visit_date) {
                    if ($key == 0) {
                        # calculate distance and amount
                        $earth_radius = 6371;
                        $dLat = $pat_lat - $emp_lat;
                        $dLon = $pat_long - $emp_long;
                        $a = 2 * asin(sqrt(pow(sin($dLat/2), 2) + cos($emp_lat) * cos($pat_lat) * pow(sin($dLon / 2), 2)));
                        $miles = $earth_radius * $a + $pay->adj_miles ;

                        if ($miles < 30) {
                            $amounts = $miles * 0.655;
                        } else {
                            $remainder = $miles - 29;
                            $amounts = 29 * 0.655 + $remainder * 1.5;
                        }
                        array_push($amount, $amounts);
                        array_push($distance, $miles);

                    } else {
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
                        array_push($amount, $amounts);
                        array_push($distance, $miles);
                    }

                }
                $amount = array_unique($amount);
                $distance = array_unique($distance);

            }
        }
        $amount = array_sum($amount);
        $distance = array_sum($distance);
        // dd($distance);

        PayReport::create([
            'emp_id' => $emp_id->id,
            'date' => Carbon::now(),
            'pay_period' => $request->from_date .' to '. $request->to_date,
            'total_miles' => $distance- $pay->adj_miles,
            'total_amount' => $amount,
            'no_visits' => $pays->count(),
            'no_patients'=> $patient_count,
            'invoice' => 'INV'.rand(0000000, 9999999),
        ]);
        return back()->with('statusreg','Pay summary added successfully');
    }
}