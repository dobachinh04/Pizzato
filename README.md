Changelog

1. ProductController (Admin)
   Tạo mã SKU ngẫu nhiên không trùng lặp
   Tự động tạo slug từ tên sản phẩm

1. ProductController (Client)
   test hiển thị list sản phẩm theo show_at_home và status,
   Xử lý trường 'view': mặc định là 0 và Trường này tự động tăng khi người dùng click vào sản phẩm.

1. User
   url test show list: http://pizzato.test/

VN pay

Thông tin cấu hình:
Terminal ID / Mã Website (vnp_TmnCode): PE0TTJQA

Secret Key / Chuỗi bí mật tạo checksum (vnp_HashSecret): F3AS7O1Z9ICD3RCULK6UKI21VMPX2WDK

Url thanh toán môi trường TEST (vnp_Url): https://sandbox.vnpayment.vn/paymentv2/vpcpay.html

Thông tin truy cập Merchant Admin để quản lý giao dịch:
Địa chỉ: https://sandbox.vnpayment.vn/merchantv2/

Tên đăng nhập: onii...


Kiểm tra (test case) – IPN URL:
Kịch bản test (SIT): https://sandbox.vnpayment.vn/vnpaygw-sit-testing/user/login

Tên đăng nhập: oniiisan2k4@gmail.com

Mật khẩu: (Là mật khẩu nhập tại giao diện đăng ký Merchant môi trường TEST)

Tài liệu:
Tài liệu hướng dẫn tích hợp: https://sandbox.vnpayment.vn/apis/docs/thanh-toan-pay/pay.html

Code demo tích hợp: https://sandbox.vnpayment.vn/apis/vnpay-demo/code-demo-tích-hợp

Thẻ test:
Ngân hàng	NCB
Số thẻ	9704198526191432198
Tên chủ thẻ	NGUYEN VAN A
Ngày phát hành	07/15
Mật khẩu OTP	123456
