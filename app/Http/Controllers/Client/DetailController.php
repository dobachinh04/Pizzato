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
        $pizza = Product::with('category')->find($id);
        $galaries = ProductGallery::where('product_id', $id)->get();

        return response()->json([
            'success' => true,
            'pizza' => $pizza,
            'galaries' => $galaries,
        ]);
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
