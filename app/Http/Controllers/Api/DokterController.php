<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\User;

class DokterController extends Controller
{
    public function detail()
    {
        try {
            $detailDokter = User::where('is_admin', true)->first();
            return response()->json([
                'message' => 'Get dokter successfully!',
                'data' => [
                    'name' => $detailDokter->name,
                    'gender' => $detailDokter->gender,
                    'profile_image' =>  request()->getSchemeAndHttpHost() . "/storage/" . $detailDokter->image,
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
