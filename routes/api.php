<?php

use App\Http\Controllers\Api\AdminContactController;
use App\Http\Controllers\Api\AdminExpireListingController;
use App\Http\Controllers\Api\AdminListingController;
use App\Http\Controllers\Api\AdminNotificationController;
use App\Http\Controllers\Api\AdminUserController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\AuthListingController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\DeviceTokenController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\ListingController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\SystemErrorController;
use App\Http\Controllers\Api\UserTypeController;
use Illuminate\Support\Facades\Route;

// ========== AUTH USER ROUTES ==========
Route::prefix('auth')->group(function () {
    // Public
    Route::post('/register', [RegisterController::class, 'register']);
    Route::post('/login', [LoginController::class, 'login']);

    // Protected
    Route::middleware('auth.api:sanctum')->group(function () {
        Route::get('/me', [DashboardController::class, 'me']);
        Route::post('/logout', [LoginController::class, 'logout']);
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // routes/api.php
        Route::post('/device-tokens', [DeviceTokenController::class, 'store']);

        // Profile
        Route::get('/profile', [ProfileController::class, 'index']);
        Route::patch('/profile/details', [ProfileController::class, 'updateDetails']);
        Route::patch('/profile/password', [ProfileController::class, 'updatePassword']);
        Route::delete('/profile', [ProfileController::class, 'destroy']);

        Route::get('/create', [AuthListingController::class, 'createMeta']);
        Route::post('/choose-category', [AuthListingController::class, 'chooseCategory']);
        Route::get('/create/{category}', [AuthListingController::class, 'createMetaByCategory'])->name('api.auth.listings.create.byCategory');

        Route::post('/upload', [AuthListingController::class, 'upload']);
        Route::get('/upload-status', [AuthListingController::class, 'uploadStatus']);

        Route::get('/', [AuthListingController::class, 'index']);
        Route::post('/{category}', [AuthListingController::class, 'store']);
        Route::get('/{id}', [AuthListingController::class, 'show']);
        Route::put('/{id}', [AuthListingController::class, 'update']);
        Route::delete('/{id}', [AuthListingController::class, 'destroy']);
        Route::post('/{id}/republish', [AuthListingController::class, 'republish']);
    });
});

// ========== ADMIN ROUTES ==========
Route::prefix('admin')->middleware('auth:sanctum')->group(callback: function () {
    // Listings
    Route::get('/listings', [AdminListingController::class, 'index']);
    Route::get('/listings/{id}', [AdminListingController::class, 'show']);
    Route::post('/listings/{id}/accept', [AdminListingController::class, 'accept']);
    Route::post('/listings/{id}/decline', [AdminListingController::class, 'decline']);
    Route::put('/listings/{id}', [AdminListingController::class, 'update']);
    Route::delete('/listings/{id}', [AdminListingController::class, 'destroy']);

    // Users
    Route::get('/users', [AdminUserController::class, 'index']);
    Route::get('/users/{id}', [AdminUserController::class, 'show']);

    // Contacts
    Route::get('/contacts', [AdminContactController::class, 'index']);
    Route::get('/contacts/{id}', [AdminContactController::class, 'show']);

    // Notifications
    Route::get('/notifications/create', [AdminNotificationController::class, 'create']);
    Route::post('/notifications', [AdminNotificationController::class, 'store']);

    Route::get('/expire-listings', [AdminExpireListingController::class, 'index']);
    Route::post('/expire-listings/run', [AdminExpireListingController::class, 'run']);

    Route::get('/errors', [SystemErrorController::class, 'index']);
    Route::get('/errors/{systemError}', [SystemErrorController::class, 'show']);
});

// ========== PUBLIC ROUTES ==========
Route::get('/user-types', [UserTypeController::class, 'index']);
Route::get('/listings', [ListingController::class, 'index']);
Route::get('/listings/{id}', [ListingController::class, 'show']);

// Guest Favorites
Route::get('/favorites', [FavoriteController::class, 'guestIndex']);
Route::post('/favorites/{listing}', [FavoriteController::class, 'guestStore']);
Route::delete('/favorites/{listing}', [FavoriteController::class, 'guestDestroy']);

Route::post('/contacts', [ContactController::class, 'store']);
Route::post('/errors', [SystemErrorController::class, 'store']);
