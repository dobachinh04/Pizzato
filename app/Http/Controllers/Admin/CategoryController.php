<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, StoreCategoryRequest $categoryrequest)
    {
        $categoryrequest->run();
        Category::create($request->all());

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $request)
    {
        $categories = Category::findOrFail($id);
        $categories->update($request->all());

        return view('admin.categories.update', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, UpdateCategoryRequest $categoryrequest)
    {
        $categoryrequest->run();

        $categories = Category::findOrFail($id);
        $categories->name = $request->input('name');
        $categories->slug = $request->input('slug');
        $categories->status = $request->input('status');
        $categories->show_at_home = $request->input('show_at_home');

        $categories->save();

        return redirect()
            ->back()
            ->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // if ($count !== 0) {
        //     return back()->with('success', 'danh mục còn ' . $count . 'sản phẩm . không thể xóa');
        // }
        $categories = Category::findOrFail($id);
        $categories->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
