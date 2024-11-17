@extends('admin.layouts.master')

@section('title')
    Cập Nhật Coupon - Pizzato
@endsection

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Cập Nhật Coupon</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tên Coupon</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ old('name', $coupon->name) }}">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Mã Coupon</label>
                                                <input type="text" name="code" class="form-control"
                                                    value="{{ old('code', $coupon->code) }}">
                                                @error('code')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Giá trị giảm giá (%)</label>
                                                <input type="text" name="discount_value" class="form-control"
                                                    value="{{ old('discount_value', $coupon->discount_value) }}">
                                                @error('discount_value')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Điều kiện áp dụng</label>
                                                <select name="condition" class="form-control">
                                                    <option value="1"
                                                        {{ $coupon->condition == 1 ? 'selected' : '' }}>Áp dụng cho tất cả sản phẩm</option>
                                                    <option value="2"
                                                        {{ $coupon->condition == 2 ? 'selected' : '' }}>Áp dụng cho sản phẩm cụ thể</option>
                                                </select>
                                                @error('condition')
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

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Slug</label>
                                                <input type="text" name="slug" class="form-control"
                                                    value="{{ old('slug', isset($coupon) ? $coupon->slug : $slug) }}"
                                                    readonly>
                                            </div>

                                            <div class="form-group">
                                                <label>Thời hạn (ngày)</label>
                                                <input type="text" name="expiry_date" class="form-control"
                                                    value="{{ old('expiry_date', $coupon->expiry_date) }}">
                                                @error('expiry_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Mô tả ngắn</label>
                                                <textarea name="short_description" class="form-control">{{ old('short_description', $coupon->short_description) }}</textarea>
                                                @error('short_description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Mô tả chi tiết</label>
                                                <textarea name="long_description" class="form-control summernote">{{ old('long_description', $coupon->long_description) }}</textarea>
                                                @error('long_description')
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
