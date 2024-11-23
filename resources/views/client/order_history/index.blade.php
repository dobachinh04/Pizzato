<div class="container mt-4">
    <h1 class="text-center mb-4">Lịch sử đơn hàng của bạn</h1>

    @if($orders->isEmpty())
        <div class="alert alert-warning text-center">
            Bạn chưa có đơn hàng nào.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID Người dùng</th>
                        {{-- <th>Tên Người dùng</th> --}}
                        <th>Mã hóa đơn</th>
                        <th>Tổng phụ</th>
                        <th>Tổng cộng</th>
                        <th>Trạng thái</th>
                        <th>Địa chỉ</th>
                        <th>Ngày tạo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->user_id }}</td>
                        <td>
                            @if($order->user)
                                {{ $order->user->name }}
                            @else
                                Không xác định
                            @endif
                        </td>
                        <td>{{ $order->invoice_id }}</td>
                        <td>{{ number_format($order->subtotal, 0, ',', '.') }} VND</td>
                        <td>{{ number_format($order->grand_total, 0, ',', '.') }} VND</td>
                        <td>
                            <span class="badge {{ $order->order_status == 'Completed' ? 'badge-success' : 'badge-warning' }}">
                                {{ $order->order_status }}
                            </span>
                        </td>
                        <td>
                            @if($order->addresses)
                                {{ $order->addresses->address }}
                            @else
                                <span class="text-muted">Không có địa chỉ</span>
                            @endif
                        </td>
                        <td>{{ $order->payment_approve_date }}</td>
                        <td>
                            <a href="{{ route('client.order_history.show', $order->id) }}" class="btn btn-info btn-sm">
                                Xem chi tiết
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
