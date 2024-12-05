<?php

namespace App\Http\Controllers\Client;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function getMenuPizza(Request $request)
    {
        $page = $request->input('currentPage', 1);
        $pageSize = $request->input('pageSize', 9);
        $categoryId = $request->input('categoryId', null);
        $search = $request->input('search', null);

        $query = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->orderByDesc('id');

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        if ($search) {
            $query->where('products.name', 'like', '%' . $search . '%');
        }

        $totalPizza = $query->count();
        $menus = $query->skip(($page - 1) * $pageSize)->take($pageSize)->get();


        return response()->json([
            'success' => true,
            'menus' => $menus,
            'totalPizza' => $totalPizza
        ], 200);
    }

    public function getPizzaRating(Request $request)
    {
        // Hàm lấy sản phẩm đánh giá
        $productRating = Product::join('product_reviews', 'products.id', '=', 'product_reviews.product_id')
            ->select('products.*', DB::raw('AVG(product_reviews.rating) as avg_rating'))
            ->groupBy('products.id')
            ->orderBy('avg_rating', 'desc')
            ->first();

        return response()->json([
            'success' => true,
            'productRating' => $productRating
        ], 200);
    }

    public function getPizzaRatingOnTop(Request $request)
    {
        // Hàm lấy sản phẩm đánh giá cao nhất
        $productRating = Product::join('product_reviews', 'products.id', '=', 'product_reviews.product_id')
            ->select('products.*', DB::raw('AVG(product_reviews.rating) as avg_rating'))
            ->groupBy('products.id')
            ->orderBy('avg_rating', 'desc')
            ->limit(4)
            ->get();

        return response()->json([
            'success' => true,
            'productRating' => $productRating
        ], 200);
    }
}
