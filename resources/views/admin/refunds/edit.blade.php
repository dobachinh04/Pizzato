@extends('admin.layouts.master')

@section('title')
    Cập Nhật Yêu Cầu Hoàn Tiền - Pizzato
@endsection

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h4>Chi Tiết Yêu Cầu Hoàn Tiền - Mã Hóa Đơn: {{ $refund->invoice_id }}</h4>
                            </div>

                            <div class="card-body">
                                <!-- Form chỉnh sửa yêu cầu hoàn tiền -->
                                <form action="{{ route('admin.refunds.update', $refund->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <!-- Thông tin cơ bản -->
                                    <div class="form-group mb-3">
                                        <label for="invoice_id" class="form-label">Mã Hóa Đơn</label>
                                        <input type="text" id="invoice_id" class="form-control"
                                            value="{{ $refund->invoice_id }}" disabled>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="customer_name" class="form-label">Tên Khách Hàng</label>
                                        <input type="text" id="customer_name" class="form-control"
                                            value="{{ $refund->name }}" disabled>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="refund_amount" class="form-label">Số Tiền Hoàn</label>
                                        <input type="text" id="refund_amount" class="form-control"
                                            value="{{ number_format($refund->refund_amount, 0, ',', '.') }}₫" disabled>
                                    </div>

                                    <!-- Trạng thái -->
                                    <div class="form-group mb-3">
                                        <label for="status" class="form-label">Trạng Thái</label>
                                        <select name="status" class="form-control">
                                            <option value="pending" {{ $refund->status == 'pending' ? 'selected' : '' }}>
                                                Đang chờ xử lý</option>
                                            <option value="approved" {{ $refund->status == 'approved' ? 'selected' : '' }}>
                                                Đã được phê duyệt</option>
                                            <option value="rejected" {{ $refund->status == 'rejected' ? 'selected' : '' }}>
                                                Bị từ chối</option>
                                        </select>
                                    </div>

                                    <!-- Ghi chú admin -->
                                    <div class="form-group mb-3">
                                        <label for="admin_note" class="form-label">Ghi Chú Admin</label>
                                        <textarea id="admin_note" name="admin_note" rows="4" class="form-control">{{ $refund->admin_note }}</textarea>
                                    </div>

                                    <div>
                                        <a href="{{ route('admin.refunds.index') }}" class="btn btn-secondary">Quay Lại</a>
                                        <button type="submit" class="btn btn-success">Lưu Thay Đổi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
