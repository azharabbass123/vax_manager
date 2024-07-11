<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function create()
    {
        return View('patient.index');
    }
}
