@extends('admin.layouts.master')

@section('title')
    Cập Nhật Mã Giảm Giá
@endsection

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}

                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Cập Nhật Mã Giảm Giá</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tên mã giảm giá</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ old('name', $coupon->name) }}">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Mã giảm giá</label>

                                                <div class="input-group">
                                                    <input type="text" id="coupon-code" name="code"
                                                        class="form-control @error('code') is-invalid @enderror"
                                                        value="{{ old('code', $coupon->code) }}"
                                                        placeholder="Nhập mã giảm giá">
                                                    <button type="button" id="generate-code" class="btn btn-secondary">Ngẫu
                                                        nhiên</button>
                                                </div>


                                                @error('code')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Số lượng</label>
                                                <input type="text" name="qty" class="form-control"
                                                    value="{{ old('qty', $coupon->qty) }}">
                                                @error('qty')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Số tiền mua tối thiểu</label>
                                                <input type="number" name="min_purchase_amount" class="form-control"
                                                    value="{{ old('min_purchase_amount', $coupon->min_purchase_amount) }}">
                                                @error('min_purchase_amount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Giờ hết hạn</label>
                                                <input type="time" name="expire_time" class="form-control"
                                                    value="{{ old('expire_time', \Carbon\Carbon::parse($coupon->expire_date)->format('H:i')) }}">
                                                @error('expire_time')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Ngày hết hạn</label>
                                                <input type="date" name="expire_date" class="form-control"
                                                    value="{{ old('expire_date', \Carbon\Carbon::parse($coupon->expire_date)->format('Y-m-d')) }}">
                                                @error('expire_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Loại giảm giá</label>
                                                <select name="discount_type" id="discount_type" class="form-control">
                                                    <option value="percent"
                                                        {{ old('discount_type', $coupon->discount_type) == 'percent' ? 'selected' : '' }}>
                                                        Phần trăm
                                                    </option>
                                                    <option value="amount"
                                                        {{ old('discount_type', $coupon->discount_type) == 'amount' ? 'selected' : '' }}>
                                                        Số tiền(VNĐ)
                                                    </option>
                                                </select>
                                                @error('discount_type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Mức giảm giá</label>
                                                <input type="number" step="0.01" name="discount" class="form-control"
                                                    value="{{ old('discount', $coupon->discount) }}">
                                                @error('discount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group" id="max_discount_amount_group"
                                                style="{{ old('discount_type', $coupon->discount_type) == 'percent' ? '' : 'display: none;' }}">
                                                <label>Số tiền giảm tối đa</label>
                                                <input type="number" name="max_discount_amount" class="form-control"
                                                    value="{{ old('max_discount_amount', $coupon->max_discount_amount) }}"
                                                    placeholder="Nhập số tiền giảm tối đa">
                                                @error('max_discount_amount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label>Trạng thái</label>
                                                <select name="status" class="form-control">
                                                    <option value="1" {{ $coupon->status == 1 ? 'selected' : '' }}>
                                                        Kích hoạt</option>
                                                    <option value="0" {{ $coupon->status == 0 ? 'selected' : '' }}>
                                                        Không kích hoạt</option>
                                                </select>
                                                @error('status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>

                                    <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">Quay lại</a>
                                    <button type="submit" class="btn btn-warning">Cập nhật</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // gen code
        document.addEventListener('DOMContentLoaded', function() {
            const generateCodeButton = document.getElementById('generate-code');
            const couponCodeInput = document.getElementById('coupon-code');

            // Lưu giá trị mã gốc để so sánh
            const originalCode = couponCodeInput.value;

            generateCodeButton.addEventListener('click', function() {
                // Random mã giảm giá (10 ký tự, chữ và số)
                const randomCode = Array.from({
                    length: 10
                }, () => {
                    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                    return chars[Math.floor(Math.random() * chars.length)];
                }).join('');

                // Gán mã vào ô input
                couponCodeInput.value = randomCode;
            });

            // Thêm vào form để gửi mã giảm giá khi có sự thay đổi
            const form = document.querySelector('form');

            form.addEventListener('submit', function() {
                // Kiểm tra xem mã có thay đổi không, nếu có thì sẽ gửi mã mới
                if (couponCodeInput.value !== originalCode) {
                    // Gửi mã mới
                    couponCodeInput.name = 'code'; // Đảm bảo trường code được gửi
                } else {
                    // Giữ nguyên mã cũ
                    couponCodeInput.name = 'code'; // Đảm bảo trường code được gửi
                }
            });
        });

        // ẩn/hiện trường giá trị giảm tối đa
        document.addEventListener('DOMContentLoaded', function() {
            const discountType = document.getElementById('discount_type');
            const maxDiscountAmountGroup = document.getElementById('max_discount_amount_group');

            // Hàm kiểm tra và thay đổi trạng thái hiển thị
            function toggleMaxDiscountAmount() {
                if (discountType.value === 'percent') {
                    maxDiscountAmountGroup.style.display = 'block';
                } else {
                    maxDiscountAmountGroup.style.display = 'none';
                }
            }

            // Gọi hàm khi trang được tải
            toggleMaxDiscountAmount();

            // Lắng nghe sự kiện thay đổi giá trị
            discountType.addEventListener('change', toggleMaxDiscountAmount);
        });
    </script>
@endsection
