<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductSizeRequest;
use App\Http\Requests\UpdateProductSizeRequest;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductSizeController extends Controller
{
    const PATH_UPLOAD = 'products/product-sizes';
    public function index()
    {
        $productSizes = ProductSize::query()->latest('id')->get();
        return view('admin.product-sizes.index', compact('productSizes'));
    }


    public function create()
    {
        return view('admin.product-sizes.create');
    }


    public function store(StoreProductSizeRequest $request)
    {

        // xử lý ảnh
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
        }

        ProductSize::query()->create($data);

        return redirect()
            ->route('admin.product-sizes.index')
            ->with('success', 'Thêm thành công');
    }

    // public function show(ProductSize $product_size)
    // {

    //     return view('admin.product_sizes.show', compact('product_size'));
    // }


    public function edit(ProductSize $productSize)
    {
        return view('admin.product-sizes.edit', compact('productSize'));
    }

    public function update(UpdateProductSizeRequest $request, ProductSize $productSize){
        $data = $request->except('image');

        // dd($data);
        if ($request->hasFile('image')) {
            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
        }
        $currentImage = $productSize->image;  //lưu lại giá trị hiện tại trước khi update (ảnh)


        $productSize->update($data);

        // Nếu có giá trị 'image' hiện tại và tệp tồn tại trong hệ thống lưu trữ
        if ($request->hasFile('image') && $currentImage && Storage::exists($currentImage)) {
            Storage::delete($currentImage);
        }
        return back()
            ->with('success', 'Sửa thành công');
    }


    public function destroy(ProductSize $productSize)
    {

        // Xóa ảnh nếu tồn tại
        if ($productSize->image && Storage::exists($productSize->image)) {
            // Xóa file image từ storage
            Storage::delete($productSize->image);
        }

        $productSize->delete();

        return redirect()
            ->route('admin.product-sizes.index')
            ->with('success', 'Xóa thành công');
    }
}
