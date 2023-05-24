<?php

namespace App\Http\Controllers;

use App\Models\DailyPay;
use App\Models\Registry;
use App\Models\PayReport;
use App\Models\Employee;
use Illuminate\Http\Request;

class PayController extends Controller
{
    public function Index(Request $request)
    {

        $query = PayReport::query();
        $data = $request->all();
        if($request->period)
        {
            $query= $query->where('pay_period', $request->period);
        }
        if($request->year)
        {
            $query= $query->where('year', $request->year);
        }
        $paysummaries = $query->with('employee')->latest()->paginate(20);
        $payperiod = $request->period ?? null;
        $year = $request->year ?? null;
        return view('pay', compact('paysummaries','payperiod', 'year'));
    }

    public function ApproveInvoice(Request $request, $id)
    {
        $invoices = DailyPay::where('pay_report_id', $id)->get();
        foreach ($invoices as $key => $invoice) {
            $invoice->status = 'Approved';
            $invoice->save();
        }
        $reports = PayReport::findOrFail($id);
        $reports->status = 'Approved';
        $reports->save();

        return back()->with('status', 'Invoice has been approved successfully');

    }

    public function ReturnInvoice(Request $request, $id)
    {
        $invoices = DailyPay::where('pay_report_id', $id)->get();
        foreach ($invoices as $key => $invoice) {
            $invoice->status = 'Returned';
            $invoice->save();
        }
        $reports = PayReport::findOrFail($id);
        $reports->status = 'Returned';
        $reports->save();

        return back()->with('status', 'Invoice has been returned successfully');

    }

    public function paysummary(Request $request, $id)
    {
        //get input from form
        $date = $request->date;
        $visits = $request->visits;
        $numberofmiles = $request->numberofmiles;
        $numberofvisits = $request->numberofvisits;
        $status = $request->status;


        //add to paysummary table
       $pay = PayReport::findOrFail($id);
            $pay->status =  $status;
            $pay->save();
        return back();
    }

    public function UpdatePay(Request $request, $id)
    {
        $pay= DailyPay::findOrFail($id);
        $pay->visit_type =$request->visit_type;
        $pay->visit_rate = $request->visit_rate;
        $pay->save();

        return back()->with('status', 'Pay record updated successfully');
    }
    public function DeleteInvoice($id)
    {
        $pay = PayReport::findOrFail($id);
            $pay->delete();
        return back()->with('status', 'Invoice deleted successfully');
    }
}