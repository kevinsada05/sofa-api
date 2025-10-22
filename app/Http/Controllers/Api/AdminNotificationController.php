<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeviceToken;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

class AdminNotificationController extends Controller
{
    public function create()
    {
        // optional, API can just return structure for frontend
        return response()->json([
            'fields' => [
                'title' => 'string|required|max:255',
                'body' => 'string|required|max:1000',
            ]
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string|max:1000',
        ]);

        // Get base64 credentials from config
        $encoded = config('firebase.projects.app.credentials');

        // Decode JSON and write to a temporary in-memory file
        $tmp = tmpfile();
        fwrite($tmp, base64_decode($encoded));
        $path = stream_get_meta_data($tmp)['uri'];

        // Initialize Firebase Messaging
        $messaging = (new Factory)
            ->withServiceAccount($path)
            ->createMessaging();

        $tokens = DeviceToken::whereNotNull('token')->pluck('token')->toArray();
        $chunks = array_chunk($tokens, 500);

        $successCount = 0;
        $failureCount = 0;

        foreach ($chunks as $batch) {
            $message = CloudMessage::new()->withNotification([
                'title' => $request->title,
                'body'  => $request->body,
            ]);

            $report = $messaging->sendMulticast($message, $batch);

            $successCount += $report->successes()->count();
            $failureCount += $report->failures()->count();

            foreach ($report->failures()->getItems() as $failure) {
                $failedToken = $failure->target()->value();
                DeviceToken::where('token', $failedToken)->delete();
            }
        }

        return response()->json([
            'message' => 'Notifications sent',
            'success' => $successCount,
            'failed'  => $failureCount,
        ]);
    }
}
