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
                                                <input type="text" name="code" class="form-control"
                                                    value="{{ old('code', $coupon->code) }}">
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
                                                <label>Ngày hết hạn</label>
                                                <input type="date" name="expire_date" class="form-control"
                                                    value="{{ old('expire_date', $coupon->expire_date) }}">
                                                @error('expire_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Loại giảm giá</label>
                                                <select name="discount_type" class="form-control">
                                                    <option value="percent"
                                                        {{ old('discount_type', $coupon->discount_type) == 'percent' ? 'selected' : '' }}>
                                                        Phần trăm
                                                    </option>
                                                    <option value="amount"
                                                        {{ old('discount_type', $coupon->discount_type) == 'amount' ? 'selected' : '' }}>
                                                        Số tiền
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

                                            <div class="form-group">
                                                <label>Trạng thái</label>
                                                <select name="status" class="form-control">
                                                    <option value="1" {{ $coupon->status == 1 ? 'selected' : '' }}>Kích hoạt</option>
                                                    <option value="0" {{ $coupon->status == 0 ? 'selected' : '' }}>Không kích hoạt</option>
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
