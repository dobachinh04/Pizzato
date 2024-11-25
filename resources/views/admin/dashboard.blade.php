@extends('admin.layouts.master')

@section('title')
    Bảng Điều Khiển Admin - Pizzato
@endsection

@section('content')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <div class="vertical-overlay"></div>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col">
                        <div class="h-100">
                            <div class="row mb-3 pb-1">
                                <div class="col-12">
                                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                        <div class="flex-grow-1">
                                            {{-- <h4 class="fs-16 mb-1">Xin chào, {{ Auth::user()->name }}</h4> --}}
                                            {{-- <p class="text-muted mb-0">Here's what's happening with your store today.
                                        </p> --}}
                                            <p class="text-muted mb-0">Đây là những gì đang xảy ra với cửa hàng của bạn ngày
                                                hôm nay.</p>

                                        </div>
                                        <div class="mt-3 mt-lg-0">
                                            <form action="javascript:void(0);">
                                                <div class="row g-3 mb-0 align-items-center">
                                                    <div class="col-sm-auto">
                                                        <div class="input-group">
                                                            <input type="text"
                                                                class="form-control border-0 dash-filter-picker shadow"
                                                                data-provider="flatpickr" data-range-date="true"
                                                                data-date-format="d M, Y"
                                                                data-deafult-date="01 Jan 2022 to 31 Jan 2022">
                                                            <div
                                                                class="input-group-text bg-primary border-primary text-white">
                                                                <i class="ri-calendar-2-line"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-auto">
                                                        <a href="{{ route('admin.products.create') }}"
                                                            class="button btn btn-soft-success"> <i
                                                                class="ri-add-circle-line align-middle me-1"></i> Thêm sản
                                                            phẩm</a>

                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-auto">
                                                        <button type="button"
                                                            class="btn btn-soft-info btn-icon waves-effect waves-light layout-rightside-btn"><i
                                                                class="ri-pulse-line"></i></button>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end col-->
                                                {{-- <div class="col-auto">
                                                <button type="button" class="btn btn-soft-success"><i
                                                        class="ri-add-circle-line align-middle me-1"></i> Add
                                                    Product</button>
                                            </div>
                                            <!--end col-->
                                            <div class="col-auto">
                                                <button type="button"
                                                    class="btn btn-soft-info btn-icon waves-effect waves-light layout-rightside-btn"><i
                                                        class="ri-pulse-line"></i></button>
                                            </div> --}}
                                                <!--end col-->

                                                <!--end row-->
                                            </form>
                                        </div>
                                    </div><!-- end card header -->
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->

                            <div class="row">
                                <div class="col-xl-3 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Sản
                                                        phẩm
                                                    </p>
                                                </div>

                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                            class="counter-value" data-target="{{ $productCount }}"></span>
                                                    </h4>
                                                    <a href="{{ route('admin.products.index') }}"
                                                        class="text-decoration-underline">View All Products</a>
                                                </div>
                                                <style>
                                                    .custom-yellow {
                                                        color: yellow;
                                                        /* hoặc mã màu cụ thể như #FFD700 */
                                                    }
                                                </style>

                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-success-subtle rounded fs-3">
                                                        <i class="fa-solid fa-pizza-slice custom-yellow"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->

                                <div class="col-xl-3 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Đơn
                                                        hàng
                                                    </p>
                                                </div>

                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                            class="counter-value" data-target="{{ $orderCount }}"></span>
                                                    </h4>
                                                    <a href="{{ route('admin.orders.index') }}"
                                                        class="text-decoration-underline">View All Orders</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-info-subtle rounded fs-3">
                                                        <i class="bx bx-shopping-bag text-info"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->

                                <div class="col-xl-3 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Lượt xem</p>
                                                </div>

                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                            class="counter-value" data-target="{{ $totalViews }}"></span>
                                                    </h4>
                                                    <a href="{{ route('admin.products.index') }}"
                                                        class="text-decoration-underline">See details</a>
                                                </div>

                                                <style>
                                                    .view-icon {
                                                        color: #d53939;
                                                        /* Màu đỏ */
                                                        font-size: 24px;
                                                        /* Kích thước icon */
                                                    }
                                                </style>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-warning-subtle rounded fs-3">
                                                        <i class="fa-solid fa-eye view-icon"></i>
                                                        <!-- Icon mắt (lượt xem) -->
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->

                                <div class="col-xl-3 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Doanh
                                                        Thu
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                            class="counter-value" data-target="{{ $revenue }}"></span>
                                                        VNĐ
                                                    </h4>
                                                    <a href="{{ route('admin.chart') }}"
                                                        class="text-decoration-underline">See Revenue Details</a>
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    {{-- <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                            class="counter-value" data-target="{{ $revenue }}"></span>
                                                        VNĐ
                                                    </h4>
                                                    <a href="" class="text-decoration-underline">See Revenue
                                                        Details</a>
                                                </div> --}}

                                                    <style>
                                                        .revenue-icon {
                                                            color: #28a745;
                                                            /* Màu xanh lá cây */
                                                            font-size: 24px;
                                                            /* Kích thước icon */
                                                        }
                                                    </style>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                                                            <i class="fa-solid fa-coins revenue-icon"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div><!-- end col -->
                                </div> <!-- end row-->

                                <div class="row">
                                    <div class="col-xl-8">
                                        <div class="card">
                                            <div class="card-header border-0 align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Revenue</h4>
                                                <div>
                                                    <button type="button" class="btn btn-soft-secondary btn-sm">
                                                        ALL
                                                    </button>
                                                    <button type="button" class="btn btn-soft-secondary btn-sm">
                                                        1M
                                                    </button>
                                                    <button type="button" class="btn btn-soft-secondary btn-sm">
                                                        6M
                                                    </button>
                                                    <button type="button" class="btn btn-soft-primary btn-sm">
                                                        1Y
                                                    </button>
                                                </div>
                                            </div><!-- end card header -->

                                            <div class="card-header p-0 border-0 bg-light-subtle">
                                                <div class="row g-0 text-center">
                                                    <div class="col-6 col-sm-3">
                                                        <div class="p-3 border border-dashed border-start-0">
                                                            <h5 class="mb-1"><span class="counter-value"
                                                                    data-target="7585">0</span>
                                                            </h5>
                                                            <p class="text-muted mb-0">Orders</p>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-6 col-sm-3">
                                                        <div class="p-3 border border-dashed border-start-0">
                                                            <h5 class="mb-1">$<span class="counter-value"
                                                                    data-target="22.89">0</span>k</h5>
                                                            <p class="text-muted mb-0">Earnings</p>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-6 col-sm-3">
                                                        <div class="p-3 border border-dashed border-start-0">
                                                            <h5 class="mb-1"><span class="counter-value"
                                                                    data-target="367">0</span>
                                                            </h5>
                                                            <p class="text-muted mb-0">Refunds</p>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-6 col-sm-3">
                                                        <div class="p-3 border border-dashed border-start-0 border-end-0">
                                                            <h5 class="mb-1 text-success"><span class="counter-value"
                                                                    data-target="18.92">0</span>%</h5>
                                                            <p class="text-muted mb-0">Conversation Ratio</p>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                            </div><!-- end card header -->

                                            <div class="card-body p-0 pb-2">
                                                <div class="w-100">
                                                    <div id="customer_impression_charts"
                                                        data-colors='["--vz-primary", "--vz-success", "--vz-danger"]'
                                                        class="apex-charts" dir="ltr"></div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div><!-- end col -->

                                    <div class="col-xl-4">
                                        <!-- card -->
                                        <div class="card card-height-100">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Sales by Locations</h4>
                                                <div class="flex-shrink-0">
                                                    <button type="button" class="btn btn-soft-primary btn-sm">
                                                        Export Report
                                                    </button>
                                                </div>
                                            </div><!-- end card header -->

                                            <!-- card body -->
                                            <div class="card-body">

                                                <div id="sales-by-locations"
                                                    data-colors='["--vz-light", "--vz-success", "--vz-primary"]'
                                                    style="height: 269px" dir="ltr"></div>

                                                <div class="px-2 py-2 mt-1">
                                                    <p class="mb-1">Canada <span class="float-end">75%</span></p>
                                                    <div class="progress mt-2" style="height: 6px;">
                                                        <div class="progress-bar progress-bar-striped bg-primary"
                                                            role="progressbar" style="width: 75%" aria-valuenow="75"
                                                            aria-valuemin="0" aria-valuemax="75"></div>
                                                    </div>

                                                    <p class="mt-3 mb-1">Greenland <span class="float-end">47%</span>
                                                    </p>
                                                    <div class="progress mt-2" style="height: 6px;">
                                                        <div class="progress-bar progress-bar-striped bg-primary"
                                                            role="progressbar" style="width: 47%" aria-valuenow="47"
                                                            aria-valuemin="0" aria-valuemax="47"></div>
                                                    </div>

                                                    <p class="mt-3 mb-1">Russia <span class="float-end">82%</span></p>
                                                    <div class="progress mt-2" style="height: 6px;">
                                                        <div class="progress-bar progress-bar-striped bg-primary"
                                                            role="progressbar" style="width: 82%" aria-valuenow="82"
                                                            aria-valuemin="0" aria-valuemax="82"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!-- end col -->
                                </div>

                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h3 class="card-title mb-0 flex-grow-1">Đơn hàng chưa thanh toán</h3>
                                            </div><!-- end card header -->
                                            <div class="card-body">
                                                <table id="order-datatable"
                                                    class="table table-hover table-centered align-middle table-nowrap mb-0">
                                                    <thead class="text-muted table-light">
                                                        <tr>
                                                            <th>Mã đơn hàng</th>
                                                            <th>Tổng tiền</th>
                                                            <th>Thanh Toán</th>
                                                            <th>Thời gian đặt hàng</th>
                                                            <th>Trạng thái</th>
                                                            <th>Hành động</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($orderOvers as $item)
                                                            <tr>
                                                                <td>{{ $item->invoice_id }}</td>
                                                                <td>{{ $item->grand_total }}</td>
                                                                <td><span
                                                                        class="badge bg-danger">{{ $item->payment_status }}</span>
                                                                </td>
                                                                <td data-order="{{ $item->created_at }}">
                                                                    {{ $item->time_ago }}
                                                                </td>
                                                                <td><span
                                                                        class="badge bg-danger">{{ $item->order_status }}</span>
                                                                </td>
                                                                <td>
                                                                    @if (Carbon\Carbon::parse($item->created_at)->diffInMinutes(now()) > 30)
                                                                        <button class="btn btn-warning btn-sm notify-btn"
                                                                            data-id="{{ $item->id }}"
                                                                            data-invoice="{{ $item->invoice_id }}">
                                                                            Thông báo
                                                                        </button>
                                                                    @else
                                                                        <span class="text-muted">Không cần thông báo</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>

                                                {{-- popup thông báo --}}
                                                <div class="modal fade" id="notifyModal" tabindex="-1"
                                                    aria-labelledby="notifyModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="notifyModalLabel">Thông báo
                                                                    đơn hàng</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form id="notifyForm" action="{{route('admin.notify.order')}}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" id="order_id" name="order_id">
                                                                    <input type="hidden" id="invoice_id"
                                                                        name="invoice_id">
                                                                    <div class="mb-3">
                                                                        <label for="message" class="form-label">Nội dung
                                                                            thông báo</label>
                                                                        <textarea class="form-control" id="message" name="message" rows="3" placeholder="Nhập nội dung thông báo"></textarea>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary">Gửi
                                                                        thông báo</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div> <!-- .card-->
                                    </div> <!-- end col -->
                                    <div class="col-xl-4">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h3 class="card-title mb-0 flex-grow-1">Sản Phẩm Sắp Hết Hàng</h3>
                                            </div><!-- end card header -->

                                            <div class="card-body">
                                                <table id="lowStockTable"
                                                    class="table table-hover table-centered align-middle table-nowrap mb-0">
                                                    <thead class="text-muted table-light">
                                                        <tr>
                                                            <th>Tên sản phẩm</th>
                                                            <th>Ảnh</th>
                                                            <th>Số lượng</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($lowStockProducts as $product)
                                                            <tr>
                                                                <td>
                                                                    <a href="{{ route('admin.products.show', $product->id) }}"
                                                                        class="badge bg-danger-subtle text-danger"
                                                                        style="font-size: 0.7rem; text-decoration: none;">
                                                                        {{ $product->name }}
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="flex-shrink-0 me-2">
                                                                            <a
                                                                                href="{{ route('admin.products.show', $product->id) }}">
                                                                                <img src="{{ asset($product->thumb_image) }}"
                                                                                    alt="{{ $product->name }}"
                                                                                    class="avatar-xs rounded-circle">
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">
                                                                    <a href="apps-ecommerce-order-details.html"
                                                                        class="fw-medium link-primary"
                                                                        style="font-size: 0.85rem;">{{ $product->qty }}</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div> <!-- .card-->
                                    </div> <!-- .col-->


                                </div> <!-- end row-->

                                <div class="row">


                                    <div class="col-xl-8">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Đơn Hàng Mới Nhất</h4>
                                                <div class="flex-shrink-0">
                                                    <button type="button" class="btn btn-soft-info btn-sm">
                                                        <i class="ri-file-list-3-line align-middle"><a
                                                                href="{{ route('admin.orders.index') }}"
                                                                class="text-decoration-underline">View All Orders</a></i>
                                                    </button>
                                                </div>
                                            </div> <!-- .card-->
                                        </div> <!-- .col-->

                                        <div class="card-body">
                                            <table id="order-datatable"
                                                class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                                <thead class="text-muted table-light">
                                                    <tr>
                                                        <th scope="col">Mã Hóa Đơn</th>
                                                        <th scope="col">Khách Hàng</th>
                                                        <th scope="col">Tổng Tiền</th>
                                                        <th scope="col">Thanh Toán</th>
                                                        <th scope="col">Trạng Thái</th>
                                                        <th scope="col">Ngày Đặt</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pendingOrders as $order)
                                                        <tr>
                                                            <td class="text-center">
                                                                <a href="apps-ecommerce-order-details.html"
                                                                    class="fw-medium link-primary">{{ $order->invoice_id }}</a>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="flex-shrink-0 me-2">
                                                                        <img src="/velzon/assets/images/users/image.png"
                                                                            alt=""
                                                                            class="avatar-xs rounded-circle" />
                                                                    </div>
                                                                    <div class="flex-grow-1">{{ $order->first_name }}
                                                                        {{ $order->last_name }}</div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="text-success">{{ number_format($order->grand_total) }}
                                                                    VND</span>
                                                            </td>
                                                            <td class="text-center">
                                                                <span
                                                                    class="badge bg-success-subtle text-success">{{ $order->payment_status }}</span>
                                                            </td>
                                                            <td>
                                                                <span class="badge bg-warning-subtle text-warning">
                                                                    @if ($order->order_status === 'pending')
                                                                        Đang chờ
                                                                    @else
                                                                        {{ $order->order_status }}
                                                                    @endif
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <a href="apps-ecommerce-order-details.html"
                                                                    class="fw-medium link-primary">{{ $order->created_at->format('d/m/Y') }}</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table><!-- end table -->
                                        </div>
                                    </div> <!-- .card-->
                                </div> <!-- .col-->
                            </div> <!-- end row-->

                        </div> <!-- end .h-100-->

                    </div> <!-- end col -->

                    <div class="col-auto layout-rightside-col">
                        <div class="overlay"></div>
                        <div class="layout-rightside">
                            <div class="card h-100 rounded-0">
                                <div class="card-body p-0">
                                    {{-- <div class="p-3">
                                        <h6 class="text-muted mb-0 text-uppercase fw-semibold">Recent Activity</h6>
                                    </div>
                                    <div data-simplebar style="max-height: 410px;" class="p-3 pt-0">
                                        <div class="acitivity-timeline acitivity-main">
                                            <div class="acitivity-item d-flex">
                                                <div class="flex-shrink-0 avatar-xs acitivity-avatar">
                                                    <div
                                                        class="avatar-title bg-success-subtle text-success rounded-circle">
                                                        <i class="ri-shopping-cart-2-line"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1 lh-base">Purchase by James Price</h6>
                                                    <p class="text-muted mb-1">Product noise evolve smartwatch </p>
                                                    <small class="mb-0 text-muted">02:14 PM Today</small>
                                                </div>
                                            </div>
                                            <div class="acitivity-item py-3 d-flex">
                                                <div class="flex-shrink-0 avatar-xs acitivity-avatar">
                                                    <div class="avatar-title bg-danger-subtle text-danger rounded-circle">
                                                        <i class="ri-stack-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1 lh-base">Added new <span class="fw-semibold">style
                                                            collection</span></h6>
                                                    <p class="text-muted mb-1">By Nesta Technologies</p>
                                                    <div class="d-inline-flex gap-2 border border-dashed p-2 mb-2">
                                                        <a href="apps-ecommerce-product-details.html"
                                                            class="bg-light rounded p-1">
                                                            <img src="/velzon/assets/images/products/img-8.png"
                                                                alt="" class="img-fluid d-block" />
                                                        </a>
                                                        <a href="apps-ecommerce-product-details.html"
                                                            class="bg-light rounded p-1">
                                                            <img src="/velzon/assets/images/products/img-2.png"
                                                                alt="" class="img-fluid d-block" />
                                                        </a>
                                                        <a href="apps-ecommerce-product-details.html"
                                                            class="bg-light rounded p-1">
                                                            <img src="/velzon/assets/images/products/img-10.png"
                                                                alt="" class="img-fluid d-block" />
                                                        </a>
                                                    </div>
                                                    <p class="mb-0 text-muted"><small>9:47 PM Yesterday</small></p>
                                                </div>
                                            </div>
                                            <div class="acitivity-item py-3 d-flex">
                                                <div class="flex-shrink-0">
                                                    <img src="/velzon/assets/images/users/avatar-2.jpg" alt=""
                                                        class="avatar-xs rounded-circle acitivity-avatar">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1 lh-base">Natasha Carey have liked the products</h6>
                                                    <p class="text-muted mb-1">Allow users to like products in your
                                                        WooCommerce store.</p>
                                                    <small class="mb-0 text-muted">25 Dec, 2021</small>
                                                </div>
                                            </div>
                                            <div class="acitivity-item py-3 d-flex">
                                                <div class="flex-shrink-0">
                                                    <div class="avatar-xs acitivity-avatar">
                                                        <div class="avatar-title rounded-circle bg-secondary">
                                                            <i class="mdi mdi-sale fs-14"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1 lh-base">Today offers by <a
                                                            href="apps-ecommerce-seller-details.html"
                                                            class="link-secondary">Digitech Galaxy</a></h6>
                                                    <p class="text-muted mb-2">Offer is valid on orders of Rs.500 Or above
                                                        for selected products only.</p>
                                                    <small class="mb-0 text-muted">12 Dec, 2021</small>
                                                </div>
                                            </div>
                                            <div class="acitivity-item py-3 d-flex">
                                                <div class="flex-shrink-0">
                                                    <div class="avatar-xs acitivity-avatar">
                                                        <div
                                                            class="avatar-title rounded-circle bg-danger-subtle text-danger">
                                                            <i class="ri-bookmark-fill"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1 lh-base">Favorite Product</h6>
                                                    <p class="text-muted mb-2">Esther James have Favorite product.</p>
                                                    <small class="mb-0 text-muted">25 Nov, 2021</small>
                                                </div>
                                            </div>
                                            <div class="acitivity-item py-3 d-flex">
                                                <div class="flex-shrink-0">
                                                    <div class="avatar-xs acitivity-avatar">
                                                        <div class="avatar-title rounded-circle bg-secondary">
                                                            <i class="mdi mdi-sale fs-14"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1 lh-base">Flash sale starting <span
                                                            class="text-primary">Tomorrow.</span></h6>
                                                    <p class="text-muted mb-0">Flash sale by <a href="javascript:void(0);"
                                                            class="link-secondary fw-medium">Zoetic Fashion</a></p>
                                                    <small class="mb-0 text-muted">22 Oct, 2021</small>
                                                </div>
                                            </div>
                                            <div class="acitivity-item py-3 d-flex">
                                                <div class="flex-shrink-0">
                                                    <div class="avatar-xs acitivity-avatar">
                                                        <div class="avatar-title rounded-circle bg-info-subtle text-info">
                                                            <i class="ri-line-chart-line"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1 lh-base">Monthly sales report</h6>
                                                    <p class="text-muted mb-2"><span class="text-danger">2 days
                                                            left</span> notification to submit the monthly sales report. <a
                                                            href="javascript:void(0);"
                                                            class="link-warning text-decoration-underline">Reports
                                                            Builder</a></p>
                                                    <small class="mb-0 text-muted">15 Oct</small>
                                                </div>
                                            </div>
                                            <div class="acitivity-item d-flex">
                                                <div class="flex-shrink-0">
                                                    <img src="/velzon/assets/images/users/avatar-3.jpg" alt=""
                                                        class="avatar-xs rounded-circle acitivity-avatar" />
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1 lh-base">Frank Hook Commented</h6>
                                                    <p class="text-muted mb-2 fst-italic">" A product that has reviews is
                                                        more likable to be sold than a product. "</p>
                                                    <small class="mb-0 text-muted">26 Aug, 2021</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                                    {{-- <div class="p-3 mt-2">
                                        <h6 class="text-muted mb-3 text-uppercase fw-semibold">Top 10 Categories
                                        </h6>

                                        <ol class="ps-3 text-muted">
                                            <li class="py-1">
                                                <a href="#" class="text-muted">Mobile & Accessories <span
                                                        class="float-end">(10,294)</span></a>
                                            </li>
                                            <li class="py-1">
                                                <a href="#" class="text-muted">Desktop <span
                                                        class="float-end">(6,256)</span></a>
                                            </li>
                                            <li class="py-1">
                                                <a href="#" class="text-muted">Electronics <span
                                                        class="float-end">(3,479)</span></a>
                                            </li>
                                            <li class="py-1">
                                                <a href="#" class="text-muted">Home & Furniture <span
                                                        class="float-end">(2,275)</span></a>
                                            </li>
                                            <li class="py-1">
                                                <a href="#" class="text-muted">Grocery <span
                                                        class="float-end">(1,950)</span></a>
                                            </li>
                                            <li class="py-1">
                                                <a href="#" class="text-muted">Fashion <span
                                                        class="float-end">(1,582)</span></a>
                                            </li>
                                            <li class="py-1">
                                                <a href="#" class="text-muted">Appliances <span
                                                        class="float-end">(1,037)</span></a>
                                            </li>
                                            <li class="py-1">
                                                <a href="#" class="text-muted">Beauty, Toys & More <span
                                                        class="float-end">(924)</span></a>
                                            </li>
                                            <li class="py-1">
                                                <a href="#" class="text-muted">Food & Drinks <span
                                                        class="float-end">(701)</span></a>
                                            </li>
                                            <li class="py-1">
                                                <a href="#" class="text-muted">Toys & Games <span
                                                        class="float-end">(239)</span></a>
                                            </li>
                                        </ol>
                                        <div class="mt-3 text-center">
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-underline">View
                                                all Categories</a>
                                        </div>
                                    </div> --}}
                                    <div class="p-3">
                                        <h6 class="text-muted mb-3 text-uppercase fw-semibold">Đánh giá sản phẩm</h6>
                                        <!-- Swiper -->
                                        <div class="swiper vertical-swiper" style="height: 250px;">
                                            <div class="swiper-wrapper">
                                                @foreach ($reviews as $review)
                                                    <div class="swiper-slide">
                                                        <div class="card border border-dashed shadow-none">
                                                            <div class="card-body">
                                                                <div class="d-flex">
                                                                    <div class="flex-shrink-0">
                                                                        <!-- Hiển thị ảnh người đánh giá -->
                                                                        @if ($review->user && $review->user->image)
                                                                            <img src="{{ asset('storage/' . $review->user->image) }}"
                                                                                alt="" class="avatar-sm rounded">
                                                                        @else
                                                                            <div class="avatar-title bg-light rounded">
                                                                                <span>{{ strtoupper(substr($review->user->name, 0, 1)) }}</span>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3">
                                                                        <div>
                                                                            <!-- Hiển thị nội dung đánh giá -->
                                                                            <p
                                                                                class="text-muted mb-1 fst-italic text-truncate-two-lines">
                                                                                "{{ $review->review }}"
                                                                            </p>
                                                                            <div class="fs-11 align-middle text-warning">
                                                                                <!-- Hiển thị sao đánh giá -->
                                                                                @for ($i = 1; $i <= 5; $i++)
                                                                                    <i
                                                                                        class="ri-star-fill {{ $i <= $review->rating ? '' : 'ri-star-line' }}"></i>
                                                                                @endfor
                                                                            </div>
                                                                        </div>
                                                                        <div class="text-end mb-0 text-muted">
                                                                            <!-- Hiển thị tên người đánh giá -->
                                                                            - by <cite
                                                                                title="Source Title">{{ $review->user->name ?? 'Anonymous' }}</cite>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="p-3">
                                        <h6 class="text-muted mb-3 text-uppercase fw-semibold">Đánh giá</h6>
                                        <div class="bg-light px-3 py-2 rounded-2 mb-2">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <div class="fs-16 align-middle text-warning">

                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <h6 class="mb-0">{{ number_format($averageRating, 1) }} out of 5
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <div class="text-muted">Tất cả <span
                                                    class="fw-medium">{{ number_format($totalReviews) }}</span>
                                                Đánh Giá</div>
                                        </div>

                                        <div class="mt-3">
                                            @foreach ([5, 4, 3, 2, 1] as $rating)
                                                <div class="row align-items-center g-2">
                                                    <div class="col-auto">
                                                        <div class="p-1">
                                                            <h6 class="mb-0">{{ $rating }} star</h6>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="p-1">
                                                            <div class="progress animated-progress progress-sm">
                                                                <div class="progress-bar
                                                                @if ($rating == 5) bg-success
                                                                @elseif($rating == 4) bg-primary
                                                                @elseif($rating == 3) bg-warning
                                                                @else bg-danger @endif"
                                                                    role="progressbar"
                                                                    style="width: {{ $ratingPercentages[$rating]['percentage'] }}%"
                                                                    aria-valuenow="{{ $ratingPercentages[$rating]['percentage'] }}"
                                                                    aria-valuemin="0" aria-valuemax="100">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="p-1">
                                                            <h6 class="mb-0 text-muted">
                                                                {{ number_format($ratingPercentages[$rating]['count']) }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end card-->
                        </div> <!-- end .rightbar-->

                    </div> <!-- end col -->
                </div>

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © Velzon.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Design & Develop by Themesbrand
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->
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
    <style>
        .dataTables_filter input {
            width: 50px;
        }
    </style>
    <script>
        $(document).ready(function() {

            $('#lowStockTable').DataTable({});
            // Thu ngắn ô tìm kiếm
            $('#lowStockTable_filter input').css('width', '50px');

            $('#example').DataTable({});
        });

        $(document).ready(function() {
            // Khởi tạo DataTable cho bảng đã đổi ID
            $('#order-datatable').DataTable();
        });

        // THông báo
        $(document).ready(function() {
            // Khi nhấn nút Thông báo (Event Delegation)
            $(document).on('click', '.notify-btn', function() {
                var orderId = $(this).data('id');
                var invoiceId = $(this).data('invoice');

                // Gán giá trị vào modal
                $('#order_id').val(orderId);
                $('#invoice_id').val(invoiceId);

                // Hiển thị modal
                $('#notifyModal').modal('show');
            });

            // Xử lý gửi thông báo
            // $('#notifyForm').on('submit', function(e) {
            //     e.preventDefault();

            //     var orderId = $('#order_id').val();
            //     var invoiceId = $('#invoice_id').val();
            //     var message = $('#message').val();
            //     var solution = $('#solution').val();

            //     $.ajax({
            //         url: '/notify-order',
            //         type: 'POST',
            //         data: {
            //             order_id: orderId,
            //             invoice_id: invoiceId,
            //             message: message,
            //             solution: solution,
            //             _token: '{{ csrf_token() }}'
            //         },
            //         success: function(response) {
            //             alert(response.message);
            //             $('#notifyModal').modal('hide');
            //         },
            //         error: function() {
            //             alert('Có lỗi xảy ra. Vui lòng thử lại!');
            //         }
            //     });
            // });

        });
    </script>
@endsection
