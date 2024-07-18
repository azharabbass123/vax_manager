<?php

namespace App\Http\Controllers;
use App\Models\Vaccination;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Appointment;

class PatientController extends Controller
{
    public function create()
    {
        return View('patient.index');
    }
    static function fetchPatientId(){
        $patientId = Patient::select('id')
          ->where('user_id', session('userId'))
          ->first();
    
        return $patientId->id;  
    }

    public function fetchAppointments()
    
    {
        $patient_id = PatientController::fetchPatientId();
        $data = Appointment::with(['patient.user', 'healthWorker.user'])
                            ->where('appointments.patient_id', '=', $patient_id)
                            ->get();

        return DataTables::of($data)
            ->addColumn('patient_name', function($row) {
                return $row->patient->user->name ?? 'NA';
            })
            ->addColumn('health_worker_name', function($row) {
                return $row->healthWorker->user->name ?? 'NA';
            })
            ->addColumn('appointment_date', function($row) {
                return $row->apt_Date ?? 'NA';
            })
            ->addColumn('appointment_status', function($row) {
                return $row->apt_Status ?? 'NA';
            })
            ->make(true);
    }
    public function fetchVaccinations()
    {
        $patient_id = PatientController::fetchPatientId();
        $data = Vaccination::with(['patient.user'])
                        ->where('vaccinations.patient_id', '=', $patient_id)
                        ->get();
                            

            return DataTables::of($data)
                ->addColumn('patient_name', function($row){
                    return $row->patient->user->name ?? 'NA';
                })
                ->addColumn('vax_date', function($row){
                    return $row->vax_Date ?? 'NA';
                })
                ->addColumn('vax_status', function($row){
                    return $row->vax_Status ?? 'NA';
                })
                ->make(true);
    }

}
