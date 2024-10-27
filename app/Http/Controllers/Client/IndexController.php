<?php

namespace App\Http\Controllers\Client;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function getHotProduct()
    {
        $hotPizza = DB::table('products')
            ->orderByDesc('view')
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

    public function getMenuPizza()
    {
        $categories = DB::table('categories')
            ->limit(6)
            ->get();

        $result = [];

        foreach ($categories as $category) {
            $pizzas = DB::table('products')
                ->where('category_id', $category->id)
                ->orderByDesc('id')
                ->limit(6)
                ->get();

            $result[] = [
                'category' => $category,
                'pizzas' => $pizzas
            ];
        }

        return response()->json([
            'success' => true,
            'categories' => $result
        ], 200);
    }
}
