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
        $pizza = Product::with([
            'category',
            'productGalleries',
            'productSizes',
            'pizzaEdges',
            'pizzaBases',
        ])->findOrFail($id);

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
                'view' => $pizza->view,
                'qty' => $pizza->qty,
                'sku' => $pizza->sku,
                'short_description' => $pizza->short_description,
                'long_description' => $pizza->long_description,
                'status' => $pizza->status,
                'sizes' => $pizza->productSizes->map(fn($size) => [
                    'id' => $size->id,
                    'name' => $size->name,
                    'price' => $size->pivot->price,
                ]),
                'edges' => $pizza->pizzaEdges->map(fn($edge) => [
                    'id' => $edge->id,
                    'name' => $edge->name,
                    'price' => $edge->pivot->price,
                ]),
                'bases' => $pizza->pizzaBases->map(fn($base) => [
                    'id' => $base->id,
                    'name' => $base->name,
                    'price' => $base->pivot->price,
                ]),
                'galleries' => $pizza->productGalleries->map(fn($gallery) => [
                    'id' => $gallery->id,
                    'url' => $gallery->galleries,
                ]),
            ],
        ]);
    }

    public function incrementView(String $id)
    {
        $product = Product::find($id);

        // Kiểm tra nếu sản phẩm không tồn tại
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->view += 1;
        $product->save();

        return response()->json([
            'message' => 'Cập nhật thành công',
            'product' => $product
        ]);
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
