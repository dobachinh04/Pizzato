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
    public function destroy($id)
    {
        $productReview = ProductReview::findOrFail($id);

        $productReview->delete();

        return redirect()->route('admin.product-reviews.index')
            ->with('success', 'Xoá đánh giá thành công!');
    }


    public function reviewsSummary()
    {
        // Tổng số đánh giá
        $totalReviews = ProductReview::count();

        // Điểm trung bình
        $averageRating = ProductReview::average('rating') ?? 0; // Đặt giá trị mặc định là 0 nếu không có đánh giá nào.

        // Số lượng đánh giá theo sao
        $ratingsCount = ProductReview::select('rating', DB::raw('count(*) as count'))
            ->groupBy('rating')
            ->orderBy('rating', 'desc')
            ->get();

        // Tính phần trăm từng mức sao
        $ratingsPercent = $ratingsCount->map(function ($item) use ($totalReviews) {
            $item->percent = $totalReviews > 0 ? ($item->count / $totalReviews) * 100 : 0;
            return $item;
        });

        return view('admin.users.dashboard', compact('totalReviews', 'averageRating', 'ratingsPercent'));
    }

}
