<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProductReviewRequest as StoreReviewRequest;
use App\Http\Requests\UpdateProductReviewRequest as UpdateReviewRequest;

class ProductReviewController extends Controller
{
    // tạo đánh giá mới
    public function createReview(StoreReviewRequest $request)
    {
        // Tạo đánh giá mới
        $review = ProductReview::create([
            // 'user_id' => Auth::id(),  // Lấy ID người dùng hiện tại
            'user_id' => 1,
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return response()->json(['message' => 'Đánh giá được tạo thành công!', 'data' => $review], 201);
    }

    // hiển thị tất cả các đánh giá của một sản phẩm
    public function getReviews($productId)
    {
        $reviews = ProductReview::query()
        ->where('product_id', $productId)
            ->with('user') // Lấy thêm thông tin user
            ->get();

        return response()->json($reviews);
    }

    // sửa đánh giá của người dùng
    // sửa theo
    public function updateReview(UpdateReviewRequest $request, $id)
    {
        // Kiểm tra xem đánh giá có tồn tại và thuộc về người dùng hiện tại hay không
        $review = ProductReview::where('id', $id)
        ->where('user_id', 6)

        //     ->where('user_id', Auth::id())
            ->firstOrFail();



        // Cập nhật đánh giá
        $review->update([
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return response()->json(['message' => 'Sửa đánh giá thành công!', 'data' => $review], 200);
    }

    // xóa đánh giá của người dùng
    // public function deleteReview($id)
    // {
    //     // Kiểm tra xem đánh giá có tồn tại và thuộc về người dùng hiện tại hay không
    //     // $review = ProductReview::where('id', $id)
    //     //     ->where('user_id', Auth::id())
    //     //     ->firstOrFail();
    //     $review = ProductReview::findOrFail($id);


    //     $review->delete();

    //     return response()->json(['message' => 'Đánh giá đã được xóa thành công!'], 200);
    // }
}
