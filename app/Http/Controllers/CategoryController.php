<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function index()
    {
        return view('backend.categories.index', [
            'categories' => Category::with([
                'user' => function ($query) {
                    $query->select('id', 'name');
                }
            ])->select('id as cat_id', 'name', 'fee_per_hour', 'created_at', 'created_by')->get()
        ]);
    }

    public function create()
    {
        return view('backend.categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        Category::updateOrCreate(['id' => $request->category_id], [
            'name' => $request->name,
            'fee_per_hour' => $request->fee_per_hour,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('backend.categories.index')->with('success', 'Category Created Successfully!!');
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('backend.categories.edit', compact('category'));
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('backend.categories.index')->with('success', 'Category Deleted Successfully!!');
    }
}
