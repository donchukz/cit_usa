<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Report;

use App\Models\patients;

use App\Models\registry;

use App\Models\paysummary;

use App\Models\addEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class RegistryController extends Controller
{
    // //function to logout after 5 minutes
    // function logoutAfterFiveMinutes()
    // {
    //        $timeout = 5; // Set timeout minutes
    //        $logout_redirect_url = "/"; // Set logout URL

    //        $timeout = $timeout * 60; // Converts minutes to seconds
    //        if (isset($_SESSION['start_time'])) {
    //            $elapsed_time = time() - $_SESSION['start_time'];
    //            if ($elapsed_time >= $timeout) {
    //                session_destroy();
    //                echo "<script>alert('Your session has expired!')</script>";
    //                echo "<script>window.location.href='$logout_redirect_url'</script>";
    //            }
    //        }
    //        $_SESSION['start_time'] = time();

    // }

   //get all registry
    public function getRegistry(Request $request)
    {
        Session::put('start_date', request('start_date'));
        Session::put('end_date', request('end_date'));
        Session::put('employee', request('employee'));
        $pays = paysummary::query();
        $data = $request->all();
        if($request->start_date && $request->end_date){
            $pays = $pays->whereBetween('date', [$request->start_date,$request->end_date]);
        }
         if($request->employee)
        {
            $pays = $pays->where('user_id', request('employee'));
        }
        $pays = $pays->latest()->paginate(20);
        // dd($pays);
        $start_date = $request->start_date ?? null;
        $end_date = $request->end_date ?? null;

        // $employees=addEmployee::join('paysummaries','employee_id_unique','=','add_employees.id')->join('registries','employee_id','=','registries.employee_id')
        // ->select('add_employees.*','registries.typeofemployment','registries.registrytype','add_employees.name','add_employees.status',
        // 'paysummaries.patient_name','paysummaries.rate','paysummaries.date','paysummaries.typeofvisit','paysummaries.totalrate','paysummaries.milesusd',
        // 'paysummaries.comments','paysummaries.totalrate','paysummaries.id','registries.id')->distinct()->paginate(20);
        $registries = registry::with('employ')->latest()->paginate(20);


        // selecting employees to create pay summary
        $raw_employees = addEmployee::select('id','name')->where('user_id',auth()->user()->id)->get();


        return view('registry',[
            'registries'=>$registries,
            'pays'=>$pays,
            'raw_employees' => $raw_employees,

        ]);
    }


    public function paysummary(Request $request)
    {
        //get input from form
        $date = $request->date;
        $rate = $request->rate;
        $visits = $request->visits;
        $numberofmiles = $request->numberofmiles;
        $totalrate = $request->totalrate;
        $ratetype=$request->checkht." ".$request->checkwe;
        $patientname=$request->patientname;
        $comments = $request->comments;
        $typeofvisit = $request->typeofvisit;
        $miles = $request->miles;
               //dd($request->all());

       //find current employee id
         $employee_id_unique = addEmployee::where('user_id',auth()->user()->id)->where('id',$request->employee_id)->first()->id;

        //validate input
        // $this->validate($request, [
        //     'date'=>'required|max:255',
        //     'rate'=>'required|max:100',
        //     'numberofvisits'=>'required|max:20',
        //     'numberofmiles'=>'required|max:100',
        //     'totalrate'=>'required|max:100',
        //     'comments'=>'required|max:100',
        //     'typeofvisit'=>'required|max:100',
        //     'miles'=>'required|max:100',
        // ]);

        //add to paysummary table
       paysummary::firstOrCreate([
            'user_id'=>auth()->id(),
            'patient_name'=>$patientname,
            'employee_id_unique'=>$employee_id_unique,
            'date'=>$date,
            'rate'=>$rate,
            'numberofvisits'=>$visits,
            'numberofmiles'=>$numberofmiles,
            'totalrate'=>$totalrate,
            'ratetype'=>$ratetype,
            'comments'=>$comments,
            'typeofvisit'=>$typeofvisit,
            'milesusd'=>$miles,
            'status'=> 'pending',
        ]);
        //add to patients table
        patients::firstOrCreate([
            'user_id'=>auth()->id(),
            'employee_id'=>$employee_id_unique,
            'patient_name'=>$patientname,
            'numberofvisits'=>floatval($visits),

        ]);
        return back()->with('statusreg','Paysummary added successfully');
    }
    public function UpdateRegistry(Request $request, $rid)
    {

        //dd($request->all(), $rid);
       //update details

        //  addEmployee::where('id',$employee->id)->update([
        //   'name'=>request()->name_update,
        //   'position'=>request()->position_update,
        //   'date'=>request()->date_update,
        //   'hourlyrate'=>request()->hourlyrate_update,
        //   'position'=>request()->position_update,
        //   'rate'=>request()->rate_update,
        //   'status'=>request()->$employee->status_update,

        //  ]);
        //update employee details
        registry::where('id',$rid)->update([
          'typeofemployment'=>request()->typeofemployment,
          'registrytype'=>request()->registrytype,
              'status'=>request()->status,]);


            //   $registry = registry::find($rid);
            //   $registry->typeofemployment = $request->typeofemployment;
            //   $registry->registrytype = $request->registrytype;
            //   $registry->status=$request->status;
            //   $registry->save();

         return redirect()->back()->with('statusreg','Registry Updated Successfully');
       }

       public function AddReport(Request $request)
       {
        // dd($request->all());
        $report = new Report;
        $report->employee_id = request('user_id');
        $report->total_patients = request('total_patients');
        $report->total_visits = request('total_visits');
        $report->total_hours = request('total_hours');
        $report->total_amount = request('total_amount');
        $report->total_mileage = request('total_mileage');
        $report->date_range = request('date_range');
        $report->invoice = 'PAYINV'.rand(0000000, 9999999);
        $report->save();

        return back();
       }

       public function Report( Request $request)
       {
        $reports = Report::latest()->paginate(10);

        return view('report', compact('reports'));
       }

       public function EditReport(Request $request, $id)
       {
        $report = Report::findOrFail($id);
        $report->comments = request('comments');
        $report->status = request('status');
        $report->save();

        return back();
       }

}