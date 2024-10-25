@extends('admin.layouts.master')

@section('title')
    Thêm Mới Đơn Hàng - Pizzato
@endsection

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success solid alert-dismissible fade show">
            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                        class="mdi mdi-close"></i></span>
            </button>
            <strong>Success!</strong> {{ Session::get('success') }}.
        </div>
    @endif
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
                                <h4 class="card-title">Thêm Mới Đơn Hàng</h4>
                            </div>
                            <form action="{{ route('admin.orders.create') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="basic-form">
                                        <div class="row">
                                            <div class="col-6">
                                                <h3>Thông Tin Đơn Hàng</h3>
                                                <div class="form-group mb-3">
                                                    <label>Khách Hàng</label>
                                                    <input type="text" name="user_id" class="form-control"
                                                        value="{{ old('user_id') }}">
                                                    @error('user_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label>Địa Chỉ</label>
                                                    <input type="text" name="address" class="form-control"
                                                        value="{{ old('address') }}">
                                                    @error('address')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label>Tổng Tiền</label>
                                                    <input type="text" name="grand_total" class="form-control"
                                                        value="{{ old('grand_total') }}">
                                                    @error('grand_total')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label>Mã Giảm Giá</label>
                                                    <input type="text" name="coupon_info" class="form-control"
                                                        value="{{ old('coupon_info') }}">
                                                    @error('coupon_info')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label>Số Tiền Được Giảm Giá</label>
                                                    <input type="text" name="discount" class="form-control"
                                                        value="{{ old('discount') }}">
                                                    @error('discount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label>Phương Thức Vận Chuyển</label>
                                                    <input type="text" name="delivery_charge" class="form-control"
                                                        value="{{ old('delivery_charge') }}">
                                                    @error('delivery_charge')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <h3>Thông Tin Thanh Toán</h3>
                                                <div class="form-group mb-3">
                                                    <label>Phương Thức Thanh Toán</label>
                                                    <input type="text" name="payment_method" class="form-control"
                                                        value="{{ old('payment_method') }}">
                                                    @error('payment_method')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label>Đơn Vị Tiền Tệ</label>
                                                    <input type="text" name="currency_name" class="form-control"
                                                        value="{{ old('currency_name') }}">
                                                    @error('currency_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label>Trạng Thái Thanh Toán</label>
                                                    <input type="text" name="payment_status" class="form-control"
                                                        value="{{ old('payment_status') }}">
                                                    @error('payment_status')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label>Trạng Thái Đơn Hàng</label>
                                                    <input type="text" name="order_status" class="form-control"
                                                        value="{{ old('order_status') }}">
                                                    @error('order_status')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label>Đặt Ngày</label>
                                                    <input type="text" name="created_at" class="form-control"
                                                        value="{{ old('created_at') }}">
                                                    @error('created_at')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label>Ngày Thanh Toán</label>
                                                    <input type="text" name="payment_approve_date" class="form-control"
                                                        value="{{ old('payment_approve_date') }}">
                                                    @error('payment_approve_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="basic-form">
                                        <div class="row">
                                            <h3>Thông Tin Sản Phẩm</h3>
                                        </div>

                                        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                                            Quay Lại</a>
                                        <button type="submit" class="btn btn-success">Thêm Mới</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
