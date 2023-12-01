<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\Application;
use App\Models\QueueNumber;

class PatientsController extends Controller
{

    public function store(Request $request)
    {
        try {
            $jamOperasional = Application::select('open_time', 'close_time', 'open_days', 'close_days')->first();
            $waktuSekarang = Carbon::now();
            $jamTutup = Carbon::createFromFormat('H:i:s', $jamOperasional->close_time, 'Asia/Jakarta');
            $jamBuka = Carbon::createFromFormat('H:i:s', $jamOperasional->open_time, 'Asia/Jakarta');

            $hariIni = $waktuSekarang->dayOfWeek;

            $hariBuka = $jamOperasional->open_days;
            $hariTutup = $jamOperasional->close_days;

            if ($hariIni < $hariBuka || $hariIni > $hariTutup) {
                return response()->json(['message' => 'Maaf, klinik sedang libur!'], 400);
            }

            if ($waktuSekarang->greaterThanOrEqualTo($jamTutup) || $waktuSekarang->lessThan($jamBuka)) {
                return response()->json(['message' => 'Maaf, klinik sedang tutup!'], 400);
            } else {
                $validator = validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'address' => 'required|string|max:255',
                    'old' => 'required|integer|min:1',
                    'gender' => 'required|in:Laki-Laki,Perempuan'
                ]);

                $customMessages = [
                    'gender.in' => "The gender must be Laki-Laki or Perempuan"
                ];

                $validator->setCustomMessages($customMessages);

                if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors()], 422);
                }

                $lastQueueNumber = QueueNumber::orderBy('id', 'desc')->first();
                $newQueueNumber = $lastQueueNumber ? $lastQueueNumber->number + 1 : 1;

                $queueNumber = QueueNumber::create([
                    'number' => $newQueueNumber
                ]);
                $validatedData = $validator->validated();
                $validatedData['queue_number_id'] = $queueNumber->id;
                $data = Patient::create($validatedData);

                return response()->json([
                    'message' => 'Take queue successfully!',
                    'data' => [
                        'id' => $data->id,
                        'name' => $data->name,
                        'address' => $data->address,
                        'old' => $data->old,
                        'gender' => $data->gender,
                        'queue_number' => $newQueueNumber
                    ]
                ], 200);
            }
        } catch (QueryException $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, 422);
        }
    }


    public function show()
    {
        try {
            $queueNow = Patient::with(['queueNumber'])->orderby('queue_number_id', 'asc')->whereNotNull('queue_number_id')->first();
            return response()->json([
                'message' => 'Get queue number now successfully!',
                'data' => [
                    'queue_number_now' => $queueNow->queueNumber->number,
                    'id' => $queueNow->id,
                    'name' => $queueNow->name,
                    'address' => $queueNow->address,
                    'old' => $queueNow->old,
                    'gender' => $queueNow->gender
                ]
            ], 200);
        } catch (QueryException $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, 500);
        }
    }

    public function totalPatients()
    {
        try {
            $totalPatients = QueueNumber::orderBy('id', 'desc')->first();
            return response()->json([
                'message' => 'Get total patients successfully!',
                'data' => [
                    'total_patients' => $totalPatients->count()
                ]
            ], 200);
        } catch (QueryException $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, 500);
        }
    }

    public function search()
{
    try {
        if (request()->has('id')) {
            $patient = Patient::where('id', request('id'))->first();

            if (!$patient) {
                return response()->json(['message' => 'Patient not found!'], 404);
            }

            $patientDetails = [
                'id' => $patient->id,
                'name' => $patient->name,
                'address' => $patient->address,
                'old' => $patient->old,
                'gender' => $patient->gender,
                'queue_number' => $patient->queue_number_id,
                'status_pemeriksaan' => $patient->status_pemeriksaan,
                'tanggal_pemeriksaan' => $patient->created_at->locale('id')->isoFormat('D MMMM YYYY | H:mm')
            ];

            return response()->json([
                'message' => 'Patient data found!',
                'data' => $patientDetails
            ], 200);
        } else {
            // 'id' parameter is missing
            return response()->json(['message' => 'Need parameter \'id\' for searching!'], 400);
        }
    } catch (QueryException $e) {
        $error = [
            'error' => $e->getMessage()
        ];
        return response()->json($error, 500);
    }
}

}
