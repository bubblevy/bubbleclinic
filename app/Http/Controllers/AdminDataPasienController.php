<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Patient;
use Carbon\Carbon;

class AdminDataPasienController extends Controller
{
    public function index()
    {
        return view('admin.patients.index', [
            'app' => Application::all(),
            'title' => 'Data Pasien',
            'patients' => Patient::where('queue_number_id', null)->where('late_queue_number', null)->latest()->paginate(10)
        ]);
    }

    public function filter()
    {
        if (request('startDate') === null) {
            return redirect('/admin/pasien');
            exit;
        }

        $query = Patient::where('queue_number_id', null)->where('late_queue_number', null)->orderBy('created_at', 'asc');
        if (request('startDate')) {
            $date =  Carbon::parse(request('endDate'));
            $query = $query->whereBetween('created_at', [request('startDate'), $date->addDays(1)]);
        }
        return view('admin.patients.index', [
            'app' => Application::all(),
            'title' => 'Data Pasien',
            'patients' => $query->paginate(10)
        ]);
    }


    public function deletePatient(Request $request)
    {
        $idPatient = decrypt($request->codePatient);
        Patient::destroy($idPatient);
        return back()->with('deletePatientSuccess', 'Pasien berhasil dihapus!');
    }

    public function editPatient(Request $request)
    {
        $idPatient = decrypt($request->code);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'old' => 'required|integer|min:1',
            'gender' => 'required|in:Laki-Laki,Perempuan'
        ]);
        Patient::where('id', $idPatient)->update($validatedData);
        return back()->with('editPatientSuccess', 'Data pasien berhasil diupdate!');
    }

    public function search()
    {
        if (request('q') === null) {
            return redirect('/admin/pasien');
            exit;
        }
        return view('admin.patients.search', [
            'app' => Application::all(),
            'title' => 'Data Pasien',
            'patients' => Patient::where('queue_number_id', null)->where('late_queue_number', null)->latest()->searching(request('q'))->paginate(10)
        ]);
    }
}
