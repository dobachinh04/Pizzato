@extends('admin.layouts.master')

@section('title')
    Danh sách Orders
@endsection

@section('content')
    <!-- Datatable -->
    <link href="/focus-2/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="/focus-2/css/style.css" rel="stylesheet">

    <body>
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4> Danh sách Orders</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)"> Danh sách Orders</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)"></a></li>
                        </ol>
                    </div>
                </div>

                @if (Session::has('success'))
                    <div class="alert alert-success solid alert-dismissible fade show">
                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                                    class="mdi mdi-close"></i></span>
                        </button>
                        <strong>Hoàn Tất!</strong> {{ Session::get('success') }}.
                    </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"></h4>
                                <a href="{{ route('admin.orders.create') }}" class="btn btn-success">Thêm Mới</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Invoice ID</th>
                                                <th>User ID</th>
                                                <th>Address</th>
                                                <th>Discount</th>
                                                <th>Delivery Charge</th>
                                                <th>Subtotal</th>
                                                <th>Grand Total</th>
                                                <th>Product Quantity</th>
                                                <th>Payment Method</th>
                                                <th>Payment Status</th>
                                                <th>Payment Approve Date</th>
                                                <th>Transaction ID</th>
                                                <th>Coupon Info</th>
                                                <th>Currency Name</th>
                                                <th>Order Status</th>
                                                <th>Address ID</th>
                                                <th>Hành Động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $item => $order)
                                            <tr>
                                                <td>{{$item+1}}</td>
                                                <td>{{$order->invoice_id}}</td>
                                                <td>{{$order->user_id }}</td>
                                                <td>{{$order->address}}</td>
                                                <td>{{$order->discount}}</td>
                                                <td>{{$order->delivery_charge}}</td>
                                                <td>{{$order->subtotal}}</td>
                                                <td>{{$order->grand_total}}</td>
                                                <td>{{$order->product_qty}}</td>
                                                <td>{{$order->payment_method}}</td>
                                                <td>{{$order->payment_status}}</td>
                                                <td>{{$order->payment_approve_date}}</td>
                                                <td>{{$order->transaction_id}}</td>
                                                <td>{{$order->coupon_info}}</td>
                                                <td>{{$order->currency_name}}</td>
                                                <td>{{$order->order_status}}</td>
                                                <td>{{$order->address_id}}</td>
                                                <td>
                                                    <a href="{{ route('admin.orders.show',  $order) }}"
                                                    class="btn btn-primary">Chi Tiết</a>
                                                <a href="{{ route('admin.orders.edit',  $order) }}"
                                                    class="btn btn-warning">Sửa</a>

                                                <form
                                                    action="{{ route('admin.orders.destroy', $order) }}"
                                                    method="POST" style="display: inline;"
                                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                                </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Required vendors -->
        <script src="/focus-2/vendor/global/global.min.js"></script>
        <script src="/focus-2/js/quixnav-init.js"></script>
        <script src="/focus-2/js/custom.min.js"></script>

        <!-- Datatable -->
        <script src="/focus-2/vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="/focus-2/js/plugins-init/datatables.init.js"></script>
    </body>
@endsection
