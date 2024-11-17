<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Models\Coupon;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    const PATH_VIEW = 'admin.coupons.';

    public function index()
    {
        $data = Coupon::query()->latest('id')->get();

        return view("admin.coupons.index", compact('data'));
    }


    public function create()
    {
        $code = $this->generateUniqueCode();
        $discountTypes = ['percent' => 'Percent', 'amount' => 'Amount'];

        return view("admin.coupons.create", compact('code', 'discountTypes'));
    }


    public function store(StoreCouponRequest $request)
    {
        $data = $request->all();

        // Tự động cập nhật trạng thái dựa vào qty
        $data['status'] = $request->qty > 0 ? 1 : 0;

        // Tạo mã code unique cho mỗi coupon
        $data['code'] = $this->generateUniqueCode();

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
        $data['status'] = $request->qty > 0 ? 1 : 0;

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
            $code = 'COUPON-' . strtoupper(Str::random(8));
        }
        while (Coupon::where('code', $code)->exists());

        return $code;
    }
}
