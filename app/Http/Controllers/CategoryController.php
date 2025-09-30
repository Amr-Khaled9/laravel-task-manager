<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('category', compact('categories'));
    }

    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->validated());
        toastr()->success('Category Created Successfully');
        return back();
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'color' => $request->color,
            'icon' => $request->icon,
        ]);
        toastr()->success('Category Updated Successfully');
        return back();
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if($category->tasks()->count() > 0) {
            toastr()->error("You aren't able to delete this category because it has tasks");
            return back();
        }
        $category->delete();
            toastr()->success('Category Deleted Successfully');
            return back();
    }
}
