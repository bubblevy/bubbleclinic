<?php

namespace App\Http\Controllers;

use App\Charts\MonthlyPatientsChart;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Patient;
use Illuminate\Support\Carbon;

class AdminDashboardController extends Controller
{

    public function index(MonthlyPatientsChart $chart)
    {
        $currentMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        return view('admin.dashboard.index', [
            'app' => Application::all(),
            'title' => 'Dashboard',
            'totalLakiLaki' => Patient::where('gender', 'Laki-Laki')->whereNotNull('queue_number_id')->count(),
            'totalPerempuan' => Patient::where('gender', 'Perempuan')->whereNotNull('queue_number_id')->count(),
            'patients' => Patient::with(['queueNumber'])->orderby('queue_number_id', 'asc')->whereNotNull('queue_number_id')->take(4)->get(),
            'patientsToday' => Patient::where('queue_number_id', null)->whereDate('created_at', now()->toDateString())->count(),
            'patientsYesterday' => Patient::where('queue_number_id', null)->whereDate('created_at', now()->subDay()->toDateString())->count(),
            'patientsMonthly' => Patient::where('queue_number_id', null)->whereBetween('created_at', [$currentMonth, $endOfMonth])->count(),
            'totalPatient' => Patient::where('queue_number_id', null)->count(),
            'numberQueueNow' => Patient::with(['queueNumber'])->orderby('queue_number_id', 'asc')->whereNotNull('queue_number_id')->first(),
            'chart' => $chart->build()
        ]);
    }
}
