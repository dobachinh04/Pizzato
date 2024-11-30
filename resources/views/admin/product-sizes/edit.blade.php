@extends('admin.layouts.master')

@section('title')
    Cập Nhật Kích thước bánh - Pizzato
@endsection

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success solid alert-dismissible fade show">
            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                        class="mdi mdi-close"></i></span>
            </button>
            <strong>Success!</strong> {{ Session::get('success') }}.
        </div>
    @endif
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Cập Nhật Kích Thước Sản Phẩm</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{ route('admin.product-sizes.update', $productSize->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- Tên Kích Thước -->
                                        <div class="form-group">
                                            <label>Tên Kích Thước</label>
                                            <input type="text" name="name"
                                                class="form-control input-default @error('name') is-invalid @enderror"
                                                placeholder="Tên Kích Thước (VD: Small, Medium, Large)"
                                                value="{{ old('name', $productSize->name) }}">
                                            @error('name')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                            <br>
                                        </div>

                                        <!-- Giá -->
                                        <div class="form-group">
                                            <label>Giá</label>
                                            <input type="number" name="price"
                                                class="form-control input-default @error('price') is-invalid @enderror"
                                                placeholder="Nhập Giá (VD: 50000)"
                                                value="{{ old('price', $productSize->price)  }}">

                                            @error('price')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                            <br>
                                        </div>

                                        <!-- Hình Ảnh -->
                                        <div class="form-group">
                                            <label>Hình Ảnh</label>
                                            <input type="file" name="image" class="form-control input-default" id="image">

                                            @php
                                                // Xử lý đường dẫn ảnh
                                                $imageUrl = $productSize->image;
                                                if (!\Str::contains($imageUrl, 'http')) {
                                                    $imageUrl = \Storage::url($imageUrl);
                                                }
                                            @endphp

                                            <!-- Hiển thị hình ảnh -->
                                            @if (!empty($imageUrl))
                                                <img src="{{ $imageUrl }}" width="100px" height="100px" alt="image">
                                            @endif

                                            @error('image')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Nút Hành Động -->
                                        <a href="{{ route('admin.product-sizes.index') }}" class="btn btn-secondary">
                                            Quay Lại
                                        </a>
                                        <button type="submit" class="btn btn-success">Sửa</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
