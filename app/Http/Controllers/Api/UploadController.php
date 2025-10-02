<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TemporaryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'file', 'mimes:jpg,jpeg,png,webp,gif', 'max:10240'],
            'is_primary' => ['nullable', 'boolean'],
        ]);

        $file = $request->file('image');
        $ext  = $file->getClientOriginalExtension() ?: 'jpg';

        $key = 'tmp/' . Str::uuid() . '.' . $ext;

        // upload to B2
        Storage::disk('b2')->put($key, file_get_contents($file), [
            'CacheControl' => 'public, max-age=31536000',
        ]);

        // save in DB
        $userId = $request->user()->id;

        if ($request->boolean('is_primary')) {
            TemporaryImage::where('user_id', $userId)->update(['is_primary' => false]);
        }

        $record = TemporaryImage::create([
            'user_id'       => $userId,
            'is_primary'    => $request->boolean('is_primary'),
            'b2_key'        => $key,
            'original_name' => $file->getClientOriginalName(),
            'size'          => $file->getSize(),
        ]);

        return response()->json([
            'id'  => $record->id,
            'url' => Storage::disk('b2')->url($key),
        ]);
    }

    public function status(Request $request)
    {
        $userId = $request->user()->id;

        return response()->json([
            'primary' => [
                'count' => TemporaryImage::where('user_id', $userId)->where('is_primary', true)->count(),
            ],
            'gallery' => [
                'count' => TemporaryImage::where('user_id', $userId)->where('is_primary', false)->count(),
            ],
        ]);
    }
}
