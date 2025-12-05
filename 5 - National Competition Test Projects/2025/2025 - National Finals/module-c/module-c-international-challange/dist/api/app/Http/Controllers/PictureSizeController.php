<?php

namespace App\Http\Controllers;

use App\Http\Resources\PictureSizeResource;
use App\Models\PictureSize;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PictureSizeController extends Controller
{
    /**
     * Return all available picture sizes
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $pictureSizes = PictureSize::all();
        return response()->json([
            'success' => true,
            'pictureSizes' => PictureSizeResource::collection($pictureSizes)
        ], 200);
    }

    public function show(PictureSize $pictureSize)
    {
        return response()->json([
            'success' => true,
            'pictureSize' => PictureSizeResource::make($pictureSize)
        ]);
    }
}
