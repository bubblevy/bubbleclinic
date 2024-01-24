<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Patient;
use App\Models\QueueNumber;
use Carbon\Carbon;

class ControllerFiles extends Controller
{
    public function index()
    {
        return view('admin.files.index', [
            'app' => Application::all(),
            'title' => 'Importacion de Archivos'
          ]);
    }
}