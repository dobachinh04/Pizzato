@extends('admin.layouts.master')

@section('title')
    Yêu Cầu Hoàn Tiền - Pizzato
@endsection

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Yêu Cầu Hoàn Tiền</h1>

        <!-- Bảng hiển thị danh sách yêu cầu -->
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Mã Hóa Đơn</th>
                    <th>Tên Khách Hàng</th>
                    <th>Email</th>
                    <th>Số Tiền</th>
                    <th>Trạng Thái</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <!-- Duyệt qua danh sách yêu cầu hoàn tiền -->
                @foreach ($refunds as $refund)
                    <tr>
                        <td>{{ $refund->id }}</td>
                        <td>{{ $refund->invoice_id }}</td>
                        <td>{{ $refund->name }}</td>
                        <td>{{ $refund->email }}</td>
                        <td>${{ number_format($refund->refund_amount, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $refund->status == 'Pending' ? 'warning' : ($refund->status == 'Approved' ? 'success' : 'danger') }}">
                                {{ $refund->status }}
                            </span>
                        </td>
                        <td>
                            <!-- Nút Chỉnh Sửa -->
                            <a href="{{ route('admin.refunds.edit', $refund->id) }}" class="btn btn-primary btn-sm">Chỉnh Sửa</a>

                            <!-- Nút Xóa -->
                            <form action="{{ route('admin.refunds.destroy', $refund->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa yêu cầu hoàn tiền này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Phân Trang -->
        <div class="d-flex justify-content-center">
            {{ $refunds->links() }}
        </div>
    </div>
@endsection
