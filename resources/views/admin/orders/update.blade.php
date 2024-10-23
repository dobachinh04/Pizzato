@extends('admin.layouts.master')

@section('title')
    Cập Nhật Đơn Hàng - Pizzato
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
                                <h4 class="card-title">Cập Nhật Đơn Hàng</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{ route('admin.orders.store') }}" method="POST">
                                        @csrf

                                        {{-- <select name="invoice_id" class="form-select">
                                            @foreach ($invoices as $invoice)
                                                <option value="{{ $invoice->id }}">{{ $invoice->id }} - {{ $invoice->user->name }}</option>
                                            @endforeach
                                        </select>

                                        <div class="mb-3">
                                            <label for="user_id" class="form-label">User ID</label>
                                            <input type="text" class="form-control" id="user_id" name="user_id"
                                                value="{{ $invoice->user->id }}">
                                        </div> --}}
                                        <div class="form-group">
                                            <label for="invoice_id" class="form-label">Invoice ID</label>
                                            <input type="text" class="form-control input-default" id="invoice_id" name="invoice_id"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <label for="user_id" class="form-label">User ID</label>
                                            <input type="text" class="form-control input-default" id="user_id" name="user_id"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="address" class="form-label">Địa chỉ</label>
                                            <textarea class="form-control input-default" id="address" name="address"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="discount" class="form-label">Giảm giá</label>
                                            <input type="number" step="0.01" class="form-control input-default" id="discount"
                                                name="discount" value="0.00">
                                        </div>

                                        <div class="form-group">
                                            <label for="delivery_charge" class="form-label">Phí giao hàng</label>
                                            <input type="number" step="0.01" class="form-control input-default" id="delivery_charge"
                                                name="delivery_charge" value="0.00">
                                        </div>

                                        <div class="form-group">
                                            <label for="subtotal" class="form-label">Tổng cộng</label>
                                            <input type="number" step="0.01" class="form-control input-default" id="subtotal"
                                                name="subtotal">
                                        </div>

                                        <div class="form-group">
                                            <label for="grand_total" class="form-label">Tổng tiền</label>
                                            <input type="number" step="0.01" class="form-control input-default" id="grand_total"
                                                name="grand_total">
                                        </div>

                                        <div class="form-group">
                                            <label for="product_qty" class="form-label">Số lượng sản phẩm</label>
                                            <input type="number" class="form-control input-default" id="product_qty" name="product_qty">
                                        </div>

                                        <div class="form-group">
                                            <label for="payment_method" class="form-label">Phương thức thanh toán</label>
                                            <select class="form-control input-default" id="payment_method" name="payment_method">
                                                <option value="credit_card">Thẻ tín dụng</option>
                                                <option value="paypal">Chuyển khoản</option>
                                                <option value="bank_transfer">Thanh toán sau khi nhận hàng</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="payment_status" class="form-label">Trạng thái thành toán</label>
                                            <select class="form-control input-default" id="payment_status" name="payment_status">
                                                <option value="pending">Đang chờ xử lý</option>
                                                <option value="completed">Thành công</option>
                                                <option value="failed">Không thành công</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="payment_approve_date" class="form-label">Ngày phê duyệt thanh
                                                toán</label>
                                            <input type="date" class="form-control input-default" id="payment_approve_date"
                                                name="payment_approve_date">
                                        </div>

                                        <div class="form-group">
                                            <label for="transaction_id" class="form-label">Transaction ID</label>
                                            <input type="text" class="form-control input-default" id="transaction_id"
                                                name="transaction_id">
                                        </div>

                                        <div class="form-group">
                                            <label for="coupon_info" class="form-label">Thông tin phiếu giảm giá</label>
                                            <input type="text" class="form-control input-default" id="coupon_info"
                                                name="coupon_info">
                                        </div>

                                        <div class="form-group">
                                            <label for="currency_name" class="form-label">Loại tiền tệ</label>
                                            <input type="text" class="form-control input-default" id="currency_name"
                                                name="currency_name">
                                        </div>

                                        <div class="form-group">
                                            <label for="order_status" class="form-label">Trạng thái đơn hàng</label>
                                            <select class="form-control input-default" id="order_status" name="order_status">
                                                <option value="pending">Chưa giải quyết</option>
                                                <option value="shipped">Đang vận chuyển</option>
                                                <option value="delivered">Đang giao hàng</option>
                                                <option value="canceled">Hủy đơn hàng</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="address_id" class="form-label">Address ID</label>
                                            <input type="text" class="form-control input-default" id="address_id"
                                                name="address_id">
                                        </div>

                                        <button type="submit" class="btn btn-primary">Submit</button>
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
