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
            // ->where('qty', '>', 0)
            ->get();

        // Tách ngày và giờ cho mỗi coupon
        foreach ($coupons as $coupon) {
            $coupon->expire_date_date = \Carbon\Carbon::parse($coupon->expire_date)->format('d/m/Y'); // Tách ngày
            $coupon->expire_date_time = \Carbon\Carbon::parse($coupon->expire_date)->format('H:i'); // Tách giờ
        }

        // Kiểm tra số lượng và cập nhật trạng thái nếu hết số lượng
        // Cập nhật trạng thái nếu cần
        // foreach ($coupons as $coupon) {
        //     if ($coupon->qty <= 0) {
        //         $coupon->update(['status' => 0]);
        //     }
        // }

        // Tách ngày và giờ cho mỗi coupon

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

        // Kiểm tra số lượng và cập nhật trạng thái nếu hết số lượng
        // if ($coupon && $coupon->qty <= 0) {
        //     $coupon->update(['status' => 0]);
        //     $coupon = null; // Không trả về mã đã hết số lượng
        // }

        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá không hợp lệ hoặc đã hết hạn'
            ], 404);
        }
        $coupon->expire_date_date = \Carbon\Carbon::parse($coupon->expire_date)->format('d/m/Y'); // Tách ngày
        $coupon->expire_date_time = \Carbon\Carbon::parse($coupon->expire_date)->format('H:i'); // Tách giờ
        return response()->json([
            'success' => true,
            'data' => $coupon
        ], 200);
    }
}
