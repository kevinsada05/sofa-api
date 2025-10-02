<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // normalize phone
        $phone = preg_replace('/\D+/', '', $request->phone);
        if (str_starts_with($phone, '00355')) $phone = substr($phone, 5);
        elseif (str_starts_with($phone, '355')) $phone = substr($phone, 3);
        if (str_starts_with($phone, '0')) $phone = substr($phone, 1);
        $phone = '+355' . $phone;

        if (! Auth::attempt(['phone' => $phone, 'password' => $request->password])) {
            throw ValidationException::withMessages([
                'phone' => ['Kombinimi nuk është i saktë.'],
            ]);
        }

        $user = $request->user();

        // issue new token
        $user->tokens()->where('name', 'api')->delete();
        $token = $user->createToken('api')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout successful']);
    }
}
