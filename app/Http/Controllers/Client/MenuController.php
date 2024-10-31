<?php

namespace App\Http\Controllers\Client;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function getMenuPizza()
    {
        $menus = DB::table('products')
            ->join('categories', 'products.category_id' , '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->orderByDesc('id')
            ->limit(9)
            ->get();


        return response()->json([
            'success' => true,
            'menus' => $menus,
        ], 200);
    }
}
