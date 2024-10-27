<div class="container">
    <h2>Thanh Toán</h2>

    @if(Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif

    @if(Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf

        <div>
            <h4>Thông Tin Giao Hàng</h4>
            <p>Tên: <input type="text" name="name" value="{{ $user->name ?? '' }}" required></p>
            <p>Email: <input type="email" name="email" value="{{ $user->email ?? '' }}" required></p>
            <p>Số điện thoại: <input type="phone" name="sdt" required></p>
            <p>Địa chỉ: <input type="text" name="address" value="{{ $user->address ?? '' }}" required></p>
        </div>

        <div>
            <h4>Sản Phẩm trong Giỏ Hàng</h4>
            <table class="table table-bordered" border="1">
                <thead>
                    <tr>
                        <th>Tên Sản Phẩm</th>
                        <th>Giá</th>
                        <th>Số Lượng</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carts as $cart)
                    <tr>
                        <td>{{ $cart->product->name }}</td>
                        <td>{{ number_format($cart->product->price, 0) }} VND</td>
                        <td>{{ $cart->quantity }}</td>
                        <td>{{ number_format($cart->grand_total, 0) }} VNĐ</td>
                    </tr>
                    @endforeach
                    <tr>
                        <th colspan="3" class="text-right">Tổng tiền:</th>
                        <td>{{ number_format($carts->sum('grand_total'), 0, ',', '.') }} VND</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br>

        <input type="hidden" name="carts" value="{{ json_encode($carts) }}">
        <input type="hidden" name="grand_total" value="{{ $carts->sum('grand_total') }}">

        <div>
            <label for="payment_method">Phương Thức Thanh Toán:</label>
            <select name="payment_method" required>
                <option value="COD">Thanh Toán Khi Nhận Hàng</option>
                <<option value="online">Thanh Toán Trực Tuyến</option>
            </select>
        </div>

        <button type="submit">Thanh Toán</button>
    </form>
</div>