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
class AdminController extends Controller
{
    public function create()
    {
        return View('admin.index');
    }

    public function fetchHealthWorkers()
    {
        $data = HealthWorker::with(['user.city:id,name', 'user:id,email'])
                        ->select(['id'])
                        ->get(); // Fetch all health workers with related user and city data

        return DataTables::of($data)
            ->addColumn('name', function($row) {
                return $row->user->name ?? 'N/A'; // Access name through the user relationship
            })
            ->addColumn('email', function($row) {
                return $row->user->email ?? 'N/A'; // Access email through the user relationship
            })
            ->addColumn('city_name', function($row) {
                return $row->user->city->name ?? 'N/A'; // Access city name through the user->city relationship
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
        $data = Patient::with(['user.city:id,name', 'user:id,email'])
                        ->select(['patients.id'])
                        ->get(); // Fetch all health workers with related user and city data

        return DataTables::of($data)
            ->addColumn('name', function($row) {
                return $row->user->name ?? 'N/A'; // Access name through the user relationship
            })
            ->addColumn('email', function($row) {
                return $row->user->email ?? 'N/A'; // Access email through the user relationship
            })
            ->addColumn('city_name', function($row) {
                return $row->user->city->name ?? 'N/A'; // Access city name through the user->city relationship
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
        $data = Vaccination::select(['vaccination_id', 'patient_name', 'vaccination_date', 'vaccination_status']);

            return DataTables::of($data)
                ->make(true);
    }
    
    public function fetchAppointments()
    {
        $data = Appointment::select(['id', 'patient_name', 'health_worker_name', 'appointment_date', 'appointment_status']);

            return DataTables::of($data)
                ->make(true);
    }

    public function deleteHW($id)
    {
        HealthWorker::find($id)->delete();

        return response()->json(['success'=>'Health Worker deleted successfully.']);
    }
    public function deletePatient($id)
    {
        Patient::find($id)->delete();

        return response()->json(['success'=>'Patient deleted successfully.']);
    }
}
