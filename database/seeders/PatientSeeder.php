<?php

namespace Database\Seeders;

use App\Models\Rate;
use App\Models\EmpTime;
use App\Models\Patient;
use App\Models\Setting;
use App\Models\Specialty;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Patient::create([
            'name'=> 'Patient 1',
            'address'=> '300 North Los Angeles Street, Los Angeles, CA, USA',
            'status' => 'Active'
        ]);
        Patient::create([
            'name'=> 'Patient 2',
            'address'=> '50 Hudson Yards, New York, NY, USA',
            'status' => 'Active'
        ]);
        Patient::create([
            'name'=> 'Patient 3',
            'address'=> '360 CHICAGO, North Michigan Avenue, Chicago, IL, USA',
            'status' => 'Active'
        ]);
        EmpTime::create([
            'from_time' => '7:00',
            'to_time' => '8:00',
        ]);
        EmpTime::create([
            'from_time' => '8:00',
            'to_time' => '9:00',
        ]);
        EmpTime::create([
            'from_time' => '9:00',
            'to_time' => '10:00',
        ]);
        EmpTime::create([
            'from_time' => '10:00',
            'to_time' => '11:00',
        ]);
        EmpTime::create([
            'from_time' => '11:00',
            'to_time' => '12:00',
        ]);
        EmpTime::create([
            'from_time' => '12:00',
            'to_time' => '13:00',
        ]);
        EmpTime::create([
            'from_time' => '13:00',
            'to_time' => '14:00',
        ]);
        EmpTime::create([
            'from_time' => '14:00',
            'to_time' => '15:00',
        ]);
        EmpTime::create([
            'from_time' => '15:00',
            'to_time' => '16:00',
        ]);
        EmpTime::create([
            'from_time' => '16:00',
            'to_time' => '17:00',
        ]);
        EmpTime::create([
            'from_time' => '17:00',
            'to_time' => '18:00',
        ]);
        EmpTime::create([
            'from_time' => '18:00',
            'to_time' => '19:00',
        ]);
        EmpTime::create([
            'from_time' => '9:00',
            'to_time' => '18:00',
        ]);
        EmpTime::create([
            'from_time' => '9:00',
            'to_time' => '12:00',
        ]);
        EmpTime::create([
            'from_time' => '13:00',
            'to_time' => '18:00',
        ]);
        Rate::create([
            'name' => 'Regular Visit'
        ]);
        Rate::create([
            'name' => 'SOC'
        ]);
        Specialty::create([
            'name' => 'Insulin '
        ]);
        Specialty::create([
            'name' => 'Wound Vac '
        ]);
        Specialty::create([
            'name' => 'Blood Draw '
        ]);
        Specialty::create([
            'name' => 'Infusion'
        ]);
        Setting::create([
            'multiplier1' => '0.656',
            'multiplier2' => '1.50'
        ]);
    }
}
