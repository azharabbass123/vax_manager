<?php

namespace App\Http\Controllers;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use  App\Models\Patient;

class HealthWorkerController extends Controller
{
    public function create()
    {
        return View('health_worker.index');
    }

    static function fetchHwId(){
        $hwId = DB::table('users')
          ->join('health_workers', 'users.id', '=', 'health_workers.user_id')
          ->where('users.id', '=', session('userId'))
          ->select('health_workers.id')
          ->get();
    
        return $hwId['0']->id;  
    }

    public function fetchAppointments()
    
    {
        $hw_id = HealthWorkerController::fetchHwId();
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
                ->where('appointments.hw_id', '=', $hw_id)
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
            ->addColumn('action', function($row) {
                $editBtn = '<a href="/editAppointment/'.$row->id.'" class="btn btn-sm btn-primary">edit</a>';
                return $editBtn;
            })
            ->make(true);
    }

    public function fetchVaccinations()
    {
        $data = DB::table('vaccinations')
                        ->join('patients', 'vaccinations.patient_id', '=', 'patients.id')
                        ->join('users', 'patients.user_id', '=', 'users.id')
                        ->select([
                            'vaccinations.id',
                            'users.name as patient_name',
                            'vaccinations.vax_Date as vax_date', 
                            'vaccinations.vax_Status as vax_status'])
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
                ->addColumn('action', function($row) {
                    $editBtn = '<a href="/editVaccination/'.$row->id.'" class="btn btn-sm btn-primary">edit</a>';
                    return $editBtn;
                })
                ->make(true);
    }

    public function trackPatients(){
        $hw_province = DB::table('users')
                            ->join('cities', 'cities.id', '=', 'users.city_id')
                            ->join('provinces', 'provinces.id', '=', 'cities.province_id')
                            ->select('provinces.id')
                            ->where('users.id', '=', session('userId'))
                            ->get();
        
         $hw_prv_id = $hw_province['0']->id;

        return HealthWorkerController::fetchPatients($hw_prv_id);
    }

    private function fetchPatients($province_id){
        $trackedPatients = DB::table('patients')
                                ->join('users', 'patients.user_id', '=', 'users.id')
                                ->join('cities', 'users.city_id' , '=', 'cities.id')
                                ->join('provinces', 'cities.province_id', '=', 'provinces.id')
                                ->leftJoin('vaccinations', 'patients.id', '=', 'vaccinations.patient_id')
                                ->where('provinces.id', '=', $province_id)
                                ->select('users.id AS id',
                                    'users.id AS patient_id',
                                'users.name AS patient_name',
                                'users.email AS patient_email',
                                'cities.name AS city_name',
                                'provinces.name AS province_name',
                                'vaccinations.vax_Date AS vax_date',
                                'vaccinations.vax_Status AS vax_status')
                                ->get();

            return DataTables::of($trackedPatients)
                                ->addColumn('patient_name', function($row) {
                                    return $row->patient_name ?? 'N/A';
                                })
                                ->addColumn('patient_email', function($row) {
                                    return $row->patient_email ?? 'N/A';
                                })
                                ->addColumn('city_name', function($row) {
                                    return $row->city_name ?? 'N/A';
                                })
                                ->addColumn('province_name', function($row) {
                                    return $row->province_name ?? 'N/A';
                                })
                                ->addColumn('vax_date', function($row){
                                    return $row->vax_date ?? 'NA';
                                })
                                ->addColumn('vax_status', function($row){
                                    return $row->vax_status ?? 'NA';
                                })
                                ->addColumn('action', function($row) {
                                    $btn = '<button type="button" onclick="deletePatient('.$row->id.')" class="btn btn-sm btn-danger">Delete</button>';
                                    return $btn;
                                })
                                ->rawColumns(['action'])
                                ->make(true);
    }
}
