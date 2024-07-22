<?php

namespace App\Http\Controllers;

use App\Http\Requests\Vaccination\CreateVaccinationRequest;
use App\Http\Requests\Vaccination\UpdateVaccinationRequest;
use App\Models\User;
use App\Helpers\UserHelper;
use App\Models\Vaccination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VaccinationController extends Controller
{
    public function create()
    {
        $patients = VaccinationController::trackPatients();
        $userName = Auth::user()->name;
        $userId = Auth::user()->id;
        return view('vaccination.index', ['patients' => $patients->getData()->data, 'userName' => $userName, 'userId' => $userId]);
    }

    public function store(CreateVaccinationRequest $request)
    {
        $attributes = $request->validated();
        Vaccination::create([
            'patient_id' => $request->patient_id,
            'vax_Date' => $request->vax_Date,
            'vax_Status' => $request->vax_Status,
        ]);

        return redirect('/health_worker');
    }

    public function edit($id)
    {
        $vaxData = Vaccination::find($id);
        $userName = Auth::user()->name;
        $userId = Auth::user()->id;
        return view('vaccination.edit', ['vaxData' => $vaxData, 'userName' => $userName, 'userId' => $userId]);
    }

    public function update(UpdateVaccinationRequest $request, $id)
    {
        $request->validated();
        $vaccination = Vaccination::find($id);

        $vaccination->vax_Status = $request->vax_Status;

        $vaccination->save();
        return redirect('/health_worker')->with('status', 'Data updated Successfully');
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
