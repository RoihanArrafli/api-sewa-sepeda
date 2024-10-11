<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request) {
        $data = Validator::make($request->all(), [
            'username' => 'required|min:5',
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($data->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data harus diisi!',
                'data' => $data->errors()
            ]);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);
        
        return response()->json([
            'success' => true,
            'message' => 'Registrasi Berhasil!',
            'data' => $user
        ], 200);
    }
}
