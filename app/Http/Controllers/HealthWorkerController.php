<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patient;
use App\Helpers\UserHelper;
use App\Models\Appointment;
use App\Models\Vaccination;
use App\Models\HealthWorker;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HealthWorkerController extends Controller
{
    public function create()
    {
        return View('health_worker.index');
    }

    static function fetchHwId()
    {
        $hwId = HealthWorker::select('id')
            ->where('user_id', Auth::user()->role_id)
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
            ->addColumn('action', function ($row) {
                $editBtn = '<a href="/editAppointment/' . $row->id . '" class="btn btn-sm btn-primary">edit</a>';
                return $editBtn;
            })
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
            ->addColumn('action', function ($row) {
                $editBtn = '<a href="/editVaccination/' . $row->id . '" class="btn btn-sm btn-primary">edit</a>';
                return $editBtn;
            })
            ->make(true);
    }
    public function trackPatients()
    {
        $hw_province = User::with(['city.province'])
            ->where('users.id', Auth::user()->role_id)
            ->first();

        $hw_prv_id = $hw_province->city->province->id;

        return UserHelper::fetchPatients($hw_prv_id);
    }
}
