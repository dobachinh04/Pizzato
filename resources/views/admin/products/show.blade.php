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
                                        @if ($product->image)
                                            <img src="{{ Storage::url($product->image) }}" class="img-fluid rounded"
                                                style="width: 100%; max-width: 250px;" alt="Image">
                                        @else
                                            <p class="text-muted">Không có hình ảnh</p>
                                        @endif
                                    </div>

                                    <div class="col-md-8">
                                        <h4>Thông Tin Chi Tiết</h4>
                                        <table class="table table-bordered table-striped table-hover">
                                            <tbody>
                                                <tr>
                                                    <th>ID</th>
                                                    <td>{{ $product->id }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tiêu Đề</th>
                                                    <td>{{ $product->title }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Danh Mục</th>
                                                    <td>{{ $product->category->name ?? 'Không có danh mục' }}</td>
                                                </tr>
                                                @foreach ($product->toArray() as $field => $value)
                                                    <tr>
                                                        <th>{{ Str::ucfirst(str_replace('_', ' ', $field)) }}</th>
                                                        <td>
                                                            @if (is_array($value))
                                                                {{ implode(', ', $value) }}
                                                            @elseif ($field == 'thumb_image')
                                                                <img src="{{ Storage::url($value) }}" alt=""
                                                                    width="50px">
                                                            @elseif (Str::contains($field, 'show_at_home') || Str::contains($field, 'status'))
                                                                <span
                                                                    class="badge {{ $value ? 'bg-primary' : 'bg-danger' }}">
                                                                    {{ $value ? 'YES' : 'NO' }}
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
