@extends('admin.layouts.master')

@section('title')
    Chi Tiết Đơn Hàng - Pizzato
@endsection

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h4>Chi Tiết Đơn Hàng - {{ $order->invoice_id }}</h4>
                            </div>

                            <div class="card-body">


                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>ID Hóa Đơn</th>
                                                <td>{{ $order->invoice_id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Khách Hàng</th>
                                                <td>{{ $order->users->name ?? 'Trống' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>{{ $order->users->email ?? 'Trống' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Số Điện Thoại</th>
                                                <td>{{ $order->addresses->phone ?? 'Trống' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Địa Chỉ</th>
                                                <td>{{ $order->addresses->address ?? 'Không xác định' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Khu Vực Giao Hàng</th>
                                                <td>{{ $order->addresses->delivery_area->area_name ?? 'Không xác định' }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Phí Vận Chuyển</th>
                                                <td>{{ number_format($order->delivery_charge, 0, ',', '.') }} VNĐ
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Giảm Giá</th>
                                                <td>{{ number_format($order->discount, 0, ',', '.') }} VNĐ</td>
                                            </tr>
                                            <tr>
                                                <th>Tổng Phụ</th>
                                                <td>{{ number_format($order->sub_total, 0, ',', '.') }} VNĐ</td>
                                            </tr>
                                            <tr>
                                                <th>Tổng Tiền</th>
                                                <td>{{ number_format($order->grand_total, 0, ',', '.') }} VNĐ</td>
                                            </tr>
                                            <tr>
                                                <th>Số Lượng Sản Phẩm</th>
                                                <td>{{ $order->product_qty }}</td>
                                            </tr>
                                            <tr>
                                                <th>Phương Thức Thanh Toán</th>
                                                <td>
                                                    @if ($order->payment_method)
                                                        @switch($order->payment_method)
                                                            @case('credit_card')
                                                                <span class="badge bg-primary">Thẻ Tín Dụng</span>
                                                            @break

                                                            @case('paypal')
                                                                <span class="badge bg-info">PayPal</span>
                                                            @break

                                                            @case('cash')
                                                                <span class="badge bg-success">Tiền Mặt</span>
                                                            @break

                                                            @default
                                                                <span class="badge bg-secondary">Phương Thức Khác</span>
                                                        @endswitch
                                                    @else
                                                        <span class="badge bg-danger">N/A</span>
                                                    @endif
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Trạng Thái Thanh Toán</th>
                                                <td>
                                                    @if ($order->payment_status === 'completed')
                                                        <span class="badge bg-success">Hoàn thành</span>
                                                    @elseif($order->payment_status === 'pending')
                                                        <span class="badge bg-warning">Đang chờ</span>
                                                    @elseif($order->payment_status === 'failed')
                                                        <span class="badge bg-danger">Thất bại</span>
                                                    @else
                                                        <span
                                                            class="badge bg-secondary">{{ $order->payment_status }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Ngày Thanh Toán</th>
                                                <td>{{ $order->payment_approve_date ? $order->payment_approve_date : 'Không Xác Định' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Thông Tin Coupon</th>
                                                <td>{{ $order->coupon_info ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Ngày Đặt Hàng</th>
                                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Trạng Thái Đơn Hàng</th>
                                                <td>
                                                    @if ($order->order_status == 'canceled')
                                                        <span class="badge bg-danger">Đã Bị Hủy</span>
                                                    @else
                                                        <form action="{{ route('admin.orders.update_status', $order) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <select name="order_status" class="form-select"
                                                                onchange="this.form.submit();"
                                                                {{ $order->order_status == 'completed' ? 'disabled' : '' }}>
                                                                <option value="pending"
                                                                    {{ $order->order_status == 'pending' ? 'selected' : '' }}>
                                                                    Chờ Xác Nhận
                                                                </option>
                                                                <option value="processing"
                                                                    {{ $order->order_status == 'processing' ? 'selected' : '' }}>
                                                                    Đang Giao
                                                                </option>
                                                                <option value="completed"
                                                                    {{ $order->order_status == 'completed' ? 'selected' : '' }}>
                                                                    Hoàn Thành
                                                                </option>
                                                                <option value="canceled"
                                                                    {{ $order->order_status == 'canceled' ? 'selected' : '' }}>
                                                                    Hủy Đơn
                                                                </option>
                                                            </select>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-start mt-3 ">
                                        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary me-2">
                                            <i class="fas fa-arrow-left"></i> Quay Lại
                                        </a>
                                        @if (!in_array($order->order_status, ['canceled', 'completed']))
                                            <form action="{{ route('admin.orders.cancel', $order) }}" method="POST"
                                                onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-times-circle"></i> Hủy Đơn
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection