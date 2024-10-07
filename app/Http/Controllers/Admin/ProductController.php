<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.products.';
    const PATH_UPLOAD = 'products';
    public function index()
    {
        $data = Product::query()->with('category')->latest('id')->get();
        // dd($data);
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->pluck('name', 'id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->except('thumb_image');
        if ($request->hasFile('thumb_image')) {
            $data['thumb_image'] = Storage::put(self::PATH_UPLOAD, $request->file('thumb_image'));
        }
        Product::query()->create($data);
        return back()->with('success', 'Product added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // dd($product);
        // Tăng giá trị của trường view
        // $product->increment('view');
        return view(self::PATH_VIEW . __FUNCTION__, compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::query()->pluck('name', 'id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->except('thumb_image');
        if ($request->hasFile('thumb_image')) {
            $data['thumb_image'] = Storage::put(self::PATH_UPLOAD, $request->file('thumb_image'));
        }
        $currentImage = $product->thumb_image; // lưu ảnh trước khi update
        $product->update($data);

        // Nếu có giá trị 'thumb_image' hiện tại và tệp tồn tại trong hệ thống lưu trữ
        if ($request->hasFile('thumb_image') && $currentImage && Storage::exists($currentImage)) {
            Storage::delete($currentImage);
        }
        return back()->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->thumb_image && Storage::exists($product->thumb_image)) {
            // Xóa file thumb_image từ storage
            Storage::delete($product->thumb_image);
        }
        $product->delete();
        return back()->with('success', 'Product deleted successfully.');
    }
}