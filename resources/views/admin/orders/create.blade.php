@extends('admin.layouts.master')

@section('title')
    Thêm Mới Orders
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

    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)"></a>Thêm Mới Orders</li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Thêm Mới Orders</a></li>
                    </ol>
                </div>
            </div>

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
                            <h4 class="card-title">Thêm Mới Orders</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ route('admin.orders.store') }}" method="POST">
                                    @csrf
                            
                                    <div class="mb-3">
                                        <label for="invoice_id" class="form-label">Invoice ID</label>
                                        <input type="text" class="form-control" id="invoice_id" name="invoice_id" required>
                                    </div>
                            
                                    <div class="mb-3">
                                        <label for="user_id" class="form-label">User ID</label>
                                       <input type="text" class="form-control" id="user_id" name="user_id" required>
                                    </div>
                            
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea class="form-control" id="address" name="address" required></textarea>
                                    </div>
                            
                                    <div class="mb-3">
                                        <label for="discount" class="form-label">Discount</label>
                                        <input type="number" step="0.01" class="form-control" id="discount" name="discount" value="0.00">
                                    </div>
                            
                                    <div class="mb-3">
                                        <label for="delivery_charge" class="form-label">Delivery Charge</label>
                                        <input type="number" step="0.01" class="form-control" id="delivery_charge" name="delivery_charge" value="0.00">
                                    </div>
                            
                                    <div class="mb-3">
                                        <label for="subtotal" class="form-label">Subtotal</label>
                                        <input type="number" step="0.01" class="form-control" id="subtotal" name="subtotal" required>
                                    </div>
                            
                                    <div class="mb-3">
                                        <label for="grand_total" class="form-label">Grand Total</label>
                                        <input type="number" step="0.01" class="form-control" id="grand_total" name="grand_total" required>
                                    </div>
                            
                                    <div class="mb-3">
                                        <label for="product_qty" class="form-label">Product Quantity</label>
                                        <input type="number" class="form-control" id="product_qty" name="product_qty" required>
                                    </div>
                            
                                    <div class="mb-3">
                                        <label for="payment_method" class="form-label">Payment Method</label>
                                        <select class="form-select" id="payment_method" name="payment_method" required>
                                            <option value="credit_card">Credit Card</option>
                                            <option value="paypal">PayPal</option>
                                            <option value="bank_transfer">Bank Transfer</option>
                                        </select>
                                    </div>
                            
                                    <div class="mb-3">
                                        <label for="payment_status" class="form-label">Payment Status</label>
                                        <select class="form-select" id="payment_status" name="payment_status" required>
                                            <option value="pending">Pending</option>
                                            <option value="completed">Completed</option>
                                            <option value="failed">Failed</option>
                                        </select>
                                    </div>
                            
                                    <div class="mb-3">
                                        <label for="payment_approve_date" class="form-label">Payment Approve Date</label>
                                        <input type="date" class="form-control" id="payment_approve_date" name="payment_approve_date">
                                    </div>
                            
                                    <div class="mb-3">
                                        <label for="transaction_id" class="form-label">Transaction ID</label>
                                        <input type="text" class="form-control" id="transaction_id" name="transaction_id">
                                    </div>
                            
                                    <div class="mb-3">
                                        <label for="coupon_info" class="form-label">Coupon Info</label>
                                        <input type="text" class="form-control" id="coupon_info" name="coupon_info">
                                    </div>
                            
                                    <div class="mb-3">
                                        <label for="currency_name" class="form-label">Currency Name</label>
                                        <input type="text" class="form-control" id="currency_name" name="currency_name" required>
                                    </div>
                            
                                    <div class="mb-3">
                                        <label for="order_status" class="form-label">Order Status</label>
                                        <select class="form-select" id="order_status" name="order_status" required>
                                            <option value="pending">Pending</option>
                                            <option value="shipped">Shipped</option>
                                            <option value="delivered">Delivered</option>
                                            <option value="canceled">Canceled</option>
                                        </select>
                                    </div>
                            
                                    <div class="mb-3">
                                        <label for="address_id" class="form-label">Address ID</label>
                                        <input type="text" class="form-control" id="address_id" name="address_id" required>
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
@endsection
