<?php

namespace App\Http\Controllers;
use App\Models\DailyPay;
use App\Models\PayReport;
use App\Models\paysummary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function Index()
    {
        $paysummary = DB::table('paysummaries')->select('employee_id_unique')->distinct()->paginate(10);
        // dd($paysummary);
        return view('report',compact('paysummary'));
    }

    public function invoice(Request $request, $id)
    {
    //    $id = $request->id;

       $pay = PayReport::with('employee')->findOrFail($id);
       $pays= DailyPay::with('patient')
        ->where('emp_id', $pay->emp_id)
        ->where('pay_period_id', $pay->pay_period)
        ->where('pay_report_id', $id)
        ->orderBy('status', 'DESC')
        ->orderBy('visit_date', 'ASC')
        ->paginate(20);
        $rates = \App\Models\UserRate::where('emp_id', $pay->emp_id)->get();
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

        return view('invoice', compact('pay', 'pays', 'rates', 'emp_id', 'app_pat', 'pen_pat', 'app_miles', 'pen_miles', 'app_rates', 'pen_rates'));
    }

}