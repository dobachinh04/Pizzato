<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Refund Request</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Refund Request</h1>
        
        <!-- Form chỉnh sửa -->
        <form action="{{ route('admin.refunds.update', $refund->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Thông tin cơ bản -->
            <div class="mb-3">
                <label for="invoice_id" class="form-label">Invoice ID</label>
                <input type="text" id="invoice_id" class="form-control" value="{{ $refund->invoice_id }}" disabled>
            </div>
            <div class="mb-3">
                <label for="customer_name" class="form-label">Customer Name</label>
                <input type="text" id="customer_name" class="form-control" value="{{ $refund->name }}" disabled>
            </div>
            <div class="mb-3">
                <label for="refund_amount" class="form-label">Refund Amount</label>
                <input type="text" id="refund_amount" class="form-control" value="${{ number_format($refund->refund_amount, 2) }}" disabled>
            </div>

            <!-- Trạng thái -->
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-select">
                    <option value="Pending" {{ $refund->status == 'Pending' ? 'selected' : '' }}>Đang chờ xử lý</option>
                    <option value="Approved" {{ $refund->status == 'Approved' ? 'selected' : '' }}>Đã được phê duyệt</option>
                    <option value="Rejected" {{ $refund->status == 'Rejected' ? 'selected' : '' }}>Bị từ chối</option>
                </select>
            </div>

            <!-- Ghi chú admin -->
            <div class="mb-3">
                <label for="admin_note" class="form-label">Admin Note</label>
                <textarea id="admin_note" name="admin_note" rows="4" class="form-control">{{ $refund->admin_note }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Save Changes</button>
            <a href="{{ route('admin.refunds.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
