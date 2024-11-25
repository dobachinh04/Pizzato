@extends('admin.layouts.master')

@section('title')
    Cập Nhật Yêu Cầu Hoàn Tiền - Pizzato
@endsection

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Cập Nhật Yêu Cầu Hoàn Tiền</h1>

        <!-- Form chỉnh sửa yêu cầu hoàn tiền -->
        <form action="{{ route('admin.refunds.update', $refund->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Thông tin cơ bản -->
            <div class="form-group">
                <label for="invoice_id" class="form-label">Mã Hóa Đơn</label>
                <input type="text" id="invoice_id" class="form-control" value="{{ $refund->invoice_id }}" disabled>
            </div>
            <div class="form-group">
                <label for="customer_name" class="form-label">Tên Khách Hàng</label>
                <input type="text" id="customer_name" class="form-control" value="{{ $refund->name }}" disabled>
            </div>
            <div class="form-group">
                <label for="refund_amount" class="form-label">Số Tiền Hoàn</label>
                <input type="text" id="refund_amount" class="form-control" value="${{ number_format($refund->refund_amount, 2) }}" disabled>
            </div>

            <!-- Trạng thái -->
            <div class="form-group">
                <label for="status" class="form-label">Trạng Thái</label>
                <select  name="status" class="form-control">
                    <option value="Pending" {{ $refund->status == 'Pending' ? 'selected' : '' }}>Đang chờ xử lý</option>
                    <option value="Approved" {{ $refund->status == 'Approved' ? 'selected' : '' }}>Đã được phê duyệt</option>
                    <option value="Rejected" {{ $refund->status == 'Rejected' ? 'selected' : '' }}>Bị từ chối</option>
                </select>
            </div>

            <!-- Ghi chú admin -->
            <div class="form-group">
                <label for="admin_note" class="form-label">Ghi Chú Admin</label>
                <textarea id="admin_note" name="admin_note" rows="4" class="form-control">{{ $refund->admin_note }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Lưu Thay Đổi</button>
            <a href="{{ route('admin.refunds.index') }}" class="btn btn-secondary">Quay Lại</a>
        </form>
    </div>
@endsection
