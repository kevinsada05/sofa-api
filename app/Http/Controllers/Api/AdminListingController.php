<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Listings\BaseListingRequest;
use App\Models\Category;
use App\Models\City;
use App\Models\DeviceToken;
use App\Models\Listing;
use App\Models\Ownership;
use App\Models\RentPeriod;
use App\Models\Status;
use App\Models\TransactionType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

class AdminListingController extends Controller
{
    public function index(Request $request)
    {
        $query = Listing::with(['category', 'city', 'status'])->latest();

        if ($request->filled('status_id')) {
            $query->where('status_id', $request->status_id);
        }

        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        return response()->json([
            'listings' => $query->take(100)->get(),
        'statuses' => Status::select('id', 'name')->get(),
            'cities' => City::select('id', 'name')->get(),
            'ownerships' => Ownership::select('id', 'name')->get(),
            'transactionTypes' => TransactionType::select('id', 'name')->get(),
            'rentPeriods' => RentPeriod::select('id', 'name')->get(),
            'categories' => Category::select('id', 'name')->get(),
        ]);
    }

    public function show(Request $request, $id)
    {
        $listing = Listing::with([
            'images',
            'category',
            'city',
            'transactionType',
            'rentPeriod',
            'ownership',
            'status',
            'user',
            'views'
        ])->findOrFail($id);

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
            'garage' => ['garageDetail'],
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
            'business' => ['businessDetail'],
        ];

        $categoryCode = $listing->category->code;

        if (isset($relations[$categoryCode])) {
            $listing->load($relations[$categoryCode]);
        }

        $detailRelation = $categoryCode . 'Detail';
        $detailId = $listing->$detailRelation?->id;
        $listing->details = $listing->$detailRelation ?? null;

        return response()->json([
            'listing'        => $listing,
            'categoryCode'   => $categoryCode,
            'detailRelation' => $detailRelation,
            'detailId'       => $detailId,
        ]);
    }

    public function accept($id)
    {
        $listing = Listing::findOrFail($id);
        $listing->update([
            'status_id' => 1, // Active
            'date_published' => Carbon::now(),
            'expires_at' => Carbon::now()->addDays(30),
        ]);

        $this->sendApprovalNotification($listing);

        return response()->json(['message' => 'Listing accepted.', 'listing' => $listing]);
    }

    public function decline($id)
    {
        $listing = Listing::findOrFail($id);
        $listing->update(['status_id' => 5]); // Canceled
        return response()->json(['message' => 'Listing declined.', 'listing' => $listing]);
    }

    protected function sendApprovalNotification(Listing $listing): void
    {
        $encoded = config('firebase.projects.app.credentials');
        $tmp = tmpfile();
        fwrite($tmp, base64_decode($encoded));
        $path = stream_get_meta_data($tmp)['uri'];

        // Initialize Firebase Messaging
        $factory = (new Factory)->withServiceAccount($path);
        $messaging = $factory->createMessaging();

        $token = DeviceToken::where('user_id', $listing->user_id)->value('token');
        if (!$token) {
            return;
        }

        $message = CloudMessage::fromArray([
            'token' => $token,
            'notification' => [
                'title' => 'Njoftimi u pranua me sukses 🎉',
                'body'  => "{$listing->title} është tashmë aktiv",
            ],
            'data' => [
                'deeplink' => "sofa://properties/{$listing->id}",
            ],
        ]);

        $messaging->send($message);
    }
    public function update(Request $request, $id)
    {
        $listing = Listing::findOrFail($id);

        $baseRequest = new BaseListingRequest();

        $validator = Validator::make(
            $request->all(),
            $baseRequest->rules(),
            $baseRequest->messages(),
            $baseRequest->attributes()
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $listing->update($validator->validated());

        return response()->json(['message' => 'Listing updated.', 'listing' => $listing]);
    }

    public function destroy($id)
    {
        $listing = Listing::findOrFail($id);

        Storage::disk('b2')->deleteDirectory("listings/{$listing->id}");
        $listing->delete();

        return response()->json(['message' => 'Listing deleted.']);
    }
}
