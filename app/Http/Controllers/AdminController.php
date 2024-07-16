<?php

namespace App\Http\Controllers;
use App\Models\Appointment;
use App\Models\HealthWorker;
use App\Models\Patient;
use App\Models\Vaccination;
use App\Models\User;
use App\Models\City;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    public function create()
    {
        return View('admin.index');
    }

    public function fetchHealthWorkers()
{
    $data = DB::table('health_workers')
                ->join('users', 'health_workers.user_id', '=', 'users.id')
                ->leftJoin('cities', 'users.city_id', '=', 'cities.id')
                ->select([
                    'health_workers.id',
                    'users.name as user_name',
                    'users.email as user_email',
                    'cities.name as city_name'
                ])
                ->whereNull('health_workers.deleted_at')
                ->get();

        return DataTables::of($data)
            ->addColumn('name', function($row) {
                return $row->user_name ?? 'N/A';
            })
            ->addColumn('email', function($row) {
                return $row->user_email ?? 'N/A';
            })
            ->addColumn('city_name', function($row) {
                return $row->city_name ?? 'N/A';
            })
            ->addColumn('action', function($row) {
                $btn = '<button type="button" onclick="deleteHw('.$row->id.')" class="btn btn-sm btn-danger">Delete</button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
}
    
    public function fetchPatients()
    {
        $data = DB::table('patients')
                        ->join('users', 'patients.user_id', '=', 'users.id')
                        ->leftJoin('cities', 'users.city_id', '=', 'cities.id')
                        ->select([
                            'patients.id',
                            'users.name as user_name',
                            'users.email as user_email',
                            'cities.name as city_name'])
                        ->whereNull('patients.deleted_at')    
                        ->get(); // Fetch all health workers with related user and city data

                        return DataTables::of($data)
                        ->addColumn('name', function($row) {
                            return $row->user_name ?? 'N/A';
                        })
                        ->addColumn('email', function($row) {
                            return $row->user_email ?? 'N/A';
                        })
                        ->addColumn('city_name', function($row) {
                            return $row->city_name ?? 'N/A';
                        })
                        ->addColumn('action', function($row) {
                            $btn = '<button type="button" onclick="deletePatient('.$row->id.')" class="btn btn-sm btn-danger">Delete</button>';
                            return $btn;
                        })
                        ->rawColumns(['action'])
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
                ->make(true);
    }
    
    public function fetchAppointments()
    
    {
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

    public function fetchBlockedUsers(){
        $users = User::select('id', 'name', 'role_id')
                        ->onlyTrashed()
                        ->get();

        return DataTables::of($users)
        ->addColumn('role_id', function($row) {
            return ($row->role_id == 2) ? 'Health Worker' : 'Patient';
        })
        ->addColumn('action', function($row) {
            $btn = '<button type="button" onclick="unBlockUsers('.$row->id.')" class="btn btn-sm btn-success">Restore</button>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
    
    public function showBlockedUsers(){
        return View('admin.blockedUsers');
    }
    public function deleteHW($id)
    {
        $healthWorker = HealthWorker::find($id);

    if (!$healthWorker) {
        return response()->json(['error' => 'Health Worker not found.'], 404);
    }

    DB::transaction(function () use ($healthWorker) {
        // Soft delete the health worker and related user
        $healthWorker->delete();
        $healthWorker->user()->delete(); // Assuming 'user' is the relationship method

        // If you have other related models, you may soft delete them here too
        $healthWorker->appointments()->delete();
    });

    return response()->json(['success' => 'Health Worker and associated user soft deleted successfully.']);
}
    public function deletePatient($id)
    {
        $patient = Patient::find($id);

    if (!$patient) {
        return response()->json(['error' => 'Patient not found.'], 404);
    }

    DB::transaction(function () use ($patient) {
        // Soft delete the patient and related user
        $patient->delete();
        $patient->user()->delete(); // Assuming 'user' is the relationship method

        // If you have other related models, you may soft delete them here too
        $patient->appointments()->delete();
        $patient->vaccinations()->delete();
    });

    return response()->json(['success' => 'Patient and associated user soft deleted successfully.']);
}

    public function unBlockUser($id){
        $user = User::withTrashed()->find($id);
        if($user->role_id == 2){
            return AdminController::restoreHw($user->id);
        }
        else{
            return AdminController::restorePatient($user->id);
        }
    }

    private function restoreHw($userId){
        $health_worker = HealthWorker::withTrashed()
                            ->where('user_id', $userId)
                            ->first();
        DB::transaction(function () use ($health_worker) {
            // Restore the patient and associated user
            $health_worker->restore();
            $health_worker->user()->restore(); // Assuming 'user' is the relationship method
    
            // If there are other related models, restore them here too
            $health_worker->appointments()->restore();
        });
    
        return response()->json(['success' => 'Health Worker and associated user restored success']);    

    }
    private function restorePatient($userId){
        $patient = Patient::withTrashed()
                            ->where('user_id', $userId)
                            ->first();

        DB::transaction(function () use ($patient) {
            // Restore the patient and associated user
            $patient->restore();
            $patient->user()->restore(); // Assuming 'user' is the relationship method
    
            // If there are other related models, restore them here too
            $patient->appointments()->restore();
            $patient->vaccinations()->restore();
        });
    
        return response()->json(['success' => 'Patient and associated user restored successfully.']);
    
    }
}
