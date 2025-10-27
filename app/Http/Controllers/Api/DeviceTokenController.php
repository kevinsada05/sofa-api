<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeviceToken;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DeviceTokenController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'token'           => 'required|string',
            'installation_id' => 'nullable|string',
            'platform'        => 'nullable|string|in:ios,android',
        ]);

        $installationId = $validated['installation_id'] ?? (string) Str::uuid();
        $user = auth('sanctum')->user();

        $record = DeviceToken::updateOrCreate(
            ['installation_id' => $installationId],
            [
                'user_id'  => $user?->id,
                'token'    => $validated['token'],
                'platform' => $validated['platform'] ?? 'unknown',
            ]
        );

        return response()->json([
            'message'         => 'Token stored',
            'installation_id' => $record->installation_id,
            'user_attached'   => (bool) $user,
        ]);
    }
}
