<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Return all categories
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'categories' => CategoryResource::collection(Category::all())
        ]);
    }

    public function show(Category $category)
    {
        return response()->json([
           'success' =>  true,
           'category' => CategoryResource::make($category)
        ]);
    }
}
