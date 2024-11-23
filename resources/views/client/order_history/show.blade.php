
<div class="container mt-4">
    <h1 class="text-center mb-4">Chi tiết đơn hàng</h1>

    <div class="card mb-4">
        <div class="card-header">
            Thông tin đơn hàng
        </div>
        <div class="card-body">
            <p><strong>Mã hóa đơn:</strong> {{ $order->invoice_id }}</p>
            <p><strong>Tổng cộng:</strong> {{ number_format($order->grand_total, 0, ',', '.') }} VND</p>
            <p><strong>Trạng thái:</strong> {{ $order->order_status }}</p>
            <p><strong>Ngày tạo:</strong> {{ $order->payment_approve_date }}</p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'Không xác định' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 0, ',', '.') }} VND</td>
                    <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }} VND</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ route('client.order_history.index') }}" class="btn btn-primary">Quay lại lịch sử đơn hàng</a>

