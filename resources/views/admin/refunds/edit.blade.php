@extends('admin.layouts.master')

@section('title')
    Cập Nhật Yêu Cầu Hoàn Tiền - Pizzato
@endsection

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h4>Chi Tiết Đơn Hàng - {{ $refund->invoice_id }}</h4>
                            </div>

                            <div class="card-body">
                                <h5>Danh Sách Sản Phẩm</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Hình Ảnh</th>
                                            <th>Tên Sản Phẩm</th>
                                            <th>Giá Tiền</th>
                                            <th>Số Lượng</th>
                                            <th>Sỉzes Bánh</th>
                                            <th>Viền Bánh</th>
                                            <th>Đế Bánh</th>
                                            <th>Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalQty = 0;
                                            $totalPrice = 0;
                                        @endphp
                                        @forelse ($refund->items as $index => $item)
                                            @php
                                                $totalQty += $item->qty;
                                                $totalPrice += $item->unit_price * $item->qty;

                                                // Xử lý URL hình ảnh
                                                $url = $item->product->thumb_image ?? null;
                                                if ($url) {
                                                    if (!\Str::contains($url, 'http')) {
                                                        $url = \Storage::url($url);
                                                    }
                                                } else {
                                                    $url = asset('default-image.jpg'); // Hình ảnh mặc định nếu không có
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <img src="{{ $url }}"
                                                        alt="{{ $item->product->name ?? 'Sản phẩm' }}" width="75px">
                                                </td>
                                                <td>{{ $item->product->name ?? 'Không Có' }}</td>
                                                <td>{{ number_format($item->unit_price, 0, ',', '.') }} VNĐ</td>
                                                <td>{{ $item->qty }}</td>
                                                <td>Chưa có</td>
                                                <td>Chưa có</td>
                                                <td>Chưa có</td>
                                                <td>{{ number_format($item->unit_price * $item->qty, 0, ',', '.') }} VNĐ
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Không có sản phẩm nào trong đơn hàng.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    @if ($refund->items->isNotEmpty())
                                        <tfoot>
                                            <tr>
                                                <th colspan="8" class="text-end">Tổng Tiền Tạm Tính:</th>
                                                <th>{{ number_format($totalPrice, 0, ',', '.') }} VNĐ</th>
                                            </tr>
                                        </tfoot>
                                    @endif
                                </table>

                                {{-- <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Hình Ảnh</th>
                                            <th>Tên Sản Phẩm</th>
                                            <th>Giá Tiền</th>
                                            <th>Số Lượng</th>
                                            <th>Sizes Bánh</th>
                                            <th>Viền Bánh</th>
                                            <th>Đế Bánh</th>
                                            <th>Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalQty = 0;
                                            $totalPrice = 0;
                                        @endphp
                                        @forelse ($refund->items as $index => $item)
                                            @php
                                                $totalQty += $item->qty;
                                                $totalPrice += $item->unit_price * $item->qty;

                                                // Xử lý thông tin sản phẩm
                                                $product = $item->product ?? (object)[
                                                    'name' => $item->productArchive->name ?? 'Không Có',
                                                    'thumb_image' => $item->productArchive->thumb_image ?? null,
                                                ];

                                                // Xử lý URL hình ảnh
                                                $url = $product->thumb_image;
                                                if ($url) {
                                                    if (!\Str::contains($url, 'http')) {
                                                        $url = \Storage::url($url);
                                                    }
                                                } else {
                                                    $url = asset('default-image.jpg'); // Hình ảnh mặc định nếu không có
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <img src="{{ $url }}" alt="{{ $product->name }}" width="75px">
                                                </td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ number_format($item->unit_price, 0, ',', '.') }} VNĐ</td>
                                                <td>{{ $item->qty }}</td>
                                                <td>Chưa có</td>
                                                <td>Chưa có</td>
                                                <td>Chưa có</td>
                                                <td>{{ number_format($item->unit_price * $item->qty, 0, ',', '.') }} VNĐ</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center">Không có sản phẩm nào trong đơn hàng.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    @if ($refund->items->isNotEmpty())
                                        <tfoot>
                                            <tr>
                                                <th colspan="8" class="text-end">Tổng Tiền Tạm Tính:</th>
                                                <th>{{ number_format($totalPrice, 0, ',', '.') }} VNĐ</th>
                                            </tr>
                                        </tfoot>
                                    @endif
                                </table> --}}

                            </div>


                            <div class="card-body">
                                <h5>Thông Tin Đơn Hàng</h5>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>ID Hóa Đơn</th>
                                            <td>{{ $refund->invoice_id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Khách Hàng</th>
                                            <td>{{ $refund->users->name ?? 'Trống' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $refund->users->email ?? 'Trống' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Số Điện Thoại</th>
                                            <td>{{ $refund->addresses->phone ?? 'Trống' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Địa Chỉ</th>
                                            <td>{{ $refund->addresses->address ?? 'Không xác định' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Khu Vực Giao Hàng</th>
                                            <td>{{ $refund->addresses->delivery_area->area_name ?? 'Không xác định' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Phí Vận Chuyển</th>
                                            <td>{{ number_format($refund->delivery_charge, 0, ',', '.') }} VNĐ
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Tổng Phụ</th>
                                            <td>{{ number_format($refund->sub_total, 0, ',', '.') }} VNĐ</td>
                                        </tr>
                                        <tr>
                                            <th>Giảm Giá</th>
                                            <td>{{ number_format($refund->discount, 0, ',', '.') }} VNĐ</td>
                                        </tr>
                                        <tr>
                                            <th>Tổng Tiền</th>
                                            <td>{{ number_format($refund->grand_total, 0, ',', '.') }} VNĐ</td>
                                        </tr>
                                        <tr>
                                            <th>Số Lượng Sản Phẩm</th>
                                            <td>{{ $refund->product_qty }}</td>
                                        </tr>
                                        <tr>
                                            <th>Phương Thức Thanh Toán</th>
                                            <td>
                                                @if ($refund->payment_method)
                                                    @switch($refund->payment_method)
                                                        @case('credit_card')
                                                            <span class="badge bg-primary">Thẻ Tín Dụng</span>
                                                        @break

                                                        @case('paypal')
                                                            <span class="badge bg-info">PayPal</span>
                                                        @break

                                                        @case('cash')
                                                            <span class="badge bg-success">Tiền Mặt</span>
                                                        @break

                                                        @case('COD')
                                                            <span class="badge bg-success">Tiền Mặt</span>
                                                        @break

                                                        @case('vnpay')
                                                            <span class="badge bg-success">VN Pay</span>
                                                        @break

                                                        @default
                                                            <span class="badge bg-secondary">Phương Thức Khác</span>
                                                    @endswitch
                                                @else
                                                    <span class="badge bg-danger">Không Có</span>
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Trạng Thái Thanh Toán</th>
                                            <td>
                                                @if ($refund->payment_status === 'completed')
                                                    <span class="badge bg-success">Hoàn thành</span>
                                                @elseif($refund->payment_status === 'pending')
                                                    <span class="badge bg-warning">Đang chờ</span>
                                                @elseif($refund->payment_status === 'failed')
                                                    <span class="badge bg-danger">Thất bại</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $refund->payment_status }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Ngày Thanh Toán</th>
                                            <td>{{ $refund->payment_approve_date ? $refund->payment_approve_date : 'Không Xác Định' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Thông Tin Coupon</th>
                                            <td>{{ $refund->coupon_info ?? 'Không Có' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Ngày Đặt Hàng</th>
                                            <td>{{ $refund->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Trạng Thái Đơn Hàng</th>
                                            <td>
                                                @if ($refund->order_status == 'canceled')
                                                    <span class="badge bg-danger">Đã Bị Hủy</span>
                                                @else
                                                    <form action="{{ route('admin.orders.update_status', $refund) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <select class="form-select order-status-select" name="order_status"
                                                            {{-- Disable select nếu trạng thái là "completed" hoặc "canceled" --}}
                                                            {{ in_array($refund->order_status, ['completed', 'canceled']) ? 'disabled' : '' }}
                                                            onchange="this.className='form-select form-select-sm order-status-select ' + this.options[this.selectedIndex].className; this.form.submit();">

                                                            {{-- Hiển thị option "pending" nếu trạng thái không phải "processing" hoặc "completed" --}}
                                                            @if ($refund->order_status != 'processing' && $refund->order_status != 'completed')
                                                                <option value="pending" class="bg-warning text-dark"
                                                                    {{ $refund->order_status == 'pending' ? 'selected' : '' }}>
                                                                    Chờ Xác Nhận
                                                                </option>
                                                            @endif

                                                            {{-- Hiển thị option "processing" nếu trạng thái không phải "completed" --}}
                                                            @if ($refund->order_status != 'completed')
                                                                <option value="processing" class="bg-primary text-white"
                                                                    {{ $refund->order_status == 'processing' ? 'selected' : '' }}>
                                                                    Đang Giao
                                                                </option>
                                                            @endif

                                                            {{-- Hiển thị option "completed" nếu trạng thái không phải "canceled" --}}
                                                            @if ($refund->order_status != 'canceled')
                                                                <option value="completed" class="bg-success text-white"
                                                                    {{ $refund->order_status == 'completed' ? 'selected' : '' }}>
                                                                    Hoàn Thành
                                                                </option>
                                                            @endif

                                                            {{-- Hiển thị option "canceled" --}}
                                                            {{-- <option value="canceled" class="bg-danger text-white"
                                                                {{ $refund->order_status == 'canceled' ? 'selected' : '' }}>
                                                                Hủy Đơn
                                                            </option> --}}
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
                                    @if (!in_array($refund->order_status, ['canceled', 'completed']))
                                        <form action="{{ route('admin.orders.cancel', $refund) }}" method="POST"
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
@endsection

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h4>Chi Tiết Yêu Cầu Hoàn Tiền - Mã Hóa Đơn: {{ $refund->invoice_id }}</h4>
                            </div>

                            <div class="card-body">
                                <!-- Form chỉnh sửa yêu cầu hoàn tiền -->
                                <form action="{{ route('admin.refunds.update', $refund->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <!-- Thông tin cơ bản -->
                                    <div class="form-group mb-3">
                                        <label for="invoice_id" class="form-label">Mã Hóa Đơn</label>
                                        <input type="text" id="invoice_id" class="form-control"
                                            value="{{ $refund->invoice_id }}" disabled>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="customer_name" class="form-label">Tên Khách Hàng</label>
                                        <input type="text" id="customer_name" class="form-control"
                                            value="{{ $refund->name }}" disabled>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="refund_amount" class="form-label">Số Tiền Hoàn</label>
                                        <input type="text" id="refund_amount" class="form-control"
                                            value="{{ number_format($refund->refund_amount, 0, ',', '.') }}₫" disabled>
                                    </div>

                                    <!-- Trạng thái -->
                                    <div class="form-group mb-3">
                                        <label for="status" class="form-label">Trạng Thái</label>
                                        <select name="status" class="form-control">
                                            <option value="pending" {{ $refund->status == 'pending' ? 'selected' : '' }}>
                                                Đang chờ xử lý</option>
                                            <option value="approved" {{ $refund->status == 'approved' ? 'selected' : '' }}>
                                                Đã được phê duyệt</option>
                                            <option value="rejected" {{ $refund->status == 'rejected' ? 'selected' : '' }}>
                                                Bị từ chối</option>
                                        </select>
                                    </div>

                                    <!-- Ghi chú admin -->
                                    <div class="form-group mb-3">
                                        <label for="admin_note" class="form-label">Ghi Chú Admin</label>
                                        <textarea id="admin_note" name="admin_note" rows="4" class="form-control">{{ $refund->admin_note }}</textarea>
                                    </div>

                                    <div>
                                        <a href="{{ route('admin.refunds.index') }}" class="btn btn-secondary">Quay Lại</a>
                                        <button type="submit" class="btn btn-success">Lưu Thay Đổi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
