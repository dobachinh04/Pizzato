<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

        return view("admin.products.index", compact('data'));
    }


    public function create()
    {
        $sku = $this->generateUniqueSku();
        $slug = '';
        $categories = Category::query()->pluck('name', 'id')->all();

        return view("admin.products.create", compact('categories', 'sku', 'slug'));
    }


    public function store(StoreProductRequest $request)
    {
        $data = $request->except('thumb_image');
        if ($request->hasFile('thumb_image')) {
            $data['thumb_image'] = Storage::put(self::PATH_UPLOAD, $request->file('thumb_image'));
        }

        $data['slug'] = $this->createSlug($request->name);

        // Tự động cập nhật trạng thái dựa vào qty
        $data['status'] = $request->qty > 0 ? 1 : 0;

        // Đảm bảo trường 'view' có giá trị mặc định là 0
        $data['view'] = 0;

        Product::query()->create($data);
        return back()
            ->with('success', 'Thêm sản phẩm thành công!');
    }


    public function show(Product $product)
    {
        return view("admin.products.show", compact('product'));
    }


    public function edit(Product $product)
    {
        $slug = '';

        // Nếu muốn thay đổi SKU thì sinh lại mã SKU mới
        // $data['sku'] = $this->generateUniqueSku();

        $categories = Category::query()->pluck('name', 'id')->all();
        return view("admin.products.edit", compact('product', 'categories', 'slug'));
    }


    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->except('thumb_image');

        if ($request->hasFile('thumb_image')) {
            $data['thumb_image'] = Storage::put(self::PATH_UPLOAD, $request->file('thumb_image'));
        }

        $currentImage = $product->thumb_image;

        // Tạo slug từ tên sản phẩm
        $data['slug'] = $this->createSlug($request->name);

        // Tự động cập nhật trạng thái dựa vào qty
        $data['status'] = $request->qty > 0 ? 1 : 0;

        $product->update($data);

        // Nếu có giá trị 'thumb_image' hiện tại và tệp tồn tại trong hệ thống lưu trữ
        if ($request->hasFile('thumb_image') && $currentImage && Storage::exists($currentImage)) {
            Storage::delete($currentImage);
        }

        return back()
            ->with('success', 'Cập nhật sản phẩm thành công');
    }


    public function destroy(Product $product)
    {
        if ($product->thumb_image && Storage::exists($product->thumb_image)) {
            // Xóa file thumb_image từ storage
            Storage::delete($product->thumb_image);
        }

        $product->delete();

        return back()
            ->with('success', 'Xoá sản phẩm thành công!');
    }

    protected function generateUniqueSku()
    {
        do {
            $sku = 'SKU-' . strtoupper(uniqid());
        }
        while (Product::where('sku', $sku)->exists());

        return $sku;
    }

    protected function createSlug($name)
    {
        // Chuyển đổi tên thành slug
        $slug = Str::slug($name);

        // slug->exist ?  thêm số vào sau :  no
        $count = Product::where('slug', $slug)->count();
        return $count > 0 ? "{$slug}-{$count}" : $slug;
    }
}
