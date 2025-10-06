<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Listing;
use App\Models\TransactionType;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index(Request $request)
    {
        $listings = Listing::query()
            ->with([
                'user.type',
                'user.profile',
                'city',
                'category',
                'transactionType'
            ])
            ->when($request->transaction_type_id, fn($q) => $q->whereIn('transaction_type_id', explode(',', $request->transaction_type_id))
            )
            ->when($request->category_id, fn($q) => $q->whereIn('category_id', explode(',', $request->category_id))
            )
            ->when($request->city_id, fn($q) => $q->whereIn('city_id', explode(',', $request->city_id))
            )
            ->when($request->price_min, fn($q) => $q->where('price', '>=', $request->price_min)
            )
            ->when($request->price_max, fn($q) => $q->where('price', '<=', $request->price_max)
            )
            ->when($request->size_min, fn($q) => $q->where('size_m2', '>=', $request->size_min)
            )
            ->when($request->size_max, fn($q) => $q->where('size_m2', '<=', $request->size_max)
            )
            ->where('status_id', 1)
            ->orderByDesc('date_published')
            ->simplePaginate(20);

        $cities = City::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $transactionTypes = TransactionType::orderBy('name')->get();

        return response()->json([
            'data' => $listings->items(),
            'next_page' => $listings->nextPageUrl(),
            'filters' => [
                'cities' => City::orderBy('name')->get(),
                'categories' => Category::orderBy('name')->get(),
                'transaction_types' => TransactionType::orderBy('name')->get(),
            ],
        ]);
    }

    public function show($id)
    {
        $listing = Listing::with([
            'images',
            'category',
            'user.type',
            'city',
            'transactionType',
            'rentPeriod',
            'ownership',
            'views',
        ])->findOrFail($id);

        if ($listing->status_id != 1) {
            return response()->json(['message' => 'Listing not found'], 404);
        }

        // increment views
        $view = $listing->views()->firstOrNew(['listing_id' => $id]);
        $view->view_count = ($view->view_count ?? 0) + 1;
        $view->real_view_count = ($view->real_view_count ?? 0) + 1;
        $view->save();

        // favorites check
        $visitorKey = request()->header('X-Sofa-UUID', request()->cookie('sofa_uuid'));

        $isFavorited = false;

        if ($visitorKey) {
            $isFavorited = $listing->favorites()
                ->where('session_key', $visitorKey)
                ->exists();
        }

        // similar listings
        $similar = Listing::where('id', '!=', $listing->id)
            ->where('status_id', 1)
            ->where('category_id', $listing->category_id)
            ->when($listing->city_id, fn($q) => $q->where('city_id', $listing->city_id))
            ->latest()
            ->take(5)
            ->get();

        $map = [
            'apartment' => 'apartmentDetail',
            'villa' => 'villaDetail',
            'shared_rent' => 'sharedRentDetail',
            'penthouse' => 'penthouseDetail',
            'garsoniere' => 'garsoniereDetail',
            'garage' => 'garageDetail',
            'shop' => 'shopDetail',
            'office' => 'officeDetail',
            'warehouse' => 'warehouseDetail',
            'agricultural_land' => 'agriculturalLandDetail',
            'plot' => 'plotDetail',
            'business' => 'businessDetail',
        ];

        $categoryCode = $listing->category->code ?? null;
        if ($categoryCode && isset($map[$categoryCode])) {
            $listing->load($map[$categoryCode]);
        }

        $listing->loadCount('favorites');

        return response()->json([
            'listing' => $listing->toArray() + [
                    'favorites_count' => $listing->favorites_count,
                ],
            'isFavorited' => $isFavorited,
            'similar' => $similar,
        ]);
    }
}
