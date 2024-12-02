<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductReviewController extends Controller
{
    public function index()
    {
        $data = ProductReview::with(['user', 'product'])->get();
        return view('admin.product-reviews.index', compact('data')); // Nếu trả về view
        // return response()->json($reviews); // Nếu cần trả JSON
    }

 

    public function show($id)
    {
        // Lấy đánh giá dựa trên ID của đánh giá
        $productReview = ProductReview::findOrFail($id);

        // Lấy sản phẩm liên quan đến đánh giá này
        $product = $productReview->product;

        return view('admin.product-reviews.show', compact('product', 'productReview'));
    }

  
    public function destroy($id)
    {
        $productReview = ProductReview::findOrFail($id);

        $productReview->delete();

        return redirect()->route('admin.product-reviews.index')
            ->with('success', 'Xoá đánh giá thành công!');
    }



}
