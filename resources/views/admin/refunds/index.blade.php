@extends('admin.layouts.master')

@section('title')
    Refund Requests - Pizzato
@endsection

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Refund Requests</h1>

        <!-- Bảng hiển thị danh sách yêu cầu -->
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Invoice ID</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Duyệt qua danh sách refund_requests -->
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
                            <!-- Edit Button -->
                            <a href="{{ route('admin.refunds.edit', $refund->id) }}" class="btn btn-primary btn-sm">Edit</a>

                            <!-- Delete Button -->
                            <form action="{{ route('admin.refunds.destroy', $refund->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this refund request?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $refunds->links() }}
        </div>
    </div>
@endsection
