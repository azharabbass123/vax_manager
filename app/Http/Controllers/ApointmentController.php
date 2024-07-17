<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ApointmentController extends Controller
{
    public function create()
    {
        return View('appointment.index');
    }

    public function store(Request $request)
    {
      
        $attributes = $request->validate([
            'patient_id' => ['required'],
            'hw_id' => ['required'],
            'apt_Date' => ['required'],
            'apt_Status' => ['required']
        ]);
      $patientId = User::select('patients.id')
          ->join('patients', 'users.id', '=', 'patients.user_id')
          ->where('users.id', '=', $request->patient_id)
          ->get();
        Appointment::create([
            'patient_id' => $patientId['0']->id,
            'hw_id' => $request->hw_id,
            'apt_Date' => $request->apt_Date,
            'apt_Status' => $request->apt_Status
        ]);

        return redirect('/patient');
    }

    public function edit($id)
    {
        $aptData = Appointment::find($id);
        return view('appointment.edit', ['aptData' => $aptData]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'apt_Status' => ['required'],
        ]);
        $appointment = Appointment::find($id);

        $appointment->apt_Status = $request->apt_Status;

        $appointment->save();
        return redirect('/health_worker')->with('status', 'Data updated Successfully');


    }
}
