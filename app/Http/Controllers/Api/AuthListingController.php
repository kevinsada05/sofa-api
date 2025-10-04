<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Listings\AgriculturalLandRequest;
use App\Http\Requests\Listings\ApartmentRequest;
use App\Http\Requests\Listings\BaseListingRequest;
use App\Http\Requests\Listings\BusinessRequest;
use App\Http\Requests\Listings\GarageRequest;
use App\Http\Requests\Listings\GarsoniereRequest;
use App\Http\Requests\Listings\OfficeRequest;
use App\Http\Requests\Listings\PenthouseRequest;
use App\Http\Requests\Listings\PlotRequest;
use App\Http\Requests\Listings\SharedRentRequest;
use App\Http\Requests\Listings\ShopRequest;
use App\Http\Requests\Listings\VillaRequest;
use App\Http\Requests\Listings\WarehouseRequest;
use App\Models\ApartmentType;
use App\Models\BusinessType;
use App\Models\Category;
use App\Models\City;
use App\Models\Condition;
use App\Models\Furnishing;
use App\Models\Heating;
use App\Models\LandType;
use App\Models\Listing;
use App\Models\Orientation;
use App\Models\Ownership;
use App\Models\RentPeriod;
use App\Models\SoilQuality;
use App\Models\TemporaryImage;
use App\Models\TerrainType;
use App\Models\TransactionType;
use App\Models\YearBuild;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Validation\Validator as ValidatorContract;

class AuthListingController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $listings = $user->listings()
            ->with(['category', 'city', 'transactionType'])
            ->where('status_id', $request->get('status', 1))
            ->latest()
            ->get();

        return response()->json([
            'listings' => $listings,
        ]);
    }

    public function show(Request $request, $id)
    {
        $user = $request->user();

        $listing = Listing::with([
            'images', 'category', 'city', 'transactionType',
            'rentPeriod', 'ownership', 'status',
        ])
            ->where('user_id', $user->id)
            ->findOrFail($id);

        return response()->json(['listing' => $listing]);
    }

    public function store(Request $request, $categoryCode)
    {
        $category = Category::where('code', $categoryCode)->firstOrFail();

        $baseRequest = new BaseListingRequest();
        $categoryRequestClass = match ($category->code) {
            'apartment' => ApartmentRequest::class,
            'villa' => VillaRequest::class,
            'garsoniere' => GarsoniereRequest::class,
            'penthouse' => PenthouseRequest::class,
            'shared_rent' => SharedRentRequest::class,
            'garage' => GarageRequest::class,
            'shop' => ShopRequest::class,
            'office' => OfficeRequest::class,
            'warehouse' => WarehouseRequest::class,
            'business' => BusinessRequest::class,
            'plot' => PlotRequest::class,
            'agricultural_land' => AgriculturalLandRequest::class,
            default => throw new \InvalidArgumentException("Unknown category: {$category->code}"),
        };
        $catRequest = new $categoryRequestClass();

        $rules = array_merge($baseRequest->rules(), $catRequest->rules());
        $messages = array_merge($baseRequest->messages(), $catRequest->messages());
        $attributes = array_merge($baseRequest->attributes(), $catRequest->attributes());

        $validator = ValidatorFacade::make($request->all(), $rules, $messages, $attributes);

        $primary = $this->validatePrimaryImage($validator, $request->user()->id);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();
        $baseData = collect($validated)->except('details')->toArray();
        $detailsData = $validated['details'] ?? [];

        $listing = DB::transaction(function () use ($primary, $baseData, $category, $detailsData, $request) {
            $listing = Listing::create(array_merge($baseData, [
                'user_id' => $request->user()->id,
                'category_id' => $category->id,
                'status_id' => 3, // pending review
                'date_published' => now(),
                'primary_image' => $primary->b2_key,
            ]));

            TemporaryImage::where('user_id', $request->user()->id)
                ->where('is_primary', false)
                ->limit(9)
                ->get()
                ->each(fn($tmp) => $listing->images()->create(['image_path' => $tmp->b2_key]));

            TemporaryImage::where('user_id', $request->user()->id)->delete();

            $this->handleCategoryInsertion($category->code, $listing, $detailsData);

            return $listing;
        });

        return response()->json(['message' => 'Listing created successfully.', 'listing' => $listing], 201);
    }

    public function update(Request $request, $id)
    {
        $listing = $request->user()->listings()->findOrFail($id);

        $listing->update($request->all()); // refine with proper validation

        return response()->json(['message' => 'Listing updated.', 'listing' => $listing]);
    }

    public function destroy(Request $request, $id)
    {
        $listing = $request->user()->listings()->findOrFail($id);

        Storage::disk('b2')->deleteDirectory("listings/{$listing->id}");
        $listing->delete();

        return response()->json(['message' => 'Listing deleted.']);
    }

    public function republish(Request $request, $id)
    {
        $listing = $request->user()->listings()->findOrFail($id);

        if ($listing->status_id !== 4) {
            return response()->json(['error' => 'Only expired listings can be republished.'], 400);
        }

        $listing->update([
            'status_id' => 1,
            'expires_at' => now()->addDays(30),
            'date_published' => now(),
        ]);

        return response()->json(['message' => 'Listing republished.']);
    }

    protected function validatePrimaryImage(ValidatorContract $validator, int $userId): ?TemporaryImage
    {
        $primary = TemporaryImage::where('user_id', $userId)
            ->where('is_primary', true)
            ->first();

        $validator->after(function ($v) use ($primary) {
            if (!$primary) {
                $v->errors()->add('primary_image', 'Ju lutem zgjidhni një foto kryesore.');
            }
        });

        return $primary;
    }

    protected function handleCategoryInsertion(string $code, Listing $listing, array $data): void
    {
        match ($code) {
            'apartment' => $listing->apartmentDetail()->create($data),
            'villa' => $listing->villaDetail()->create($data),
            'garsoniere' => $listing->garsoniereDetail()->create($data),
            'penthouse' => $listing->penthouseDetail()->create($data),
            'shared_rent' => $listing->sharedRentDetail()->create($data),
            'garage' => $listing->garageDetail()->create($data),
            'shop' => $listing->shopDetail()->create($data),
            'office' => $listing->officeDetail()->create($data),
            'warehouse' => $listing->warehouseDetail()->create($data),
            'business' => $listing->businessDetail()->create($data),
            'plot' => $listing->plotDetail()->create($data),
            'agricultural_land' => $listing->agriculturalLandDetail()->create($data),
            default => throw new \InvalidArgumentException("Unknown category code: {$code}"),
        };
    }

    public function createMeta()
    {
        $categories = Category::select('id', 'name', 'code')->get();

        return response()->json([
            'categories' => $categories,
        ]);
    }

    public function chooseCategory(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
        ]);

        $category = Category::findOrFail($request->category_id);

        return response()->json([
            'message' => 'Category selected successfully.',
            'category' => $category,
            'next_url' => route('api.auth.listings.create.byCategory', ['category' => $category->code]),
        ]);
    }

    public function createMetaByCategory(Request $request, $categoryCode)
    {
        $userId = $request->user()->id;

        // clean temp images if fresh GET
        if ($request->isMethod('GET')) {
            TemporaryImage::where('user_id', $userId)->delete();
        }

        $category = Category::where('code', $categoryCode)->firstOrFail();

        $data = [
            'category' => $category,
            'cities' => City::all(['id', 'name']),
            'transactionTypes' => TransactionType::all(['id', 'name']),
            'ownerships' => Ownership::all(['id', 'name']),
            'rentPeriods' => RentPeriod::all(['id', 'name']),
            'businessTypes' => BusinessType::all(['id', 'name']),
        ];

        $withYearCondition = [
            'yearBuilds' => YearBuild::all(['id', 'name']),
            'conditions' => Condition::all(['id', 'name']),
        ];

        $withFullSet = array_merge($withYearCondition, [
            'furnishings' => Furnishing::all(['id', 'name']),
            'orientations' => Orientation::all(['id', 'name']),
            'heatings' => Heating::all(['id', 'name']),
        ]);

        switch ($category->code) {
            case 'apartment':
            case 'shared_rent':
                $data = array_merge($data, $withFullSet, [
                    'apartmentTypes' => ApartmentType::all(['id', 'name']),
                ]);
                break;

            case 'villa':
            case 'penthouse':
            case 'garsoniere':
            case 'shop':
            case 'office':
                $data = array_merge($data, $withFullSet);
                break;

            case 'warehouse':
                $data = array_merge($data, $withYearCondition);
                break;

            case 'agricultural_land':
                $data = array_merge($data, [
                    'landTypes' => LandType::all(['id', 'name']),
                    'soilQualities' => SoilQuality::all(['id', 'name']),
                    'terrainTypes' => TerrainType::all(['id', 'name']),
                ]);
                break;

            case 'plot':
                $data['terrainTypes'] = TerrainType::all(['id', 'name']);
                break;
        }

        return response()->json($data);
    }

}
