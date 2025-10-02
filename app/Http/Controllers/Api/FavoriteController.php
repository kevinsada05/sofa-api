<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FavoriteController extends Controller
{
    public function guestIndex(Request $request)
    {
        $uuid = $this->getVisitorKey($request);

        return response()->json(
            Favorite::with(['listing.city', 'listing.category'])
                ->where('session_key', $uuid)
                ->whereHas('listing', fn($q) => $q->where('status_id', 1))
                ->get()
        );
    }

    public function guestStore(Request $request, Listing $listing)
    {
        $uuid = $this->getVisitorKey($request);

        Favorite::firstOrCreate([
            'listing_id' => $listing->id,
            'session_key' => $uuid,
        ]);

        return response()->json([
            'favorited' => true,
            'count' => $listing->favorites()->count(),
        ]);
    }

    public function guestDestroy(Request $request, Listing $listing)
    {
        $uuid = $this->getVisitorKey($request);

        Favorite::where('listing_id', $listing->id)
            ->where('session_key', $uuid)
            ->delete();

        return response()->json([
            'favorited' => false,
            'count' => $listing->favorites()->count(),
        ]);
    }

    private function getVisitorKey(Request $request): string
    {
        $uuid = $request->header('X-Sofa-UUID');
        return $uuid ?: (string)Str::uuid();
    }
}
