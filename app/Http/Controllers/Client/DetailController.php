<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function getDetailPizza(string $id)
    {
        $pizza = Product::with('category')->find($id);

        return response()->json([
            'success' => true,
            'pizza' => $pizza,
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
