<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayReport extends Model
{
    use HasFactory;

     protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id', 'id');
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
    public function payperiod()
    {
        return $this->belongsTo(PayPeriod::class, 'pay_period', 'id');

    }
}