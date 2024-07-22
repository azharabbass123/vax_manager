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
        $data = HealthWorker::with('user.city') // Eager load user and city relationships
            ->get();

        return DataTables::of($data)
            ->addColumn('name', function ($row) {
                return $row->user->name ?? 'N/A';
            })
            ->addColumn('email', function ($row) {
                return $row->user->email ?? 'N/A';
            })
            ->addColumn('city_name', function ($row) {
                return $row->user->city->name ?? 'N/A';
            })
            ->addColumn('action', function ($row) {
                $btn = '<button type="button" onclick="deleteHw(' . $row->id . ')" class="btn btn-sm btn-danger">Delete</button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function fetchPatients()
    {
        $data = Patient::with('user.city')
            ->get();

        return DataTables::of($data)
            ->addColumn('name', function ($row) {
                return $row->user->name ?? 'N/A';
            })
            ->addColumn('email', function ($row) {
                return $row->user->email ?? 'N/A';
            })
            ->addColumn('city_name', function ($row) {
                return $row->user->city->name ?? 'N/A';
            })
            ->addColumn('action', function ($row) {
                $btn = '<button type="button" onclick="deletePatient(' . $row->id . ')" class="btn btn-sm btn-danger">Delete</button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function fetchVaccinations()
    {
        $data = Vaccination::with(['patient.user'])
            ->get();

        return DataTables::of($data)
            ->addColumn('patient_name', function ($row) {
                return $row->patient->user->name ?? 'NA';
            })
            ->addColumn('vax_date', function ($row) {
                return $row->vax_Date ?? 'NA';
            })
            ->addColumn('vax_status', function ($row) {
                return $row->vax_Status ?? 'NA';
            })
            ->make(true);
    }

    public function fetchAppointments()

    {
        $data = Appointment::with(['patient.user', 'healthWorker.user'])
            ->get();
        return DataTables::of($data)
            ->addColumn('patient_name', function ($row) {
                return $row->patient->user->name ?? 'NA';
            })
            ->addColumn('health_worker_name', function ($row) {
                return $row->healthWorker->user->name ?? 'NA';
            })
            ->addColumn('appointment_date', function ($row) {
                return $row->apt_Date ?? 'NA';
            })
            ->addColumn('appointment_status', function ($row) {
                return $row->apt_Status ?? 'NA';
            })
            ->make(true);
    }

    public function fetchBlockedUsers()
    {
        $users = User::select('id', 'name', 'role_id')
            ->onlyTrashed()
            ->get();

        return DataTables::of($users)
            ->addColumn('role_id', function ($row) {
                return ($row->role_id == 2) ? 'Health Worker' : 'Patient';
            })
            ->addColumn('action', function ($row) {
                $btn = '<button type="button" onclick="unBlockUsers(' . $row->id . ')" class="btn btn-sm btn-success">Restore</button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function showBlockedUsers()
    {
        return View('admin.blockedUsers');
    }
    public function deleteHW($id)
    {
        $healthWorker = HealthWorker::find($id);

        if (!$healthWorker) {
            return response()->json(['error' => 'Health Worker not found.'], 404);
        }

        $healthWorker->delete();
        $healthWorker->user()->delete();

        $healthWorker->appointments()->delete();

        return response()->json(['success' => 'Health Worker and associated user soft deleted successfully.']);
    }
    public function deletePatient($id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['error' => 'Patient not found.'], 404);
        }

        $patient->delete();
        $patient->user()->delete();

        $patient->appointments()->delete();
        $patient->vaccinations()->delete();


        return response()->json(['success' => 'Patient and associated user soft deleted successfully.']);
    }

    public function unBlockUser($id)
    {
        $user = User::withTrashed()->find($id);
        if ($user->role_id == 2) {
            return AdminController::restoreHw($user->id);
        } else {
            return AdminController::restorePatient($user->id);
        }
    }

    private function restoreHw($userId)
    {
        $health_worker = HealthWorker::withTrashed()
            ->where('user_id', $userId)
            ->first();

        $health_worker->restore();
        $health_worker->user()->restore();

        $health_worker->appointments()->restore();

        return response()->json(['success' => 'Health Worker and associated user restored success']);
    }
    private function restorePatient($userId)
    {
        $patient = Patient::withTrashed()
            ->where('user_id', $userId)
            ->first();

        $patient->restore();
        $patient->user()->restore();

        $patient->appointments()->restore();
        $patient->vaccinations()->restore();

        return response()->json(['success' => 'Patient and associated user restored successfully.']);
    }
}
