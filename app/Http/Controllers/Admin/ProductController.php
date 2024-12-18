<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\PizzaBase;
use App\Models\PizzaEdge;
use App\Models\ProductGallery;
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
    const PATH_DELETED = 'deleted_images';
    const CATEGORY_NULL = 'Chưa Phân Loại';
    // public function index()
    // {
    //     $data = Product::query()->with('category')->latest('id')->get();

    //     // Kiểm tra và thay thế name khi category là null
    //     $data = $data->map(function ($product) {
    //         if (is_null($product->category)) {
    //             $product->category = (object) ['name' => self::CATEGORY_NULL];
    //         }
    //         return $product;
    //     });
    //     return view("admin.products.index", compact('data'));
    // }
    public function index()
    {
        $data = Product::query()
            ->with(['category'])
            ->withTrashed()
            ->latest('id')
            ->get();

        // Kiểm tra và thay thế name khi category là null
        $data = $data->map(function ($product) {
            if (is_null($product->category)) {
                $product->category = (object) ['name' => self::CATEGORY_NULL];
            }
            return $product;
        });

        return view("admin.products.index", compact('data'));
    }



    public function create()
    {
        // $sku = $this->generateUniqueSku();
        $slug = '';
        $categories = Category::query()->pluck('name', 'id')->all();

        $sizes = ProductSize::select('id', 'name', 'price')->get();
        $edges = PizzaEdge::select('id', 'name', 'price')->get();
        $bases = PizzaBase::select('id', 'name', 'price')->get();

        return view("admin.products.create", compact('categories', 'slug', 'sizes', 'edges', 'bases'));
    }

    // private function calculateOptionPrice($sizeId, $edgeId, $baseId)
    // {
    //     $sizePrice = ProductSize::find($sizeId)?->price ?? 0;
    //     $edgePrice = PizzaEdge::find($edgeId)?->price ?? 0;
    //     $basePrice = PizzaBase::find($baseId)?->price ?? 0;

    //     return $sizePrice + $edgePrice + $basePrice;
    // }

    public function store(StoreProductRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                // xử lý ảnh
                $data = $request->except('thumb_image', 'sizes', 'edges', 'bases'); // Loại bỏ các trường không liên quan

                if ($request->hasFile('thumb_image')) {
                    $data['thumb_image'] = Storage::put(self::PATH_UPLOAD, $request->file('thumb_image'));
                }

                if ($request->hasFile('galleries')) {
                    $galleryPaths = []; // Mảng để lưu đường dẫn các file
                    foreach ($request->file('galleries') as $image) {
                        $galleryPaths[] = Storage::put('galleries', $image); // Lưu từng file và lưu đường dẫn vào mảng
                    }
                    $data['galleries'] = $galleryPaths; // Lưu mảng trực tiếp vào cơ sở dữ liệu
                }

                // $data['slug'] = $this->createSlug($request->name);
                $data['status'] = $request->qty > 0 ? 1 : 0; // Trạng thái tự động
                $data['view'] = 0; // Giá trị mặc định

                $product = Product::query()->create($data);

                // Lưu nhiều ảnh vào bảng `product_galleries` nếu cần
                if ($request->hasFile('galleries')) {
                    foreach ($request->file('galleries') as $image) {
                        ProductGallery::create([
                            'product_id' => $product->id,
                            'galleries' => Storage::put('galleries', $image), // Lưu file vào thư mục 'galleries'
                        ]);
                    }
                }

                // Xử lý sizes
                if ($request->filled('sizes')) {
                    $sizePriceData = [];
                    foreach ($request->sizes as $sizeId) {
                        $size = ProductSize::find($sizeId);
                        if ($size) {
                            $sizePriceData[$sizeId] = [
                                'price' => $size->price, // Lưu trực tiếp giá của size
                            ];
                        }
                    }
                    if (!empty($sizePriceData)) {
                        $product->productSizes()->attach($sizePriceData);
                    }
                }

                // Xử lý edges
                if ($request->filled('edges')) {
                    $edgePriceData = [];
                    foreach ($request->edges as $edgeId) {
                        $edge = PizzaEdge::find($edgeId);
                        if ($edge) {
                            $edgePriceData[$edgeId] = [
                                'price' => $edge->price, // Lưu trực tiếp giá của edge
                            ];
                        }
                    }
                    if (!empty($edgePriceData)) {
                        $product->pizzaEdges()->attach($edgePriceData);
                    }
                }

                // Xử lý bases
                if ($request->filled('bases')) {
                    $basePriceData = [];
                    foreach ($request->bases as $baseId) {
                        $base = PizzaBase::find($baseId);
                        if ($base) {
                            $basePriceData[$baseId] = [
                                'price' => $base->price, // Lưu trực tiếp giá của base
                            ];
                        }
                    }
                    if (!empty($basePriceData)) {
                        $product->pizzaBases()->attach($basePriceData);
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
        // $productSizes = $product->productSizes;
        $product->load(['category', 'productGalleries', 'productSizes', 'pizzaEdges', 'pizzaBases']);

        // Kiểm tra và thay thế name của category nếu nó là null
        if (is_null($product->category)) {
            $product->category = (object) ['name' => self::CATEGORY_NULL];
        }
        // return view("admin.products.show", compact('product', 'productSizes'));
        return view("admin.products.show", compact('product'));
    }

    public function edit(Product $product)
    {
        $product->load(['category', 'productGalleries', 'productSizes', 'pizzaEdges', 'pizzaBases']);

        $slug = '';

        // Nếu muốn thay đổi SKU thì sinh lại mã SKU mới
        // $data['sku'] = $this->generateUniqueSku();

        $categories = Category::query()->pluck('name', 'id')->all();

        $productCategoryName = $product->category ? $product->category->name : self::CATEGORY_NULL;

        $sizes = ProductSize::all();
        $productSizes = $product->productSizes->pluck('id')->all();

        $edges = PizzaEdge::all();
        $pizzaEdges = $product->pizzaEdges->pluck('id')->all();

        $bases = PizzaBase::all();
        $pizzaBases = $product->pizzaBases->pluck('id')->all();

        return view(
            "admin.products.edit",
            compact(
                'product',
                'categories',
                'slug',
                'sizes',
                'edges',
                'bases',
                'productSizes',
                'pizzaEdges',
                'pizzaBases'
            )
        );
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            DB::transaction(function () use ($request, $product) {

                // Xử lý ảnh thumb_image
                $data = $request->except('thumb_image');
                if ($request->hasFile('thumb_image')) {
                    $data['thumb_image'] = Storage::put(self::PATH_UPLOAD, $request->file('thumb_image'));
                }
                $currentImage = $product->thumb_image;

                // Tự động cập nhật trạng thái dựa vào qty
                $data['status'] = $request->qty > 0 ? 1 : 0;
                $product->update($data);

                // Nếu có giá trị 'thumb_image' hiện tại và tệp tồn tại trong hệ thống lưu trữ
                if ($request->hasFile('thumb_image') && $currentImage && Storage::exists($currentImage)) {
                    Storage::delete($currentImage);
                }

                // Cập nhật gallery
                // Lấy danh sách ID các ảnh được giữ lại
                $keepGalleries = $request->keep_galleries ?? [];

                // Xóa các ảnh không nằm trong danh sách giữ lại
                ProductGallery::where('product_id', $product->id)
                    ->whereNotIn('id', $keepGalleries)
                    ->each(function ($gallery) {
                        if (Storage::exists($gallery->galleries)) {
                            Storage::delete($gallery->galleries);
                        }
                        $gallery->delete();
                    });

                // Thêm mới ảnh nếu có
                if ($request->hasFile('galleries')) {
                    foreach ($request->file('galleries') as $image) {
                        ProductGallery::create([
                            'product_id' => $product->id,
                            'galleries' => Storage::put('galleries', $image),
                        ]);
                    }
                }
                // Size
                if (!empty($request->sizes)) {
                    $productSizesData = [];
                    foreach ($request->sizes as $sizeId) {
                        $size = ProductSize::find($sizeId);
                        $productSizesData[$sizeId] = ['price' => $size->price];
                    }
                    $product->productSizes()->sync($productSizesData);
                }

                // Edge
                if (!empty($request->edges)) {
                    $productEdgesData = [];
                    foreach ($request->edges as $edgeId) {
                        $edge = PizzaEdge::find($edgeId);
                        $productEdgesData[$edgeId] = ['price' => $edge->price];
                    }
                    $product->pizzaEdges()->sync($productEdgesData);
                }

                // Base
                if (!empty($request->bases)) {
                    $productBasesData = [];
                    foreach ($request->bases as $baseId) {
                        $base = PizzaBase::find($baseId);
                        $productBasesData[$baseId] = ['price' => $base->price];
                    }
                    $product->pizzaBases()->sync($productBasesData);
                }

                // dd($request->all());

            });

            return back()->with('success', 'Cập Nhật thành công');
        } catch (Exception $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }

    public function destroy(Product $product)
    {
        try {
            DB::transaction(function () use ($product) {
                // Lưu thông tin sản phẩm vào bảng product_archives
                DB::table('product_archives')->insert([
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'thumb_image' => $product->thumb_image,
                    'category_id' => $product->category_id,
                    'short_description' => $product->short_description,
                    'long_description' => $product->long_description,
                    'price' => $product->price,
                    'offer_price' => $product->offer_price,
                    'qty' => $product->qty,
                    'sku' => $product->sku,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Làm trống sizes - Xóa sizes
                // $product->productSizes()->sync([]);
                // $product->pizzaEdges()->sync([]);
                // $product->pizzaBases()->sync([]);

                // $product->productGalleries()->delete();

                // Xóa mềm sản phẩm
                $product->delete();
            });

            // Di chuyển ảnh thumb_image vào thư mục deleted
            if ($product->thumb_image && Storage::exists($product->thumb_image)) {
                $filename = basename($product->thumb_image);
                $newPath = self::PATH_DELETED . '/' . $filename;
                Storage::move($product->thumb_image, $newPath);
            }

            return redirect()->route('admin.products.index')->with('success', 'Xóa và lưu trữ thành công');
        } catch (Exception $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }

    protected function generateUniqueSku()
    {
        do {
            $sku = 'SKU-' . strtoupper(uniqid());
        } while (Product::where('sku', $sku)->exists());

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

    public function restore($id)
    {
        try {

            DB::transaction(function () use ($id) {
                // Khôi phục sản phẩm trong bảng products
                $product = Product::withTrashed()->findOrFail($id);
                $product->restore();


                DB::table('product_archives')->where('product_id', $id)->delete();
            });

            return redirect()->route('admin.products.index')->with('success', 'Khôi phục sản phẩm thành công và đã xóa bản ghi lưu trữ.');
        } catch (\Exception $exception) {
            return back()->withErrors('Có lỗi xảy ra: ' . $exception->getMessage());
        }
    }

    public function forceDelete($id)
    {
        $product = Product::withTrashed()->findOrFail($id);

        DB::transaction(function () use ($product) {
            $product->forceDelete();
        });

        return redirect()->route('admin.products.index')->with('success', 'Xóa cứng thành công');
    }
}
