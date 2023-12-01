<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class DokterController extends Controller
{
    public function detail()
    {
        try {
            $detailDokter = User::where('is_admin', true)->first();
            if (Storage::disk('public')->exists('profil-images')) {
                $image = request()->getSchemeAndHttpHost() . "/storage/" . $detailDokter->image;
            } else {
                $image = request()->getSchemeAndHttpHost() . "/assets/img/profil-images-default/1.jpeg";
            }
            return response()->json([
                'message' => 'Get dokter successfully!',
                'data' => [
                    'name' => $detailDokter->name,
                    'gender' => $detailDokter->gender,
                    'profile_image' =>  $image,
                    'address' => $detailDokter->alamat,
                    'email' => $detailDokter->email
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
