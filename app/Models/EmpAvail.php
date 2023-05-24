<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpAvail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function time()
    {
        return $this->belongsTo(EmpTime::class, 'time', 'id');
    }
}