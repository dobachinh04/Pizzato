@extends('admin.layouts.master')

@section('content')
<div class="container">
    <h1 class="my-4">Tất cả thông báo</h1>

    @if(isset($pendingOrders) && count($pendingOrders) > 0)
        <ul class="list-group">
            @foreach($pendingOrders as $order)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">Đơn hàng #{{ $order->invoice_id }}</h5>
                        <p class="mb-1 text-muted">Đơn hàng này đã quá hạn thanh toán.</p>
                        <small class="text-muted"><i class="mdi mdi-clock-outline"></i> {{ $order->time_ago }}</small>
                    </div>
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary btn-sm">Xem chi tiết</a>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-muted">Không có thông báo.</p>
    @endif
</div>
@endsection
