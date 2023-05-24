<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyPay extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class);

    }
    public function payperiod()
    {
        return $this->belongsTo(PayPeriod::class);

    }
    public function userRate()
    {
        return $this->belongsTo(UserRate::class);

    }
}