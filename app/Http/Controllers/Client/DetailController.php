<?php

namespace App\Http\Controllers\Client;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductGallery;
use App\Http\Controllers\Controller;

class DetailController extends Controller
{
    public function getDetailPizza(string $id)
    {
        try {
            // Tìm sản phẩm kèm theo các quan hệ liên quan
            $pizza = Product::with([
                'category',             // Thông tin danh mục
                'productGalleries',     // Hình ảnh gallery
                'productSizes',         // Danh sách kích thước
                'pizzaEdges',           // Danh sách loại viền
                'pizzaBases'            // Danh sách loại đế
            ])->findOrFail($id);    // Nếu không tìm thấy, trả lỗi 404

            // Chuẩn bị dữ liệu trả về
            return response()->json([
                'success' => true,
                'product' => [
                    'id' => $pizza->id,
                    'name' => $pizza->name,
                    'slug' => $pizza->slug,
                    'thumb_image' => $pizza->thumb_image,
                    'category' => [
                        'id' => $pizza->category->id,
                        'name' => $pizza->category->name,
                    ],
                    'price' => $pizza->price,
                    'offer_price' => $pizza->offer_price,
                    'qty' => $pizza->qty,
                    'sku' => $pizza->sku,
                    'short_description' => $pizza->short_description,
                    'long_description' => $pizza->long_description,
                    'status' => $pizza->status,
                    'sizes' => $pizza->productSizes->map(function ($size) {
                        return [
                            'id' => $size->id,
                            'name' => $size->name,
                            'price' => $size->pivot->price,
                        ];
                    }),
                    'edges' => $pizza->pizzaEdges->map(function ($edge) {
                        return [
                            'id' => $edge->id,
                            'name' => $edge->name,
                            'price' => $edge->pivot->price,
                        ];
                    }),
                    'bases' => $pizza->pizzaBases->map(function ($base) {
                        return [
                            'id' => $base->id,
                            'name' => $base->name,
                            'price' => $base->pivot->price,
                        ];
                    }),
                    'galleries' => $pizza->productGalleries->map(function ($gallery) {
                        return [
                            'id' => $gallery->id,
                            'url' => $gallery->galleries,
                        ];
                    }),
                ],
            ]);
        } catch (\Exception $e) {
            // Xử lý lỗi
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function rating(Request $request)
    {
        // Hàm đánh giá sản phẩm
    }

    public function getSimilarPizzas(string $id)
    {
        $pizza = Product::findOrFail($id);
        $similarPizzas = Product::where('category_id', $pizza->category_id)
            ->where('id', '!=', $pizza->id)
            ->limit(4)
            ->get();

        return response()->json([
            'success' => true,
            'similarPizzas' => $similarPizzas,
        ]);
    }
}
