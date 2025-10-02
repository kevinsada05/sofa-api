<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use Illuminate\Http\JsonResponse;

class AdminExpireListingController extends Controller
{
    public function index(): JsonResponse
    {
        $expired = Listing::where('status_id', 1)
            ->where('expires_at', '<', now())
            ->count();

        return response()->json([
            'expired_ready' => $expired,
        ]);
    }

    public function run(): JsonResponse
    {
        $count = Listing::where('status_id', 1)
            ->where('expires_at', '<', now())
            ->update(['status_id' => 4]);

        return response()->json([
            'message' => "Expired {$count} listings successfully.",
            'count'   => $count,
        ]);
    }
}
