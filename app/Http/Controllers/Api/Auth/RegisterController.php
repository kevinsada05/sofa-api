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
        $validated = $request->validate([
            'phone' => [
                'required',
                'regex:/^(\+3556[789]\d{7}|06[89]\d{7}|6[89]\d{7})$/',
                'unique:users,phone',
            ],
            'password' => ['required', Rules\Password::defaults()],
            'user_type_id' => ['required', 'exists:user_types,id'],
            'name' => ['nullable', 'string', 'max:255'],
        ], [
            'phone.required' => 'Numri i telefonit është i detyrueshëm.',
            'phone.unique' => 'Ky numër telefoni është i regjistruar tashmë.',
            'phone.regex' => 'Ju lutem vendosni një numër telefoni shqiptar të vlefshëm (+355 67/68/69 xxxxxxx).',
            'password.required' => 'Fjalëkalimi është i detyrueshëm.',
            'password.min' => 'Fusha e fjalëkalimit duhet të ketë të paktën 8 karaktere.',
            'user_type_id.required' => 'Ju lutem zgjidhni llojin e përdoruesit.',
            'user_type_id.exists' => 'Lloji i përdoruesit i zgjedhur nuk është i vlefshëm.',
        ]);

        // Normalize phone → +3556XXXXXXXX
        $phone = preg_replace('/\D+/', '', $validated['phone']);
        if (str_starts_with($phone, '355')) {
            $phone = substr($phone, 3);
        }
        if (str_starts_with($phone, '0')) {
            $phone = substr($phone, 1);
        }
        $validated['phone'] = '+355' . $phone;

        // Create user
        $user = User::create([
            'name' => $validated['name'] ?? null,
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'user_type_id' => $validated['user_type_id'],
        ]);

        // One token per user (for mobile API)
        $user->tokens()->where('name', 'mobile')->delete();
        $token = $user->createToken('mobile')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Regjistrimi u krye me sukses.',
            'data' => [
                'user' => $user,
                'token' => $token,
            ]
        ], 201);
    }
}
