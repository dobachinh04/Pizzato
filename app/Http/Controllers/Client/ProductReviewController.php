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
    public function createReview(StoreReviewRequest $request)
    {
        $request->validate([
            'review' => 'required|string',
        ], [
            'review.required' => 'Vui lòng nhập đánh giá',
        ]);

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

    public function getReviews($productId)
    {
        $reviews = ProductReview::query()
            ->where('product_id', $productId)
            ->with('user')
            ->get();

        return response()->json($reviews);
    }
}
