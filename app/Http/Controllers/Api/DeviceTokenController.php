<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeviceToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DeviceTokenController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'token' => 'required|string|max:1024',
            'platform' => 'required|in:ios,android',
            'installation_id' => 'nullable|string|max:100',
        ]);

        $installationId = $validated['installation_id'] ?? (string) Str::uuid();

        $user = $request->user();

        $record = DeviceToken::updateOrCreate(
            ['installation_id' => $installationId],
            [
                'user_id'  => $user?->id,
                'token'    => $validated['token'],
                'platform' => $validated['platform'],
            ]
        );

        return response()->json([
            'message' => 'Token stored',
            'installation_id' => $record->installation_id,
        ]);
    }
}
