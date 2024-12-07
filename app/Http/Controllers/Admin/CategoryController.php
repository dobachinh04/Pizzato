<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            ->with('success', 'Thêm mới thành công');
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
            ->with('success', 'Cập nhật thành công');
    }

    // public function destroy(Request $request, string $id)
    // {
    //     $category = Category::findOrFail($id);

    //     // Kiểm tra hành động từ người dùng
    //     $action = $request->input('action');

    //     if ($category->products()->exists()) {
    //         if ($action === 'delete_products') {
    //             // Xóa tất cả sản phẩm và các biến thể liên quan
    //             DB::transaction(function () use ($category) {
    //                 $category->products->each(function ($product) {
    //                     // Xóa các mối quan hệ liên quan đến biến thể
    //                     $product->productSizes()->sync([]);
    //                     $product->pizzaEdges()->sync([]);
    //                     $product->pizzaBases()->sync([]);

    //                     $product->productGalleries()->delete();

    //                     // Xóa sản phẩm
    //                     $product->delete();
    //                 });
    //             });
    //         } elseif ($action === 'move_products') {
    //             // Chuyển sản phẩm sang danh mục khác
    //             $newCategoryId = $request->input('new_category_id');
    //             if ($newCategoryId) {
    //                 $category->products()->update(['category_id' => $newCategoryId]);
    //             }
    //         } else {
    //             // Gắn nhãn "Chưa có danh mục" (category_id = null)
    //             $category->products()->update(['category_id' => null]);
    //         }
    //     }

    //     // Xóa danh mục
    //     $category->delete();

    //     return redirect()
    //         ->route('admin.categories.index')
    //         ->with('success', 'Xóa danh mục và các biến thể thành công.');
    // }

    public function destroy(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        $message = 'Xóa danh mục thành công.';
        // Kiểm tra hành động từ người dùng
        $action = $request->input('action');

        if ($category->products()->exists()) {
            if ($action === 'delete_products') {
                // Xóa tất cả sản phẩm và các biến thể liên quan
                DB::transaction(function () use ($category) {
                    $category->products->each(function ($product) {
                        // Xóa các mối quan hệ liên quan đến biến thể
                        $product->productSizes()->sync([]);
                        $product->pizzaEdges()->sync([]);
                        $product->pizzaBases()->sync([]);

                        $product->productGalleries()->delete();

                        // Xóa sản phẩm
                        $product->delete();
                    });
                });
                $message = 'Xóa danh mục và tất cả sản phẩm thành công.';
            } elseif ($action === 'move_products') {
                // Chuyển sản phẩm sang danh mục khác
                $newCategoryId = $request->input('new_category_id');
                if ($newCategoryId) {
                    DB::transaction(function () use ($category, $newCategoryId) {
                        $category->products->each(function ($product) use ($category, $newCategoryId) {
                            // Kiểm tra xem danh mục hiện tại có phải là "pizza" hay không
                            if ($category->name != 'pizza') {
                                // Xóa các biến thể liên quan
                                $product->productSizes()->sync([]);
                                $product->pizzaEdges()->sync([]);
                                $product->pizzaBases()->sync([]);
                            }

                            // Cập nhật danh mục cho sản phẩm
                            $product->update(['category_id' => $newCategoryId]);
                        });
                    });
                    $message = 'Xóa danh mục và chuyển sản phẩm sang danh mục khác thành công.';
                }
            } else {
                // Gắn nhãn "Chưa có danh mục" (category_id = null)
                $category->products()->update(['category_id' => null]);
                $message = 'Xóa danh mục và gắn nhãn "Chưa Phân Loại" cho sản phẩm thành công.';
            }
        }

        // Xóa danh mục
        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', $message);
    }
}
