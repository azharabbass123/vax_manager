<?php

namespace App\Http\Controllers;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Patient;
use App\Models\Vaccination;
use App\Models\Appointment;
use App\Models\HealthWorker;

class HealthWorkerController extends Controller
{
    public function create()
    {
        return View('health_worker.index');
    }

    static function fetchHwId(){
        $hwId = HealthWorker::select('id')
          ->where('user_id', session('userId'))
          ->first();
    
        return $hwId->id;  
    }

    public function fetchAppointments()
    
    {
        $hw_id = HealthWorkerController::fetchHwId();
        $data = Appointment::with(['patient.user', 'healthWorker.user'])
                            ->where('appointments.hw_id', '=', $hw_id)
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
            ->addColumn('action', function($row) {
                $editBtn = '<a href="/editAppointment/'.$row->id.'" class="btn btn-sm btn-primary">edit</a>';
                return $editBtn;
            })
            ->make(true);
    }

    public function fetchVaccinations()
    {
        $data = Vaccination::with(['patient.user'])
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
                ->addColumn('action', function($row) {
                    $editBtn = '<a href="/editVaccination/'.$row->id.'" class="btn btn-sm btn-primary">edit</a>';
                    return $editBtn;
                })
                ->make(true);
    }

    public function trackPatients(){
        $hw_province = User::with(['city.province'])
                            ->where('users.id', session('userId'))
                            ->first();
        
        $hw_prv_id = $hw_province->city->province->id;

        return HealthWorkerController::fetchPatients($hw_prv_id);
    }

    private function fetchPatients($province_id){
        $trackedPatients = Patient::with(['user.city.province', 'vaccinations']) // Eager load relationships
                                    ->whereHas('user.city.province', function ($query) use ($province_id) {
                                        $query->where('id', $province_id);
                                    })
                                    ->get();

            return DataTables::of($trackedPatients)
                                ->addColumn('patient_name', function($row) {
                                    return $row->user->name ?? 'N/A';
                                })
                                ->addColumn('patient_email', function($row) {
                                    return $row->user->email ?? 'N/A';
                                })
                                ->addColumn('city_name', function($row) {
                                    return $row->user->city->name ?? 'N/A';
                                })
                                ->addColumn('province_name', function($row) {
                                    return $row->user->city->province->name ?? 'N/A';
                                })
                                ->addColumn('vax_date', function($row){
                                    return $row->vaccinations['0']->vax_Date ?? 'NA';
                                })
                                ->addColumn('vax_status', function($row){
                                    return $row->vaccinations['0']->vax_Status ?? 'NA';
                                })
                                ->addColumn('action', function($row) {
                                    $btn = '<button type="button" onclick="deletePatient('.$row->id.')" class="btn btn-sm btn-danger">Delete</button>';
                                    return $btn;
                                })
                                ->rawColumns(['action'])
                                ->make(true);
    }
}
