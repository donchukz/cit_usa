<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class registry extends Model
{
    use HasFactory;

     protected $guarded = [];

    public function employ()
    {
        return $this->belongsTo(addEmployee::class, 'employee_id', 'id');
    }
}