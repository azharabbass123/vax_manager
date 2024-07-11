<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HealthWorkerController extends Controller
{
    public function create()
    {
        return View('health_worker.index');
    }
}
