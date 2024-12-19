<?php

namespace App\Http\Controllers\Client;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function getHotProduct()
    {
        $hotPizza = Product::orderByDesc('view')
            ->limit(1)
            ->get();

        $gallaries = DB::table('product_galleries')
            ->where('product_id', $hotPizza->first()->id)
            ->orderByDesc('id')
            ->limit(2)
            ->get();

        return response()->json([
            'success' => true,
            'hotPizza' => $hotPizza,
            'gallaries' => $gallaries
        ], 200);
    }

    public function getCategories()
    {
        $categories = DB::table('categories')
            ->limit(6)
            ->get();

        return response()->json([
            'success' => true,
            'categories' => $categories
        ], 200);
    }

    public function getMenuPizza()
    {
        $categories = Category::with(['products' => function ($query) {
            $query->orderByDesc('id')->limit(6);
        }])
        ->limit(6)
        ->get();

        $result = $categories->map(function ($category) {
            return [
                'category' => $category,
                'pizzas' => $category->products,
            ];
        });

        return response()->json([
            'success' => true,
            'categories' => $result
        ], 200);
    }
}
