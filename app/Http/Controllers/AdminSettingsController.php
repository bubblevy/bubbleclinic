<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Application;

class AdminSettingsController extends Controller
{
  public function index()
  {
    return view('admin.setting.index', [
      'app' => Application::all(),
      'title' => 'Pengaturan'
    ]);
  }

  // verify user
  public function verify(Request $request)
  {
    $credentials = $request->validate([
      'usernameverify' => 'required',
      'password' => 'required',
    ]);

    $credentials['username'] = $credentials['usernameverify'];
    unset($credentials['usernameverify']);

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();
      return back()->with('statusverifysuccess', 'success');
      exit;
    }

    return back()->with('statusverifyfailed', 'failed');
  }

  // set email baru
  public function setemail(Request $request)
  {
    $validatedData = $request->validate([
      'email' => 'required|email:dns|unique:users',
    ]);
    User::where('id', auth()->user()->id)
      ->update($validatedData);
    return back()->with('updateEmailUser', 'Email berhasil diupdate!');
  }

  public function store(Request $request)
  {
    $rules = [
      'name' => 'required|string|max:100',
      'alamat' => 'Max:255',
      'gender' => 'in:Laki-Laki,Perempuan',
      'tanggal_lahir' => '',
      'image' => 'image|file|max:500|dimensions:ratio=1/1'
    ];

    if ($request->username != auth()->user()->username) {
      $rules['username'] = 'required|string|regex:/^[a-zA-Z0-9]+$/|min:5|max:50|unique:users';
    }

    $validatedData = $request->validate($rules, [
      'image.dimensions' => 'The :attribute must have a 1:1 aspect ratio.',
    ]);

    if ($request->file('image')) {
      $validatedData['image'] = $request->file('image')->store('profil-images');
    }
    User::where('id', auth()->user()->id)->update($validatedData);
    return back()->with('updateUserBerhasil', 'Data admin berhasil diupdate!');
  }

  public function changepassword(Request $request)
  {
    $validatedData = $request->validate([
      'passwordLama' => 'required',
      'passwordBaru' => ['required', 'max:255', Password::min(8)->mixedCase()->letters()->numbers()->symbols(), 'confirmed']
    ]);

    if (Hash::check($validatedData['passwordLama'], auth()->user()->password)) {
      $hashPassword = bcrypt($validatedData['passwordBaru']);
      User::where('id', auth()->user()->id)
        ->update(['password' => $hashPassword]);
      return back()->with('passwordUpdateSuccess', 'Password berhasil diupdate!');
      exit;
    } else {
      return back()->with('passwordLamaSalah', 'Password lama Anda salah!');
    }
  }

  public function updateapp(Request $request)
  {
    $rules = [
      'name_app' => 'required|string|max:255',
      'description_app' => 'max:255',
      'logo' => 'image|file|max:500',
      'address' => 'string|max:255',
      'open_days' => 'in:1,2,3,4,5,6,7',
      'close_days' => 'in:1,2,3,4,5,6,7',
      'open_time' => '',
      'close_time' => ''
    ];

    $validatedData = $request->validate($rules);

    if ($request->file('logo')) {
      $validatedData['logo'] = $request->file('logo')->store('logo-aplikasi');
    }
    Application::where('id', 1)->update($validatedData);
    return back()->with('updateAppBerhasil', 'Data app berhasil diupdate!');
  }
}
