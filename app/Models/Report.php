<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $guarded = [];

     public function user()
    {
        return $this->belongsTo(User::class);

    }

    public function payperiod()
    {
        return $this->belongsTo(PayPeriod::class);

    }
}