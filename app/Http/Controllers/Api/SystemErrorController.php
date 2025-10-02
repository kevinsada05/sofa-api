<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SystemError;
use Illuminate\Http\JsonResponse;

class SystemErrorController extends Controller
{
    public function index(): JsonResponse
    {
        $errors = SystemError::latest()->paginate(20);

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
}
