@extends('admin.layouts.master')

@section('title')
    Danh sách Đơn Hàng - Pizzato
@endsection

@section('content')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    @if (Session::has('success'))
        <div class="alert alert-success solid alert-dismissible fade show">
            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                        class="mdi mdi-close"></i></span>
            </button>
            <strong>Hoàn Tất!</strong> {{ Session::get('success') }}.
        </div>
    @endif

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h5 class="card-title mb-0">Danh Mục Đơn Hàng</h5>
                                <a href="{{ route('admin.orders.create') }}" class="btn btn-success ms-auto">Thêm Mới</a>
                            </div>

                            <div class="card-body">
                                <table id="example"
                                    class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 10px;">
                                                <div class="form-check">
                                                    <input class="form-check-input fs-15" type="checkbox" id="checkAll"
                                                        value="option">
                                                </div>
                                            </th>
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
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input fs-15" type="checkbox"
                                                            name="checkAll" value="option1">
                                                    </div>
                                                </th>
                                                <td>{{ $item + 1 }}</td>
                                                <td>{{ $order->invoice_id }}</td>
                                                <td>{{ $order->user_id }}</td>
                                                <td>{{ $order->address }}</td>
                                                <td>{{ $order->discount }}</td>
                                                <td>{{ $order->delivery_charge }}</td>
                                                <td>{{ $order->subtotal }}</td>
                                                <td>{{ $order->grand_total }}</td>
                                                <td>{{ $order->product_qty }}</td>
                                                <td>{{ $order->payment_method }}</td>
                                                <td>{{ $order->payment_status }}</td>
                                                <td>{{ $order->payment_approve_date }}</td>
                                                <td>{{ $order->transaction_id }}</td>
                                                <td>{{ $order->coupon_info }}</td>
                                                <td>{{ $order->currency_name }}</td>
                                                <td>{{ $order->order_status }}</td>
                                                <td>{{ $order->address_id }}</td>
                                                <td>
                                                    <a href="{{ route('admin.orders.show', $order) }}"
                                                        class="btn btn-primary">Chi Tiết</a>
                                                    <a href="{{ route('admin.orders.edit', $order) }}"
                                                        class="btn btn-warning">Sửa</a>

                                                    <form action="{{ route('admin.orders.destroy', $order) }}"
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
                    </div><!--end col-->
                </div><!--end row-->
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="/velzon/assets/js/pages/datatables.init.js"></script>
@endsection
