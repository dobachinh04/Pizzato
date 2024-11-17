@extends('admin.layouts.master')

@section('title')
    Thêm Mới Coupon - Pizzato
@endsection

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Thêm Mới Coupon</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{ route('admin.coupons.store') }}" method="POST">
                                        @csrf

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Mã Coupon</label>
                                                    <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                                                        value="{{ old('code') }}" placeholder="Nhập mã coupon">
                                                    @error('code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Giảm Giá (%)</label>
                                                    <input type="number" name="discount" class="form-control @error('discount') is-invalid @enderror"
                                                        value="{{ old('discount') }}" placeholder="Nhập giảm giá (theo %)">
                                                    @error('discount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Số Lần Sử Dụng</label>
                                                    <input type="number" name="usage_limit" class="form-control @error('usage_limit') is-invalid @enderror"
                                                        value="{{ old('usage_limit') }}" placeholder="Nhập số lần sử dụng">
                                                    @error('usage_limit')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Ngày Bắt Đầu</label>
                                                    <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror"
                                                        value="{{ old('start_date') }}">
                                                    @error('start_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Ngày Kết Thúc</label>
                                                    <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror"
                                                        value="{{ old('end_date') }}">
                                                    @error('end_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Trạng Thái</label>
                                                    <select name="status" class="form-control">
                                                        <option value="1">Còn mã</option>
                                                        <option value="0">Hết mã</option>
                                                    </select>
                                                    @error('status')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                            <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">Quay Lại</a>
                                        <button type="submit" class="btn btn-success">Thêm Mới </button>


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
