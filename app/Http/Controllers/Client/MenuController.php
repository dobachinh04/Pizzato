<?php

namespace App\Http\Controllers\Client;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function getMenuPizza()
    {
        $menus = Product::all();

        return response()->json([
            'success' => true,
            'menus' => $menus,
        ], 200);
    }
}
