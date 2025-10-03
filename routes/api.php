<?php

use App\Http\Controllers\Api\AdminContactController;
use App\Http\Controllers\Api\AdminExpireListingController;
use App\Http\Controllers\Api\AdminListingController;
use App\Http\Controllers\Api\AdminNotificationController;
use App\Http\Controllers\Api\AdminUserController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\AuthListingController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\ListingController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\SystemErrorController;
use App\Http\Controllers\Api\UploadController;
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

        // Profile
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/profile/details', [ProfileController::class, 'editDetails'])->name('profile.details');
        Route::patch('/profile/details', [ProfileController::class, 'updateDetails'])->name('profile.details.update');
        Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('profile.password');
        Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Listings: creation meta (for Native flow)
        Route::get('/listings/create', [AuthListingController::class, 'createMeta']);
        Route::post('/listings/choose-category', [AuthListingController::class, 'chooseCategory']);
        Route::get('/listings/create/{category}', [AuthListingController::class, 'createMetaByCategory']);

        // Listings
        Route::get('/listings', [AuthListingController::class, 'index']);
        Route::post('/listings/{category}', [AuthListingController::class, 'store']);
        Route::get('/listings/{id}', [AuthListingController::class, 'show']);
        Route::put('/listings/{id}', [AuthListingController::class, 'update']);
        Route::delete('/listings/{id}', [AuthListingController::class, 'destroy']);
        Route::post('/listings/{id}/republish', [AuthListingController::class, 'republish']);

        // Uploads
        Route::post('/listings/upload', [UploadController::class, 'store']);
        Route::get('/listings/upload-status', [UploadController::class, 'status']);
    });
});

// ========== ADMIN ROUTES ==========
Route::prefix('admin')->middleware('auth:sanctum')->group(function () {
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
