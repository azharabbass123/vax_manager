<?php

namespace App\Http\Controllers;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function create()
    {
        return View('patient.index');
    }
    static function fetchPatientId(){
        $patientId = DB::table('users')
          ->join('patients', 'users.id', '=', 'patients.user_id')
          ->where('users.id', '=', session('userId'))
          ->select('patients.id')
          ->get();
    
        return $patientId['0']->id;  
    }

    public function fetchAppointments()
    
    {
        $patient_id = PatientController::fetchPatientId();
        $data = DB::table('appointments')
                ->join('patients', 'appointments.patient_id', '=', 'patients.id')
                ->join('users as patient_users', 'patients.user_id', '=', 'patient_users.id')
                ->join('health_workers', 'appointments.hw_id', '=', 'health_workers.id')
                ->join('users as hw_users', 'health_workers.user_id', '=', 'hw_users.id')
                ->select([
                    'appointments.id',
                    'patient_users.name as patient_name',
                    'hw_users.name as health_worker_name',
                    'appointments.apt_Date as appointment_date',
                    'appointments.apt_Status as appointment_status'
                ])
                ->where('appointments.patient_id', '=', $patient_id)
                ->get();

        return DataTables::of($data)
            ->addColumn('patient_name', function($row) {
                return $row->patient_name ?? 'NA';
            })
            ->addColumn('health_worker_name', function($row) {
                return $row->health_worker_name ?? 'NA';
            })
            ->addColumn('appointment_date', function($row) {
                return $row->appointment_date ?? 'NA';
            })
            ->addColumn('appointment_status', function($row) {
                return $row->appointment_status ?? 'NA';
            })
            ->make(true);
    }
    public function fetchVaccinations()
    {
        $patient_id = PatientController::fetchPatientId();
        $data = DB::table('vaccinations')
                        ->join('patients', 'vaccinations.patient_id', '=', 'patients.id')
                        ->join('users', 'patients.user_id', '=', 'users.id')
                        ->select([
                            'vaccinations.id',
                            'users.name as patient_name',
                            'vaccinations.vax_Date as vax_date', 
                            'vaccinations.vax_Status as vax_status'])
                            ->where('vaccinations.patient_id', '=', $patient_id)
                            ->get();
                            

            return DataTables::of($data)
                ->addColumn('patient_name', function($row){
                    return $row->patient_name ?? 'NA';
                })
                ->addColumn('vax_date', function($row){
                    return $row->vax_date ?? 'NA';
                })
                ->addColumn('vax_status', function($row){
                    return $row->vax_status ?? 'NA';
                })
                ->make(true);
    }

}
