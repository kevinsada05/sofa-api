<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user()->load('profile');
        return response()->json($user);
    }

    public function updateDetails(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => [
                'required',
                'regex:/^(\+3556[789]\d{7}|06[89]\d{7}|6[89]\d{7})$/',
                Rule::unique('users')->ignore($user->id),
            ],
            'website' => ['nullable', 'url', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'agency_name' => ['nullable', 'string', 'max:255'],
        ], [
            'name.required' => 'Ju lutem shkruani emrin.',
            'phone.required' => 'Ju lutem vendosni numrin e telefonit.',
            'phone.regex' => 'Ju lutem vendosni një numër telefoni të vlefshëm.',
            'phone.unique' => 'Ky numër telefoni është i regjistruar tashmë.',
            'website.url' => 'Ju lutem vendosni një URL të vlefshme.',
        ]);

        $phone = preg_replace('/\D+/', '', $validated['phone']);
        if (str_starts_with($phone, '355')) {
            $phone = substr($phone, 3);
        }
        if (str_starts_with($phone, '0')) {
            $phone = substr($phone, 1);
        }
        $validated['phone'] = '+355' . $phone;

        $user->update([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
        ]);

        if (in_array($user->user_type_id, [2, 3])) {
            $user->profile()->updateOrCreate(
                ['user_id' => $user->id],
                $request->only(['website', 'address', 'agency_name'])
            );
        }

        return response()->json(['message' => 'Detajet u përditësuan me sukses.']);
    }

    public function updatePassword(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
        ], [
            'current_password.required' => 'Ju lutem shkruani fjalëkalimin aktual.',
            'password.required' => 'Ju lutem vendosni një fjalëkalim të ri.',
            'password.confirmed' => 'Fjalëkalimi i ri dhe konfirmimi nuk përputhen.',
            'password.min' => 'Fjalëkalimi i ri duhet të ketë të paktën 8 karaktere.',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['errors' => ['current_password' => ['Fjalëkalimi aktual nuk është i saktë.']]], 422);
        }

        if (Hash::check($request->password, $user->password)) {
            return response()->json(['errors' => ['password' => ['Fjalëkalimi i ri nuk mund të jetë i njëjtë me të vjetrin.']]], 422);
        }

        $user->update(['password' => Hash::make($request->password)]);

        return response()->json(['message' => 'Fjalëkalimi u përditësua me sukses.']);
    }

    public function destroy(Request $request)
    {
        $user = $request->user();
        $user->delete();

        return response()->json(['message' => 'Llogaria u fshi me sukses.']);
    }
}
