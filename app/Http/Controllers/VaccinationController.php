<?php

namespace App\Http\Controllers;

use App\Models\Vaccination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HealthWorkerController;

class VaccinationController extends Controller
{
    public function create()
    {
        $hwController = new HealthWorkerController();
        $patients = $hwController->trackPatients();
        return view('vaccination.index', ['patients' => $patients->getData()->data]);
    }

    public function store(Request $request)
    {
        dd('yes');

        $attributes = $request->validate([
            'patient_id' => ['required'],
            'vax_Date' => ['required'],
            'vax_Status' => ['required']
        ]);
        Vaccination::create(
            $attributes
        );

        return redirect()->route('health_worker');
    }

    public function edit($id)
    {
        $vaxData = Vaccination::find($id);
        return view('vaccination.edit', ['vaxData' => $vaxData]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'vax_Status' => ['required'],
        ]);
        $vaccination = Vaccination::find($id);

        $vaccination->vax_Status = $request->vax_Status;

        $vaccination->save();
        return redirect('/health_worker')->with('status', 'Data updated Successfully');
    }
}
