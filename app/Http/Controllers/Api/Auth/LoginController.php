<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'phone' => [
                'required',
                'regex:/^(\+3556[789]\d{7}|06[89]\d{7}|6[89]\d{7})$/'
            ],
            'password' => ['required', 'string'],
        ], [
            'phone.required' => 'Numri i telefonit është i detyrueshëm.',
            'phone.regex'    => 'Ju lutem vendosni një numër telefoni shqiptar të vlefshëm (+355 67/68/69 xxxxxxx).',
            'password.required' => 'Fjalëkalimi është i detyrueshëm.',
        ]);

        // Normalize phone → +3556XXXXXXXX
        $phone = preg_replace('/\D+/', '', $request->phone);
        if (str_starts_with($phone, '00355')) {
            $phone = substr($phone, 5);
        } elseif (str_starts_with($phone, '355')) {
            $phone = substr($phone, 3);
        }
        if (str_starts_with($phone, '0')) {
            $phone = substr($phone, 1);
        }
        $phone = '+355' . $phone;

        $user = User::where('phone', $phone)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'phone' => ['Kombinimi nuk është i saktë'],
            ]);
        }

        $user->tokens()->where('name', 'mobile')->delete();
        $token = $user->createToken('mobile')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }
}
