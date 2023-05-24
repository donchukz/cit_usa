<?php

namespace App\Http\Livewire;

use App\Models\Patient;
use Livewire\Component;
use App\Models\DailyPay;
use App\Models\Employee;
use App\Models\Registry;

class PayFilter extends Component
{
    public $from_date = "";
    public $to_date = "";
    public function render()
    {
        $pays = DailyPay::latest()->paginate(10);
        if(!empty($this->from_date) && !empty($this->to_date)){
                $pays->whereBetween('visit_date', [$this->from_date, $this->to_date]);
           }
           $pays = $pays->paginate(10);

        $patients=Patient::get();
        $employee = Employee::where('user_id',auth()->user()->id)->first();
        $Registry = Registry::where('user_id',auth()->user()->id)->first();
        // $paysu= DailyPay::where('emp_id',$employee->id)->latest()->paginate(20);

        return view('employeeAccount',[
            'employee'=>$employee,
            'registries'=>$Registry,
            'pays'=>$pays,
            'patients'=>$patients,
        ]);
    }
}