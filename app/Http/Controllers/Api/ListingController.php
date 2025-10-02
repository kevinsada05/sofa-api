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
        $listings = Listing::with(['user.type', 'user.profile', 'city', 'category', 'transactionType'])
            ->when($request->transaction_type_id, fn($q) => $q->whereIn('transaction_type_id', explode(',', $request->transaction_type_id)))
            ->when($request->category_id, fn($q) => $q->whereIn('category_id', explode(',', $request->category_id)))
            ->when($request->city_id, fn($q) => $q->whereIn('city_id', explode(',', $request->city_id)))
            ->when($request->price_min, fn($q) => $q->where('price', '>=', $request->price_min))
            ->when($request->price_max, fn($q) => $q->where('price', '<=', $request->price_max))
            ->when($request->size_min, fn($q) => $q->where('size_m2', '>=', $request->size_min))
            ->when($request->size_max, fn($q) => $q->where('size_m2', '<=', $request->size_max))
            ->where('status_id', 1)
            ->orderByDesc('date_published')
            ->simplePaginate(20);

        return response()->json([
            'data' => $listings->items(),
            'next_page' => $listings->nextPageUrl(),
            'filters' => [
                'cities' => City::orderBy('name')->get(),
                'categories' => Category::orderBy('name')->get(),
                'transaction_types' => TransactionType::orderBy('name')->get(),
            ]
        ]);
    }

    public function show($id)
    {
        $listing = Listing::with([
            'images',
            'category',
            'user',
            'city',
            'transactionType',
            'rentPeriod',
            'ownership',
        ])->findOrFail($id);

        if ($listing->status_id != 1) {
            abort(404);
        }

        $relations = [
            'apartment' => [
                'apartmentDetail',
                'apartmentDetail.yearBuild',
                'apartmentDetail.condition',
                'apartmentDetail.furnishing',
                'apartmentDetail.orientation',
                'apartmentDetail.heating',
                'apartmentDetail.apartmentType',
            ],
            'villa' => [
                'villaDetail',
                'villaDetail.yearBuild',
                'villaDetail.condition',
                'villaDetail.furnishing',
                'villaDetail.orientation',
                'villaDetail.heating',
            ],
            'shared_rent' => [
                'sharedRentDetail',
                'sharedRentDetail.yearBuild',
                'sharedRentDetail.condition',
                'sharedRentDetail.furnishing',
                'sharedRentDetail.orientation',
                'sharedRentDetail.heating',
                'sharedRentDetail.apartmentType',
            ],
            'penthouse' => [
                'penthouseDetail',
                'penthouseDetail.yearBuild',
                'penthouseDetail.condition',
                'penthouseDetail.furnishing',
                'penthouseDetail.orientation',
                'penthouseDetail.heating',
            ],
            'garsoniere' => [
                'garsoniereDetail',
                'garsoniereDetail.yearBuild',
                'garsoniereDetail.condition',
                'garsoniereDetail.furnishing',
                'garsoniereDetail.orientation',
                'garsoniereDetail.heating',
            ],
            'garage' => [
                'garageDetail',
            ],
            'shop' => [
                'shopDetail',
                'shopDetail.yearBuild',
                'shopDetail.condition',
                'shopDetail.furnishing',
                'shopDetail.orientation',
                'shopDetail.heating',
            ],
            'office' => [
                'officeDetail',
                'officeDetail.yearBuild',
                'officeDetail.condition',
                'officeDetail.furnishing',
                'officeDetail.orientation',
                'officeDetail.heating',
            ],
            'warehouse' => [
                'warehouseDetail',
                'warehouseDetail.yearBuild',
                'warehouseDetail.condition',
            ],
            'agricultural_land' => [
                'agriculturalLandDetail',
                'agriculturalLandDetail.landType',
                'agriculturalLandDetail.soilQuality',
                'agriculturalLandDetail.terrainType',
            ],
            'plot' => [
                'plotDetail',
                'plotDetail.terrainType',
            ],
            'business' => [
                'businessDetail',
            ],
        ];

        $baseRelations = [
            'category',
            'city',
            'transactionType',
            'rentPeriod',
            'ownership',
            'status',
            'user',
        ];

        $categoryCode = $listing->category->code;

        $with = $baseRelations;
        if (isset($relations[$categoryCode])) {
            $with = array_merge($with, $relations[$categoryCode]);
        }

        $listing->load($with);

        $listing->loadCount('favorites');
        $listing->load('views');
        $view = $listing->views()->firstOrNew(['listing_id' => $id]);
        $view->view_count = ($view->view_count ?? 0) + 1;
        $view->real_view_count = ($view->real_view_count ?? 0) + 1;
        $view->save();

        $similar = Listing::where('id', '!=', $listing->id)
            ->where('status_id', 1)
            ->where('category_id', $listing->category_id)
            ->when($listing->city_id, fn($q) => $q->where('city_id', $listing->city_id))
            ->latest()
            ->take(5)
            ->get();

        return response()->json([
            'listing' => $listing,
            'similar' => $similar,
        ]);
    }
}
