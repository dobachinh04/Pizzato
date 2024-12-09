<!DOCTYPE html>
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
</html>
