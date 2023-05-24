<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\registry;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class);

    }

    public function registry()
    {
        return $this->hasOne(registry::class);
    }

    public function empAvail()
    {
        return $this->belongsTo(EmpAvail::class, 'emp_availability', 'id');
    }

    public function rate()
    {
        return $this->belongsTo(UserRate::class, 'visit_rate', 'id');
    }
}
