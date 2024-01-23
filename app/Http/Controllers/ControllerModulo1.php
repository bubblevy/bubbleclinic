<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Patient;
use App\Models\QueueNumber;
use Carbon\Carbon;

class ControllerModulo1 extends Controller
{
    public function index()
    {
        return view('admin.modulo1.index', [
            'app' => Application::all(),
            'title' => 'Pengaturan'
          ]);
    }
}