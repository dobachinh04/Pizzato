<?php

namespace App\Http\Controllers\Client;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function getCategories()
    {
        $categories = DB::table('categories')
            ->get();

        return response()->json([
            'success' => true,
            'categories' => $categories
        ], 200);
    }

    public function getMenuPizza(Request $request)
    {
        $categories = $request->input('categories', null);
        $search = $request->input('searchTerm', null);
        $sort = $request->input('sort', '1');

        $query = Product::with('category')
            ->leftJoin('product_reviews', 'products.id', '=', 'product_reviews.product_id')
            ->select(
                'products.*',
                'categories.name as category_name',
                DB::raw('COALESCE(AVG(product_reviews.rating), 0) as avg_rating'),
                DB::raw('COUNT(product_reviews.id) as rating_count')
            )
            ->groupBy('products.id', 'categories.name');

        if ($request->has('minPrice') && $request->has('maxPrice')) {
            $query->whereBetween('offer_price', [$request->minPrice, $request->maxPrice]);
        }

        if ($categories) {
            $query->whereIn('category_id', $categories);
        }

        if ($search) {
            $query->where('products.name', 'like', '%' . $search . '%');
        }

        switch ($sort) {
            case '1':
                $query->orderByDesc('products.created_at'); // Sắp xếp theo Mới nhất
                break;
            case '2':
                $query->orderByDesc('products.view'); // Sắp xếp theo Phổ biến nhất
                break;
            case '3':
                $query->orderBy('products.offer_price'); // Sắp xếp theo Giá cả tăng dần
                break;
            case '4':
                $query->orderByDesc('products.offer_price'); // Sắp xếp theo Giá cả giảm dần
                break;
            default:
                $query->orderByDesc('products.created_at'); // Mặc định sắp xếp theo Mới nhất
                break;
        }

        $pageSize = $request->input('pageSize', 9);
        $menus = $query->paginate($pageSize);

        return response()->json([
            'success' => true,
            'menus' => $menus->items(),
            'totalPizza' => $menus->total(),
            'currentPage' => $menus->currentPage(),
            'lastPage' => $menus->lastPage(),
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
