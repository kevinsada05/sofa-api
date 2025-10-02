<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function me(Request $request)
    {
        $user = $request->user()->load('profile', 'type');
        return response()->json($user);
    }
}
