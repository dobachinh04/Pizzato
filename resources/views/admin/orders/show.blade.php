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
                                        @forelse ($order->items as $index => $item)
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
                                    @if ($order->items->isNotEmpty())
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
                                        @forelse ($order->items as $index => $item)
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
                                    @if ($order->items->isNotEmpty())
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
                                            <th>Tổng Phụ</th>
                                            <td>{{ number_format($order->sub_total, 0, ',', '.') }} VNĐ</td>
                                        </tr>
                                        <tr>
                                            <th>Giảm Giá</th>
                                            <td>{{ number_format($order->discount, 0, ',', '.') }} VNĐ</td>
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
                                                @if ($order->payment_status === 'completed')
                                                    <span class="badge bg-success">Hoàn thành</span>
                                                @elseif($order->payment_status === 'pending')
                                                    <span class="badge bg-warning">Đang chờ</span>
                                                @elseif($order->payment_status === 'failed')
                                                    <span class="badge bg-danger">Thất bại</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $order->payment_status }}</span>
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
                                            <td>{{ $order->coupon_info ?? 'Không Có' }}</td>
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
                                                        <select class="form-select order-status-select" name="order_status"
                                                            {{-- Disable select nếu trạng thái là "completed" hoặc "canceled" --}}
                                                            {{ in_array($order->order_status, ['completed', 'canceled']) ? 'disabled' : '' }}
                                                            onchange="this.className='form-select form-select-sm order-status-select ' + this.options[this.selectedIndex].className; this.form.submit();">

                                                            {{-- Hiển thị option "pending" nếu trạng thái không phải "processing" hoặc "completed" --}}
                                                            @if ($order->order_status != 'processing' && $order->order_status != 'completed')
                                                                <option value="pending" class="bg-warning text-dark"
                                                                    {{ $order->order_status == 'pending' ? 'selected' : '' }}>
                                                                    Chờ Xác Nhận
                                                                </option>
                                                            @endif

                                                            {{-- Hiển thị option "processing" nếu trạng thái không phải "completed" --}}
                                                            @if ($order->order_status != 'completed')
                                                                <option value="processing" class="bg-primary text-white"
                                                                    {{ $order->order_status == 'processing' ? 'selected' : '' }}>
                                                                    Đang Giao
                                                                </option>
                                                            @endif

                                                            {{-- Hiển thị option "completed" nếu trạng thái không phải "canceled" --}}
                                                            @if ($order->order_status != 'canceled')
                                                                <option value="completed" class="bg-success text-white"
                                                                    {{ $order->order_status == 'completed' ? 'selected' : '' }}>
                                                                    Hoàn Thành
                                                                </option>
                                                            @endif

                                                            {{-- Hiển thị option "canceled" --}}
                                                            {{-- <option value="canceled" class="bg-danger text-white"
                                                                {{ $order->order_status == 'canceled' ? 'selected' : '' }}>
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
