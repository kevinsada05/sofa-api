<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // 🔎 Filters
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }

        if ($request->filled('user_type_id')) {
            $query->where('user_type_id', $request->user_type_id);
        }

        $users = $query->latest()->get();

        $stats = [
            'total'           => User::count(),
            'with_active'     => User::whereHas('listings', fn($q) => $q->where('status_id', 1))->count(),
            'without_active'  => User::whereDoesntHave('listings', fn($q) => $q->where('status_id', 1))->count(),
            'with_listings'   => User::has('listings')->count(),
            'without_listings'=> User::doesntHave('listings')->count(),
        ];

        $userTypes = UserType::all();

        return response()->json([
            'users' => $users,
            'stats' => $stats,
            'userTypes' => $userTypes
        ]);
    }

    public function show($id)
    {
        $user = User::with('listings')->findOrFail($id);

        return response()->json([
            'user' => $user
        ]);
    }
}
