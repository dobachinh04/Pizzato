<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    const PATH_VIEW = 'admin.coupons.';

    public function index()
    {
        // $data = Coupon::query()->latest('id')->get();
        $data = Coupon::all();

        foreach ($data as $coupon) {
            // Kiểm tra nếu mã giảm giá đã hết hạn hoặc số lượng bằng 0
            if ($coupon->expire_date < Carbon::now() || $coupon->qty <= 0) {
                // Cập nhật trạng thái thành Inactive nếu chưa
                if ($coupon->status) {
                    $coupon->status = false; // Chuyển trạng thái Inactive
                    $coupon->save(); // Lưu thay đổi
                }
            }
        }
        return view("admin.coupons.index", compact('data'));
    }


    public function create()
    {


        $discountTypes = ['percent' => 'Percent', 'amount' => 'Amount'];

        return view("admin.coupons.create", compact( 'discountTypes'));
    }


    public function store(StoreCouponRequest $request)
    {
        $data = $request->all();
        // Tự động cập nhật trạng thái dựa vào qty
        // $data['status'] = $request->qty > 0 ? 1 : 0;

        // Ghép ngày và giờ để tạo giá trị expire_date hoàn chỉnh
        $data['expire_date'] = $request->expire_date . ' ' . $request->expire_time;

        if ($request->qty == 0) {
            $data['status'] = 0; // Không kích hoạt
        } else {
            $data['status'] = $request->status;
        }
        // dd($data);
        Coupon::query()->create($data);
        return back()
            ->with('success', 'Thêm mã giảm giá thành công!');
    }


    public function show(Coupon $coupon)
    {

        return view("admin.coupons.show", compact('coupon'));
    }


    public function edit(Coupon $coupon)
    {
        $discountTypes = ['percent' => 'Percent', 'amount' => 'Amount'];


        return view("admin.coupons.edit", compact('coupon', 'discountTypes'));
    }


    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
        $data = $request->all();

        // Tự động cập nhật trạng thái dựa vào qty
        // $data['status'] = $request->qty > 0 ? 1 : 0;

        // Ghép ngày và giờ thành datetime
        $data['expire_date'] = \Carbon\Carbon::createFromFormat(
            'Y-m-d H:i',
            $request->expire_date . ' ' . $request->expire_time
        );

        if ($request->qty == 0) {
            $data['status'] = 0; // Không kích hoạt
        } else {
            $data['status'] = $request->status;
        }


        // Kiểm tra nếu mã giảm giá đã thay đổi, nếu có thì cập nhật mã mới
        if ($request->has('code') && $request->code !== $coupon->code) {
            $data['code'] = $request->code; // Lấy mã mới từ request
        }

         // Xử lý max_discount_amount dựa trên discount_type
        if ($request->discount_type === 'percent') {
            $data['max_discount_amount'] = $request->max_discount_amount; // Lưu giá trị từ request
        } else {
            $data['max_discount_amount'] = null; // Đặt null nếu không phải "phần trăm"
        }
        $coupon->update($data);

        return back()
            ->with('success', 'Cập nhật mã giảm giá thành công');
    }


    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return back()
            ->with('success', 'Xoá mã giảm giá thành công!');
    }

    protected function generateUniqueCode()
    {
        do {
            $code = strtoupper(Str::random(10));
        } while (Coupon::where('code', $code)->exists());

        return $code;
    }
}
