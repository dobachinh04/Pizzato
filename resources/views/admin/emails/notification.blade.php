{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông báo đơn hàng</title>
</head>
<body>
    <h1>Thông báo về đơn hàng </h1>
    <p><strong>Số hóa đơn:</strong> {{ $emailData['invoice_id'] }}</p>
    <p><strong>Lý do:</strong> {{ $emailData['message'] }}</p>
    <p><strong>Cách giải quyết:</strong> {{ $emailData['solution'] }}</p>
    <a href="http://localhost:3000/profile/notification">Bấm vào để xem chi tiết</a>
</body>
</html> --}}


<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Thông báo đơn hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .container {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            max-width: 600px;
            margin: auto;
        }

        .header {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .order-info,
        .product-list,
        .total {
            margin-bottom: 20px;
        }

        .product-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .product-item img {
            max-width: 60px;
            max-height: 60px;
            margin-right: 10px;
        }

        .product-details {
            font-size: 14px;
        }

        .total-info {
            font-weight: bold;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div>
            <img src="https://media.istockphoto.com/id/1168754685/photo/pizza-margarita-with-cheese-top-view-isolated-on-white-background.jpg?s=612x612&w=0&k=20&c=psLRwd-hX9R-S_iYU-sihB4Jx2aUlUr26fkVrxGDfNg="
                alt="">
            {{-- <h1>Thông báo về đơn hàng </h1> --}}
            <p>Xin chào {{ $emailData['user_name'] }}, </p>
            <p>Đơn hàng <strong>{{ $emailData['invoice_id'] }} </strong> của bạn chưa được xử lý</p>
            <p><strong>Lý do:</strong> {{ $emailData['message'] }}</p>
            <p><strong>Cách giải quyết:</strong> {{ $emailData['solution'] }}</p>
        </div>


        <hr>

        <div class="header">Thông tin đơn hàng - Dành cho người mua</div>
        <div class="order-info">
            <p><strong>Mã đơn hàng:</strong> #{{ $emailData['invoice_id'] }}</p>
            {{-- <p><strong>Ngày đặt hàng:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</p> --}}
            <p><strong>Ngày đặt hàng:</strong>
                {{ \Carbon\Carbon::parse($emailData['created_at'])->format('d/m/Y H:i:s') }}</p>

        </div>
        <div class="product-list">
            <h4>Sản phẩm:</h4>
            @foreach ($emailData['order_items'] as $item)
                <div class="product-item">
                    <img src="{{ $item->thumb_image }}" alt="{{ $item->product_name }}">
                    <div class="product-details">
                        <p><strong>Tên sản phẩm:</strong> {{ $item->product_name }}</p>
                        <p><strong>Mã sản phẩm:</strong> {{ $item->sku }}</p>
                        <p><strong>Số lượng:</strong> {{ $item->qty }}</p>
                        <p><strong>Giá:</strong> {{ number_format($item->unit_price, 0, ',', '.') }}₫</p>
                        @if ($item->product_size)
                            <p><strong>Kích cỡ:</strong> {{ json_decode($item->product_size) }}</p>
                        @endif
                        @if ($item->product_option)
                            <p><strong>Tùy chọn:</strong> {{ json_decode($item->product_option) }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <hr>

        <div class="total">
            <p><strong>Tổng tiền:</strong> {{ number_format($emailData['sub_total'], 0, ',', '.') }}₫</p>
            <p><strong>Voucher của </strong><span class="badge bg-danger">Pizzato</span> :
                {{ number_format($emailData['discount'], 0, ',', '.') }}₫</p>
            <p><strong>Mã giảm giá:</strong>
                {{ $emailData['coupon_info'] ? $emailData['coupon_info'] : 'Không áp dụng' }}</p>
            <p><strong>Phí vận chuyển:</strong> {{ number_format($emailData['shipping_fee'], 0, ',', '.') }}₫</p>
            <p class="total-info"><strong>Tổng thanh toán:</strong>
                {{ number_format($emailData['grand_total'], 0, ',', '.') }}₫</p>
        </div>
        <p><a href="http://localhost:3000/profile/notification">Bấm vào để xem chi tiết</a></p>
    </div>
</body>

</html>
