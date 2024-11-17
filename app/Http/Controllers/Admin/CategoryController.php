<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        // Tạo mới danh mục
        $categories = new Category();
        $categories->name = $request->name;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // Lấy tên mở rộng .jpg, .png...
            $filename = time() . '.' . $extension;
            $file->move('uploads/categories/', $filename);
            $categories->image = $filename;
        }

        $categories->slug = $request->slug;
        $categories->status = $request->status;
        $categories->show_at_home = $request->show_at_home;

        $categories->save();

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
        $categories = Category::find($id);
        $categories->name = $request->name;

        if ($request->hasFile('image')) {
            $oldImage = 'uploads/categories/' . $categories->image;
            if (Storage::exists($oldImage)) {
                Storage::delete($oldImage);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // Lấy tên mở rộng .jpg, .png...
            $filename = time() . '.' . $extension;
            $file->move('uploads/categories/', $filename);
            $categories->image = $filename;
        }

        $categories->slug = $request->slug;
        $categories->status = $request->status;
        $categories->show_at_home = $request->show_at_home;

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
        $count = Product::where('category_id', '=', $id)->count();

        if ($count !== 0) {
            return back()->with('success', '<span style="color: red;">Danh mục còn ' . $count . ' Sản phẩm không thể xóa!</span>');
        }

        $categories = Category::findOrFail($id);
        $categories->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
