
    <div class="container">
        <h1 class="mt-4">Giỏ Hàng</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif


            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ảnh Sản Phẩm</th>
                        <th>Sản Phẩm</th>
                        <th>Giá</th>
                        <th>Số Lượng</th>
                        <th>Tổng</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carts as $cart)
                        <tr>
                            <td>{{ $cart->id }}</td>
                            <td>
                                <img src="{{ asset($cart->product->image) }}" alt="{{ $cart->product->name }}" style="width: 100px; height: auto;">
                            </td>
                            <td>{{ $cart->product->name }}</td>
                            <td>{{ number_format($cart->product->price, 0) }} VNĐ</td>
                            <td>
                                <form action="{{ route('carts.update', $cart->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $cart->quantity }}" min="1" required class="form-control" style="width: 80px; display: inline;">
                                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
                                </form>
                            </td>
                            <td>{{ number_format($cart->grand_total, 0) }} VNĐ</td>
                            <td>
                                <form action="{{ route('carts.destroy', $cart->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

    </div>

