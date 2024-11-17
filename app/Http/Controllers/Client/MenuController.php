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
        $page = $request->input('page', 1);
        $pageSize = $request->input('pageSize', 9);
        $categoryId = $request->input('categoryId', null);
        $search = $request->input('search', null);

        $query = DB::table('products')
            ->join('categories', 'products.category_id' , '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->orderByDesc('id');

        if($categoryId) {
            $query->where('category_id', $categoryId);
        }

        if($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        // $totalPizza = $menus->count();
        $menus = $query->skip(($page - 1) * $pageSize)->take($pageSize)->get();


        return response()->json([
            'success' => true,
            'menus' => $menus,
        ], 200);
    }

    public function getPizzaRating(Request $request)
    {
        // Hàm lấy sản phẩm đánh giá
    }

    public function getPizzaRatingOnTop(Request $request)
    {
        // Hàm lấy sản phẩm đánh giá cao nhất
    }
}
