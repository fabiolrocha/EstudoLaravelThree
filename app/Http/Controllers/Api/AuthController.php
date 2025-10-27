<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Handle an authentication attempt (API Login).
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            
            return response()->json([
                'message' => 'Credenciais inválidas'
            ], 401); 
        }

        $token = $user->createToken('api-token')->plainTextToken;


        return response()->json([
            'token' => $token
        ]);
    }
}
