<?php

namespace App\Http\Controllers;

use App\Models\Vaccination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VaccinationController extends Controller
{
    public function create()
    {
        $patients = DB::table('patients')
        ->join('users', 'patients.user_id', '=', 'users.id')
        ->select([
            'patients.id',
            'users.name as user_name',])
        ->whereNull('patients.deleted_at')    
        ->get(); 
        return view('vaccination.index', ['patients' => $patients]);
    }

    public function store(Request $request)
    {
      
        $attributes = $request->validate([
            'patient_id' => ['required'],
            'vax_Date' => ['required'],
            'vax_Status' => ['required']
        ]);
        Vaccination::create(
            $attributes
        );

        return redirect('/health_worker');
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
