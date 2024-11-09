@extends('admin.layouts.master')

@section('title')
    Cập Nhật Sản Phẩm - Pizzato
@endsection

@section('content')
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
                                <h4 class="card-title">Cập Nhật Sản Phẩm</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tên sản phẩm</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ old('name', $product->name) }}">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Giá</label>
                                                <input type="text" name="price" class="form-control"
                                                    value="{{ old('price', $product->price) }}">
                                                @error('price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Giá ưu đãi</label>
                                                <input type="text" name="offer_price" class="form-control"
                                                    value="{{ old('offer_price', $product->offer_price) }}">
                                                @error('offer_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Số lượng</label>
                                                <input type="text" name="qty" class="form-control"
                                                    value="{{ old('qty', $product->qty) }}">
                                                @error('qty')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Hiện trên trang chủ</label>
                                                <select name="show_at_home" class="form-control">
                                                    <option value="1"
                                                        {{ $product->show_at_home == 1 ? 'selected' : '' }}>Có</option>
                                                    <option value="0"
                                                        {{ $product->show_at_home == 0 ? 'selected' : '' }}>Không</option>
                                                </select>
                                                @error('show_at_home')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Trạng thái</label>
                                                <select name="status" class="form-control">
                                                    <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>
                                                        Kích hoạt</option>
                                                    <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>
                                                        Không kích hoạt</option>
                                                </select>
                                                @error('status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Slug</label>
                                                <input type="text" name="slug" class="form-control"
                                                    value="{{ old('slug', isset($product) ? $product->slug : $slug) }}"
                                                    readonly>
                                            </div>

                                            <div class="mt-3">
                                                <label for="thumb_image" class="form-label">Hình ảnh</label>
                                                <input type="file" class="form-control" id="thumb_image"
                                                    name="thumb_image">
                                                @error('thumb_image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Sku</label>
                                                <input type="text" name="sku" class="form-control"
                                                    value="{{ old('sku', $product->sku) }}" readonly>
                                                @error('sku')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="category_id" class="form-label">Danh mục</label>
                                                <select class="form-select" id="category_id" name="category_id">
                                                    @foreach ($categories as $id => $name)
                                                        <option value="{{ $id }}"
                                                            {{ $product->category_id == $id ? 'selected' : '' }}>
                                                            {{ $name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Mô tả ngắn</label>
                                                <textarea name="short_description" class="form-control">{{ old('short_description', $product->short_description) }}</textarea>
                                                @error('short_description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Mô tả dài</label>
                                                <textarea name="long_description" class="form-control summernote">{{ old('long_description', $product->long_description) }}</textarea>
                                                @error('long_description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Quay lại</a>
                                    <button type="submit" class="btn btn-warning">Cập nhật</button>
                                </form>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const nameInput = document.querySelector('input[name="name"]');
                                    const slugInput = document.querySelector('input[name="slug"]');

                                    nameInput.addEventListener('input', function() {
                                        slugInput.value = nameInput.value
                                            .toLowerCase()
                                            .trim()
                                            .replace(/[\s]+/g, '-') // Thay thế khoảng trắng bằng dấu -
                                            .replace(/[^\w\-]+/g, '') // Xóa ký tự không phải chữ, số hoặc dấu -
                                            .replace(/\-\-+/g, '-') // Xóa dấu gạch nối kép
                                            .replace(/^-+/, '') // Xóa dấu gạch nối đầu
                                            .replace(/-+$/, ''); // Xóa dấu gạch nối cuối
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
