<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    public function getListCoupon()
    {
        $coupons = Coupon::query()
            ->where('status', 1) // Chỉ lấy các mã đang kích hoạt
            ->where('expire_date', '>=', now()) // Chỉ lấy các mã chưa hết hạn
            ->get();

        return response()->json([
            'success' => true,
            'data' => $coupons
        ], 200);
    }


    public function getCouponDetail($code)
    {
        $coupon = Coupon::query()
            ->where('code', $code)
            ->where('status', 1) // Chỉ lấy mã đang hoạt động
            ->where('expire_date', '>=', now()) // Chỉ lấy mã chưa hết hạn
            ->first();

        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá không hợp lệ hoặc đã hết hạn'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $coupon
        ], 200);
    }
}
