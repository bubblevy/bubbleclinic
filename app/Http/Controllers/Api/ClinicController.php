<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Carbon\Carbon;

class ClinicController extends Controller
{
    private $namaHari = [
        1 => 'Senin',
        2 => 'Selasa',
        3 => 'Rabu',
        4 => 'Kamis',
        5 => 'Jum\'at',
        6 => 'Sabtu',
        7 => 'Minggu'
    ];
    public function detail()
    {
        try {
            $detailClicic = Application::first();
            $openDays = $this->namaHari[$detailClicic->open_days];
            $closeDays = $this->namaHari[$detailClicic->close_days];
            $openTime = Carbon::createFromFormat('H:i:s', $detailClicic->open_time)->format('H:i');
            $closeTime = Carbon::createFromFormat('H:i:s', $detailClicic->close_time)->format('H:i');
            return response()->json([
                'message' => 'Get detail clinic successfully!',
                'data' => [
                    'name_app' => $detailClicic->name_app,
                    'description_app' => $detailClicic->description_app,
                    'logo' =>  request()->getSchemeAndHttpHost() . "/storage/" . $detailClicic->logo,
                    'address' => $detailClicic->address,
                    'days_operational' => $openDays . " - " . $closeDays,
                    'hours_operational' => $openTime  . " - " . $closeTime,
                ]
            ], 200);
        } catch (QueryException $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, 500);
        }
    }
}
