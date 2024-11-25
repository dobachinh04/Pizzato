<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\PizzeBase;
use App\Models\PizzeEdge;
use App\Models\ProductOption;
use App\Models\ProductSize;
use Exception;
use Illuminate\Support\Facades\DB;
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

        $sizes = ProductSize::select('id', 'name', 'price')->get();
        $edges = PizzeEdge::select('id', 'name', 'price')->get();
        $bases = PizzeBase::select('id', 'name', 'price')->get();

        return view("admin.products.create", compact('categories', 'sku', 'slug', 'sizes', 'edges', 'bases'));
    }

    private function calculateOptionPrice($sizeId, $edgeId, $baseId)
    {
        $sizePrice = ProductSize::find($sizeId)?->price ?? 0;
        $edgePrice = PizzeEdge::find($edgeId)?->price ?? 0;
        $basePrice = PizzeBase::find($baseId)?->price ?? 0;

        return $sizePrice + $edgePrice + $basePrice;
    }

    public function store(StoreProductRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                // Lưu dữ liệu sản phẩm
                $data = $request->except('thumb_image', 'sizes', 'edges', 'bases'); // Loại bỏ các trường không liên quan
                if ($request->hasFile('thumb_image')) {
                    $data['thumb_image'] = Storage::put(self::PATH_UPLOAD, $request->file('thumb_image'));
                }

                $data['slug'] = $this->createSlug($request->name);
                $data['status'] = $request->qty > 0 ? 1 : 0; // Trạng thái tự động
                $data['view'] = 0; // Giá trị mặc định

                $product = Product::query()->create($data);

                // Nếu sizes tồn tại và không rỗng
                if ($request->filled('sizes')) {
                    $sizes = $request->sizes; // Lấy danh sách size từ request
                    $sizePriceData = [];
                    foreach ($sizes as $sizeId) {
                        $size = ProductSize::find($sizeId);
                        if ($size) {
                            $sizePriceData[$sizeId] = [
                                'price' => $product->offer_price + $size->price,
                            ];
                        }
                    }

                    if (!empty($sizePriceData)) {
                        $product->productSizes()->attach($sizePriceData);
                    }
                }
            });

            return redirect()->route('admin.products.index')->with('success', 'Thêm thành công');
        } catch (Exception $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
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
        try {
            DB::transaction(function () use ($product) {
                // Làm trống tags - Xóa tags
                $product->productSizes()->sync([]);

                // Xóa galleries
                // $product->galleries()->delete();

                // Xóa product
                $product->delete();
            });

            // Xóa ảnh trong product
            if ($product->thumb_image && Storage::exists($product->thumb_image)) {
                // Xóa file thumb_image từ storage
                Storage::delete($product->thumb_image);
            }

            // foreach ($product->galleries as $item) {
            //     $item
            // }

            return redirect()->route('admin.products.index')->with('success', 'Xóa thành công');
        } catch (Exception $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
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
