@extends('admin.layouts.master')

@section('title')
    Chi Tiết Mã Giảm Giá - Pizzato
@endsection
@section('style')
<style>

    .mr-10{
        margin-right: 10px;
    }
</style>
@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h5 class="card-title mb-0 mr-10">Chi Tiết Mã Giảm Giá: {{ $coupon->name }}</h5>

                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary me-1">Quay
                                        Lại</a>
                                    <a href="{{ route('admin.coupons.edit', $coupon) }}"
                                        class="btn btn-warning me-1">Sửa</a>
                                    <a href="{{ route('admin.coupons.create') }}" class="btn btn-success">Thêm
                                        Mới</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h4>Thông Tin Chi Tiết</h4>
                                        @php
                                            $fieldNames = [
                                                'id' => 'ID',
                                                'name' => 'Tên mã giảm giá',
                                                'code' => 'Mã giảm giá',
                                                'qty' => 'Số lượng',
                                                'min_purchase_amount' => 'Số tiền tối thiểu',
                                                'discount_type' => 'Loại giảm giá',
                                                'discount' => 'Giá trị giảm',
                                                'expire_date' => 'Ngày hết hạn',

                                                'status' => 'Trạng thái',
                                                'created_at' => 'Ngày tạo',
                                                'updated_at' => 'Ngày cập nhật',
                                            ];
                                        @endphp
                                        <table class="table table-bordered table-striped table-hover">
                                            <tbody>
                                                <tr>
                                                    <th>Trường</th>
                                                    <th>Giá trị</th>
                                                </tr>
                                                @foreach ($coupon->toArray() as $field => $value)
                                                    <tr>
                                                        <th>{{ $fieldNames[$field] ?? Str::ucfirst(str_replace('_', ' ', $field)) }}
                                                        </th>
                                                        <td>
                                                            @if ($field == 'discount_type')
                                                                {{ $value == 'percent' ? 'Phần trăm' : 'Số tiền' }}
                                                            @elseif ($field == 'discount')
                                                                {{ $coupon->discount_type == 'percent' ? $value . '%' : number_format($value) . ' VND' }}
                                                            @elseif ($field == 'status')
                                                                <span
                                                                    class="badge {{ $value ? 'bg-primary' : 'bg-danger' }}">
                                                                    {{ $value ? 'Kích hoạt' : 'Không kích hoạt' }}
                                                                </span>
                                                            @elseif (is_numeric($value) && $field == 'min_purchase_amount')
                                                                {{ number_format($value) }} VND
                                                                @elseif ($field == 'created_at' || $field == 'updated_at')
                                                                {{ \Carbon\Carbon::parse($value)->format('d/m/Y') }}
                                                            @elseif ($field == 'expire_date')
                                                                @php
                                                                    // Tách ngày và giờ
                                                                    $expireDate = \Carbon\Carbon::parse($value);
                                                                    $expireTimeFormatted = $expireDate->format('H:i');
                                                                    $expireDateFormatted = $expireDate->format('d/m/Y');
                                                                @endphp
                                                                <strong>{{ $expireTimeFormatted }}</strong><br>
                                                                <span>{{ $expireDateFormatted }} </span>
                                                            @else
                                                                {{ $value }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
