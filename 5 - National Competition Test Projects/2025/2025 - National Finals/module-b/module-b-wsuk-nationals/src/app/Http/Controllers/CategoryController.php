<?php

namespace App\Http\Controllers;

use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Lists all categories.
     */
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    /**
     * Creates a new category.
     */
    public function store(CreateCategoryRequest $request)
    {
        $category = new Category($request->only('cat_name'));

        $category->save();

        return redirect()->back()->with('success', sprintf('Category "%s" created successfully', $category->cat_name));
    }

    /**
     * Updates an existing category.
     */
    public function update(Category $category, UpdateCategoryRequest $request)
    {
        $old = $category->cat_name;
        $new = $request->input('cat_name');

        $category->cat_name = $new;

        $category->save();

        return redirect()->back()->with('success', sprintf('Category name updated from "%s" to "%s"', $old, $new));
    }

    /**
     * Deletes an existing category.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->back()->with('success', sprintf('Category "%s" deleted successfully', $category->cat_name));
    }
}
