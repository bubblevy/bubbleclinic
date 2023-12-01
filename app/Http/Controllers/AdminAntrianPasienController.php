<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Patient;
use App\Models\QueueNumber;
use Carbon\Carbon;

class AdminAntrianPasienController extends Controller
{
    public function index()
    {
        return view('admin.patient-queue.index', [
            'app' => Application::all(),
            'title' => 'Data Antrian Pasien',
            'patients' => Patient::with(['queueNumber'])->orderby('queue_number_id', 'asc')->whereNotNull('queue_number_id')->paginate(10)
        ]);
    }

    public function generateQueueNumber(Request $request)
    {
        $jamOperasional = Application::select('open_time', 'close_time', 'open_days', 'close_days')->first();
        $waktuSekarang = Carbon::now();
        $jamTutup = Carbon::createFromFormat('H:i:s', $jamOperasional->close_time, 'Asia/Jakarta');
        $jamBuka = Carbon::createFromFormat('H:i:s', $jamOperasional->open_time, 'Asia/Jakarta');

        $hariIni = $waktuSekarang->dayOfWeek;

        $hariBuka = $jamOperasional->open_days;
        $hariTutup = $jamOperasional->close_days;

        if ($hariIni < $hariBuka || $hariIni > $hariTutup) {
            return back()->with('closeTime', 'Maaf, klinik sedang libur!');
        }

        if ($waktuSekarang->greaterThanOrEqualTo($jamTutup) || $waktuSekarang->lessThan($jamBuka)) {
            return back()->with('closeTime', 'Maaf, klinik sedang tutup!');
        } else {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'old' => 'required|integer|min:1',
                'gender' => 'required|in:Laki-Laki,Perempuan'
            ]);

            // Mendapatkan nomor antrian terakhir
            $lastQueueNumber = QueueNumber::orderBy('id', 'desc')->first();

            // Nomor antrian baru akan menjadi nomor antrian terakhir + 1 atau 1 jika tidak ada nomor antrian sebelumnya
            $newQueueNumber = $lastQueueNumber ? $lastQueueNumber->number + 1 : 1;

            // Membuat entri baru di model QueueNumber dengan nomor antrian yang baru
            $queueNumber = QueueNumber::create([
                'number' => $newQueueNumber
            ]);

            $validatedData['queue_number_id'] = $queueNumber->id;

            Patient::create($validatedData);

            return back()->with('notificationMessage', 'Berhasil mengambil antrian!');
        }
    }

    public function confirmPatient(Request $request)
    {
        $idPatient = decrypt($request->codePatient);
        Patient::where("id", $idPatient)->update(['queue_number_id' => null, 'status_pemeriksaan' => 'Sudah Diperiksa']);
        return back()->with('confirmPatientSuccess', 'Pasien berhasil dikonfirmasi');
    }

    public function skipPatient(Request $request)
    {
        $idPatient = decrypt($request->codePatient);
        $patient = Patient::where('id', $idPatient);
        $nomorAntrian = Patient::find($idPatient);

        $patient->update(['queue_number_id' => null, 'late_queue_number' => $nomorAntrian->queue_number_id]);
        return back()->with('skipPatientSuccess', 'Pasien berhasil dipindahkan!');
    }

    public function search()
    {
        if (request('q') === null) {
            return redirect('/admin/antrian');
            exit;
        }
        return view('admin.patient-queue.search', [
            'app' => Application::all(),
            'title' => 'Data Antrian Pasien',
            'patients' => Patient::with(['queueNumber'])->orderby('queue_number_id', 'asc')->whereNotNull('queue_number_id')->searching(request('q'))->paginate(10)
        ]);
    }



    // for patient late 
    public function daftarAntrianTerlambat()
    {
        return view('admin.late-patient-queue.index', [
            'app' => Application::all(),
            'title' => 'Daftar Antrian Pasien Yang Terlambat',
            'patients' => Patient::orderby('late_queue_number', 'asc')->whereNotNull('late_queue_number')->where('queue_number_id', null)->paginate(10)
        ]);
    }

    public function searchAntrianTerlambat()
    {
        if (request('q') === null) {
            return redirect('/admin/daftar-antrian-terlambat');
            exit;
        }
        return view('admin.late-patient-queue.search', [
            'app' => Application::all(),
            'title' => 'Daftar Antrian Pasien Yang Terlambat',
            'patients' => Patient::orderby('late_queue_number', 'asc')->whereNotNull('late_queue_number')->where('queue_number_id', null)->searching(request('q'))->paginate(10)
        ]);
    }

    public function confirmPasienTerlambat(Request $request)
    {
        $idPatient = decrypt($request->codePatient);
        Patient::where("id", $idPatient)->update(['queue_number_id' => null, 'status_pemeriksaan' => 'Sudah Diperiksa', 'late_queue_number' => null]);
        return back()->with('confirmPatientSuccess', 'Pasien berhasil dikonfirmasi');
    }
}
