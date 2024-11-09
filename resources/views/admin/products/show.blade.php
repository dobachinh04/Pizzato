@extends('admin.layouts.master')

@section('title')
    Chi Tiết Sản Phẩm - Pizzato
@endsection

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h5 class="card-title mb-0">Chi Tiết Sản Phẩm: {{ $product->title }}</h5>

                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary me-1">Quay
                                        Lại</a>
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                        class="btn btn-warning me-1">Sửa</a>
                                    <a href="{{ route('admin.products.create') }}" class="btn btn-success">Thêm
                                        Mới</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <h4>Hình Ảnh Sản Phẩm</h4>
                                        @if ($product->thumb_image)
                                            <img src="{{ Storage::url($product->thumb_image) }}" class="img-fluid rounded"
                                                style="width: 100%; max-width: 250px;" alt="Image">
                                        @else
                                            <p class="text-muted">Không có hình ảnh</p>
                                        @endif
                                    </div>

                                    <div class="col-md-8">
                                        <h4>Thông Tin Chi Tiết</h4>
                                        @php
                                            $fieldNames = [
                                                'id' => 'ID',
                                                'name' => 'Tên sản phẩm',
                                                'thumb_image' => 'Hình ảnh',
                                                'category' => 'Danh mục',
                                                'price' => 'Giá',
                                                'offer_price' => 'Giá khuyến mãi',
                                                'qty' => 'Số lượng',
                                                'show_at_home' => 'Hiển thị',
                                                'status' => 'Trạng thái',
                                                'created_at' => 'Ngày tạo',
                                                'updated_at' => 'Ngày cập nhật',
                                                'view' => 'Lượt xem',
                                                'short_description' => 'Mô tả ngắn',
                                                'long_description' => 'Mô tả chi tiết',
                                            ];
                                        @endphp
                                        <table class="table table-bordered table-striped table-hover">
                                            <tbody>

                                                <tr>
                                                    <th>Trường</th>
                                                    <th>Giá trị</th>
                                                </tr>
                                                @foreach ($product->toArray() as $field => $value)
                                                    <tr>
                                                        <th>{{ $fieldNames[$field] ?? Str::ucfirst(str_replace('_', ' ', $field)) }}
                                                        </th>
                                                        <td>
                                                            @if (is_array($value))
                                                                {{ implode(', ', $value) }}
                                                            @elseif ($field == 'thumb_image')
                                                                <img src="{{ Storage::url($value) }}"
                                                                    alt="Hình ảnh sản phẩm" width="50px">
                                                            @elseif (Str::contains($field, 'show_at_home') || Str::contains($field, 'status'))
                                                                <span
                                                                    class="badge {{ $value ? 'bg-primary' : 'bg-danger' }}">
                                                                    {{ $value ? 'Có' : 'Không' }}
                                                                </span>
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
