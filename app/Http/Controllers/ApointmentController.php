<?php

namespace App\Http\Controllers;

use App\Http\Requests\Appointment\CreateAppointmentRequest;
use App\Http\Requests\Appointment\UpdateAppointmentRequest;
use App\Models\User;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ApointmentController extends Controller
{
    public function create()
    {
        $userName = Auth::user()->name;
        $userId = Auth::user()->id;
        return View('appointment.index', ['userName' => $userName, 'userId' => $userId]);
    }

    public function store(CreateAppointmentRequest $request)
    {

        $attributes = $request->validated();
        $patientId = Patient::select('id')
            ->where('user_id', $request->patient_id)
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
        $userName = Auth::user()->name;
        $userId = Auth::user()->id;
        return view('appointment.edit', ['aptData' => $aptData, 'userName' => $userName, 'userId' => $userId]);
    }

    public function update(UpdateAppointmentRequest $request, $id)
    {
        $request->validated();
        $appointment = Appointment::find($id);

        $appointment->apt_Status = $request->apt_Status;

        $appointment->save();
        return redirect('/health_worker')->with('status', 'Data updated Successfully');
    }
}
