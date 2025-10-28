<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SystemError;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class SystemErrorController extends Controller
{
    public function index(): JsonResponse
    {
        $errors = SystemError::latest()->get();

        return response()->json([
            'errors' => $errors->items(),
            'pagination' => [
                'current_page' => $errors->currentPage(),
                'last_page'    => $errors->lastPage(),
                'per_page'     => $errors->perPage(),
                'total'        => $errors->total(),
            ]
        ]);
    }

    public function show(SystemError $systemError): JsonResponse
    {
        return response()->json([
            'error' => $systemError
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'message' => 'required|string',
                'trace'   => 'nullable|string',
                'file'    => 'nullable|string',
                'line'    => 'nullable|integer',
                'url'     => 'nullable|string',
                'method'  => 'nullable|string',
                'user_id' => 'nullable|integer',
            ]);

            $error = SystemError::create($validated);

            return response()->json(['success' => true, 'id' => $error->id], 201);
        } catch (Throwable $e) {
            // Fallback if DB is down or model fails
            Log::error('Failed to save system error', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Could not log error'], 500);
        }
    }
}
