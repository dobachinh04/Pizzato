<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductReview;

class ProductReviewController extends Controller
{
    public function index()
    {
        $data = ProductReview::with(['user', 'product'])->get();
        return view('admin.product-reviews.index', compact('data')); // Nếu trả về view
        // return response()->json($reviews); // Nếu cần trả JSON
    }





    // public function show($id)
    // {
    //     $productReview = Product::findOrFail($id);

    //     // Lấy tất cả đánh giá cho sản phẩm này,
    //     $productReviews = ProductReview::where('product_id', $id)
    //         ->with('user') // Nếu có liên kết với bảng người dùng để lấy thông tin người đánh giá
    //         ->orderBy('created_at', 'desc')
    //         ->get();

    //     return view('admin.product-reviews.show', compact('product', 'productReviews'));
    // }

    public function show($id)
    {
        // Lấy đánh giá dựa trên ID của đánh giá
        $productReview = ProductReview::findOrFail($id);

        // Lấy sản phẩm liên quan đến đánh giá này
        $product = $productReview->product;

        return view('admin.product-reviews.show', compact('product', 'productReview'));
    }

    // public function destroy($id)
    // {
    //     $review = ProductReview::findOrFail($id);
    //     $review->delete();
    //     return redirect()->route('product-reviews.index')->with('success', 'Đánh giá đã được xoá bỏ');
    // }
    public function destroy( $id)
    {
        $productReview = ProductReview::findOrFail($id);

        $productReview->delete();

        return redirect()->route('admin.product-reviews.index')
            ->with('success', 'Xoá đánh giá thành công!');
    }
}
