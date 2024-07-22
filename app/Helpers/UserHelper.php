<?php


namespace App\Helpers;


use App\Models\Patient;
use Yajra\DataTables\DataTables;

class UserHelper
{

    public static function fetchPatients($province_id)
    {
        $trackedPatients = Patient::with(['user.city.province', 'vaccinations']) // Eager load relationships
            ->whereHas('user.city.province', function ($query) use ($province_id) {
                $query->where('id', $province_id);
            })
            ->get();

        return DataTables::of($trackedPatients)
            ->addColumn('patient_name', function ($row) {
                return $row->user->name ?? 'N/A';
            })
            ->addColumn('patient_email', function ($row) {
                return $row->user->email ?? 'N/A';
            })
            ->addColumn('city_name', function ($row) {
                return $row->user->city->name ?? 'N/A';
            })
            ->addColumn('province_name', function ($row) {
                return $row->user->city->province->name ?? 'N/A';
            })
            ->addColumn('vax_date', function ($row) {
                return $row->vaccinations['0']->vax_Date ?? 'NA';
            })
            ->addColumn('vax_status', function ($row) {
                return $row->vaccinations['0']->vax_Status ?? 'NA';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
