@extends('admin.layouts.master')

@section('title')
    Thêm Mới Mã Giảm Giá - Pizzato
@endsection

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Thêm Mới Mã Giảm Giá</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{ route('admin.coupons.store') }}" method="POST">
                                        @csrf

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Tên mã giảm giá</label>
                                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                                        value="{{ old('name') }}" placeholder="Tên mã giảm giá">
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Mã giảm giá</label>
                                                    <div class="input-group">
                                                        <input type="text" id="coupon-code" name="code"
                                                               class="form-control @error('code') is-invalid @enderror"
                                                               value="{{ old('code') }}"
                                                               placeholder="Nhập mã giảm giá">
                                                        <button type="button" id="generate-code" class="btn btn-secondary">Ngẫu nhiên</button>
                                                    </div>
                                                    @error('code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Số lượng</label>
                                                    <input type="text" name="qty" class="form-control @error('qty') is-invalid @enderror"
                                                        value="{{ old('qty') }}" placeholder="Nhập số lượng mã giảm giá">
                                                    @error('qty')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Số tiền tối thiểu</label>
                                                    <input type="number" name="min_purchase_amount" class="form-control @error('min_purchase_amount') is-invalid @enderror"
                                                        value="{{ old('min_purchase_amount', 0) }}" placeholder="Nhập số tiền tối thiểu">
                                                    @error('min_purchase_amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Loại giảm giá</label>
                                                    <select name="discount_type" class="form-control @error('discount_type') is-invalid @enderror">
                                                        <option value="percent" {{ old('discount_type') == 'percent' ? 'selected' : '' }}>Giảm theo phần trăm</option>
                                                        <option value="amount" {{ old('discount_type') == 'amount' ? 'selected' : '' }}>Giảm theo số tiền</option>
                                                    </select>
                                                    @error('discount_type')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Giá trị giảm</label>
                                                    <input type="number" name="discount" class="form-control @error('discount') is-invalid @enderror"
                                                        value="{{ old('discount') }}" placeholder="Nhập giá trị giảm">
                                                    @error('discount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Ngày hết hạn</label>
                                                    <input type="date" name="expire_date" class="form-control @error('expire_date') is-invalid @enderror"
                                                        value="{{ old('expire_date') }}">
                                                    @error('expire_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Trạng thái</label>
                                                    <select name="status" class="form-control">
                                                        <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Kích hoạt</option>
                                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Không kích hoạt</option>
                                                    </select>
                                                    @error('status')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">Quay Lại</a>
                                        <button type="submit" class="btn btn-success">Thêm Mới</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const generateCodeButton = document.getElementById('generate-code');
        const couponCodeInput = document.getElementById('coupon-code');

        generateCodeButton.addEventListener('click', function () {
            // Random mã giảm giá (10 ký tự, chữ và số)
            const randomCode = Array.from({ length: 10 }, () => {
                const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                return chars[Math.floor(Math.random() * chars.length)];
            }).join('');

            // Gán mã vào ô input
            couponCodeInput.value = randomCode;
        });
    });
</script>

@endsection
