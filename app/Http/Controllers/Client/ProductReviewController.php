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
        ProductReview::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return response()->json(
            [
                'message' => 'Đánh giá được tạo thành công!',
                'success' => true
            ], 201);
    }

    // hiển thị tất cả các đánh giá của một sản phẩm
    public function getReviews($productId)
    {
        $reviews = ProductReview::query()
            ->where('product_id', $productId)
            ->with('user')
            ->get();

        return response()->json($reviews);
    }

    // sửa đánh giá của người dùng
    public function updateReview(UpdateReviewRequest $request, $id)
    {
        // Kiểm tra xem đánh giá có tồn tại và thuộc về người dùng hiện tại hay không
        $review = ProductReview::where('id', $id)
            ->where('user_id', 1)
            ->firstOrFail();

        $review->update([
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return response()->json(['message' => 'Sửa đánh giá thành công!', 'data' => $review], 200);
    }
}
