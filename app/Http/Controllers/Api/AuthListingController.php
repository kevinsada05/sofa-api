<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator as ValidatorContract;

use App\Http\Requests\Listings\{
    BaseListingRequest, ApartmentRequest, VillaRequest, GarsoniereRequest,
    PenthouseRequest, SharedRentRequest, GarageRequest, ShopRequest,
    OfficeRequest, WarehouseRequest, BusinessRequest, PlotRequest,
    AgriculturalLandRequest
};

use App\Models\{
    Listing, TemporaryImage, Category, City, TransactionType, Ownership,
    RentPeriod, BusinessType, YearBuild, Condition, Furnishing, Orientation,
    Heating, ApartmentType, LandType, SoilQuality, TerrainType
};

class AuthListingController extends Controller
{
    /** Step 1: all categories */
    public function createMeta()
    {
        return response()->json([
            'categories' => Category::select('id','name','code')->get(),
        ]);
    }

    /** Step 1b: choose category */
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

    /** Step 2: meta per category */
    public function createMetaByCategory(Request $request, $categoryCode)
    {
        $userId = $request->user()->id;

        if ($request->isMethod('GET')) {
            TemporaryImage::where('user_id', $userId)->delete();
        }

        $category = Category::where('code', $categoryCode)->firstOrFail();

        $data = [
            'category'         => $category,
            'cities'           => City::all(['id','name']),
            'transactionTypes' => TransactionType::all(['id','name','code']),
            'ownerships'       => Ownership::all(['id','name','code']),
            'rentPeriods'      => RentPeriod::all(['id','name']),
            'businessTypes'    => BusinessType::all(['id','name']),
        ];

        $withYearCondition = [
            'yearBuilds' => YearBuild::all(['id','name']),
            'conditions' => Condition::all(['id','name']),
        ];

        $withFullSet = array_merge($withYearCondition, [
            'furnishings'  => Furnishing::all(['id','name']),
            'orientations' => Orientation::all(['id','name']),
            'heatings'     => Heating::all(['id','name']),
        ]);

        switch ($category->code) {
            case 'apartment':
            case 'shared_rent':
                $data = array_merge($data, $withFullSet, [
                    'apartmentTypes' => ApartmentType::all(['id','name']),
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
                    'landTypes'    => LandType::all(['id','name']),
                    'soilQualities'=> SoilQuality::all(['id','name']),
                    'terrainTypes' => TerrainType::all(['id','name']),
                ]);
                break;
            case 'plot':
                $data['terrainTypes'] = TerrainType::all(['id','name']);
                break;
        }

        return response()->json($data);
    }

    /** List user listings */
    public function index(Request $request)
    {
        $listings = $request->user()->listings()
            ->with(['category','city','transactionType'])
            ->when($request->filled('status'), fn($q) => $q->where('status_id',$request->status))
            ->latest()
            ->get();

        return response()->json(['listings'=>$listings]);
    }

    /** Show listing */
    public function show(Request $request, $id)
    {
        $listing = Listing::with([
            'images','category','city','transactionType','rentPeriod','ownership','status'
        ])->where('user_id',$request->user()->id)->findOrFail($id);

        return response()->json(['listing'=>$listing]);
    }

    /** Create listing */
    public function store(Request $request, $categoryCode)
    {
        $category = Category::where('code', $categoryCode)->firstOrFail();

        // Pick category request class
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

        $baseReq = new BaseListingRequest();
        $catReq  = new $categoryRequestClass();

        $rules      = array_merge($baseReq->rules(), $catReq->rules());
        $messages   = array_merge($baseReq->messages(), $catReq->messages());
        $attributes = array_merge($baseReq->attributes(), $catReq->attributes());

        $validator = ValidatorFacade::make($request->all(), $rules, $messages, $attributes);

        // Validate primary image presence
        $primary = $this->validatePrimaryImage($validator, $request->user()->id);

        // Handle failed validation
        if ($validator->fails()) {
            if (! $request->expectsJson()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validated   = $validator->validated();
        $baseData    = collect($validated)->except('details')->toArray();
        $detailsData = $validated['details'] ?? [];

        $listing = DB::transaction(function () use ($primary, $baseData, $category, $detailsData, $request) {
            $listing = Listing::create(array_merge($baseData, [
                'user_id'        => $request->user()->id,
                'category_id'    => $category->id,
                'status_id'      => 3,
                'date_published' => now(),
                'primary_image'  => $primary->b2_key,
            ]));

            TemporaryImage::where('user_id', $request->user()->id)
                ->where('is_primary', false)
                ->limit(9)
                ->get()
                ->each(fn ($tmp) => $listing->images()->create(['image_path' => $tmp->b2_key]));

            TemporaryImage::where('user_id', $request->user()->id)->delete();

            $this->handleCategoryInsertion($category->code, $listing, $detailsData);

            return $listing;
        });

        // Success responses
        if (! $request->expectsJson()) {
            return redirect()
                ->route('auth.listings.index')
                ->with('success', 'Njoftimi u krijua me sukses dhe do të publikohet pasi të rishikohet nga stafi brenda 24 orëve.');
        }

        return response()->json([
            'message' => 'Listing created successfully.',
            'listing' => $listing,
        ], 201);
    }

    /** Update */
    public function update(Request $request,$id)
    {
        $listing = $request->user()->listings()->findOrFail($id);
        $listing->update($request->all());
        return response()->json(['message'=>'Listing updated.','listing'=>$listing]);
    }

    /** Delete */
    public function destroy(Request $request,$id)
    {
        $listing = $request->user()->listings()->findOrFail($id);
        Storage::disk('b2')->deleteDirectory("listings/{$listing->id}");
        $listing->delete();
        return response()->json(['message'=>'Listing deleted.']);
    }

    /** Republish expired */
    public function republish(Request $request,$id)
    {
        $listing = $request->user()->listings()->findOrFail($id);
        if ($listing->status_id !== 4) {
            return response()->json(['error'=>'Only expired listings can be republished.'],400);
        }
        $listing->update([
            'status_id'=>1,
            'expires_at'=>now()->addDays(30),
            'date_published'=>now(),
        ]);
        return response()->json(['message'=>'Listing republished.']);
    }

    /** Upload temp image */
    public function upload(Request $request)
    {
        Log::info('UPLOAD ATTEMPT', [
            'user_id' => $request->user()->id ?? null,
            'is_primary' => $request->boolean('is_primary', false),
            'has_file' => $request->hasFile('image'),
            'image_name' => $request->file('image')?->getClientOriginalName(),
            'image_size' => $request->file('image')?->getSize(),
            'mime' => $request->file('image')?->getMimeType(),
        ]);

        $request->validate([
            'image'=>'required|file|max:10240',
            'is_primary'=>'nullable|boolean'
        ]);

        $path = $request->file('image')->store('temp','b2');

        $tmp = TemporaryImage::create([
            'user_id'=>$request->user()->id,
            'b2_key'=>$path,
            'is_primary'=>$request->boolean('is_primary',false),
        ]);

        return response()->json($tmp,201);
    }

    /** Upload status */
    public function uploadStatus(Request $request)
    {
        $uid = $request->user()->id;
        return response()->json([
            'primary'=>['count'=>TemporaryImage::where('user_id',$uid)->where('is_primary',true)->count()],
            'gallery'=>['count'=>TemporaryImage::where('user_id',$uid)->where('is_primary',false)->count()],
        ]);
    }

    /** Helpers */
    protected function validatePrimaryImage(ValidatorContract $validator,int $userId):?TemporaryImage
    {
        $primary = TemporaryImage::where('user_id',$userId)->where('is_primary',true)->first();
        $validator->after(function($v) use($primary) {
            if(!$primary) {
                $v->errors()->add('primary_image','Ju lutem zgjidhni një foto kryesore.');
            }
        });
        return $primary;
    }

    protected function handleCategoryInsertion(string $code,Listing $listing,array $data):void
    {
        match($code) {
            'apartment'         => $listing->apartmentDetail()->create($data),
            'villa'             => $listing->villaDetail()->create($data),
            'garsoniere'        => $listing->garsoniereDetail()->create($data),
            'penthouse'         => $listing->penthouseDetail()->create($data),
            'shared_rent'       => $listing->sharedRentDetail()->create($data),
            'garage'            => $listing->garageDetail()->create($data),
            'shop'              => $listing->shopDetail()->create($data),
            'office'            => $listing->officeDetail()->create($data),
            'warehouse'         => $listing->warehouseDetail()->create($data),
            'plot'              => $listing->plotDetail()->create($data),
            'agricultural_land' => $listing->agriculturalLandDetail()->create($data),
            'business'          => (function() use($listing,$data){
                $detail = $listing->businessDetail()->create($data);
                if(!empty($data['business_types'])) {
                    $detail->businessTypes()->sync($data['business_types']);
                }
            })(),
            default => throw new \InvalidArgumentException("Unknown category code: {$code}"),
        };
    }
}
