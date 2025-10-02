<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DeviceToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'phone' => [
                'required',
                'regex:/^(\+3556[789]\d{7}|06[89]\d{7}|6[89]\d{7})$/',
                'unique:users,phone',
            ],
            'password' => ['required', Rules\Password::defaults()],
            'user_type_id' => ['required', 'exists:user_types,id'],
            'name' => ['nullable', 'string', 'max:255'],
        ]);

        // Normalize phone → +3556XXXXXXXX
        $phone = preg_replace('/\D+/', '', $request->phone);
        if (str_starts_with($phone, '355')) $phone = substr($phone, 3);
        if (str_starts_with($phone, '0')) $phone = substr($phone, 1);
        $phone = '+355' . $phone;

        $user = User::create([
            'name' => $request->name,
            'phone' => $phone,
            'password' => Hash::make($request->password),
            'user_type_id' => $request->user_type_id,
        ]);

        // one token per user
        $user->tokens()->where('name', 'api')->delete();
        $token = $user->createToken('api')->plainTextToken;

        return response()->json([
            'message' => 'Registration successful',
            'user' => $user,
            'token' => $token,
        ], 201);
    }
}
