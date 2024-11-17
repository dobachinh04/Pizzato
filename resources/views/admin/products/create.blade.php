@extends('admin.layouts.master')

@section('title')
    Thêm Mới Sản Phẩm - Pizzato
@endsection

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}

                <!-- row -->

                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Thêm Mới Sản Phẩm</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{ route('admin.products.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Tên sản phẩm</label>
                                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                                        value="{{ old('name') }}" placeholder="Tên sản phẩm">
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

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
                                                        value="{{ old('sku', $sku) }}" readonly>
                                                    @error('sku')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="category_id" class="form-label">Danh mục</label>
                                                    <select type="text" class="form-select" id="category_id"
                                                        name="category_id">
                                                        @foreach ($categories as $id => $name)
                                                            <option value="{{ $id }}">{{ $name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>View</label>
                                                    <input type="text" name="view" class="form-control"
                                                        value="{{ old('view') }}" disabled placeholder="0">
                                                    @error('view')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>


                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Giá</label>
                                                    <input type="text" name="price" class="form-control @error('price') is-invalid @enderror"
                                                        value="{{ old('price') }}" placeholder="Nhập giá">
                                                    @error('price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Giá khuyến mãi</label>
                                                    <input type="text" name="offer_price" class="form-control @error('offer_price') is-invalid @enderror"
                                                        value="{{ old('offer_price') }}" placeholder="Nhập giá khuyến mãi">
                                                    @error('offer_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Số lượng</label>
                                                    <input type="text" name="qty" class="form-control @error('qty') is-invalid @enderror"
                                                        value="{{ old('qty') }}" placeholder="Nhập số lượng">
                                                    @error('qty')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Show at Home</label>
                                                    <select name="show_at_home" class="form-control" id="">
                                                        <option value="1">Yes</option>
                                                        <option selected value="0">No</option>
                                                    </select>
                                                    @error('show_at_home')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Trạng thái</label>
                                                    <select name="status" class="form-control" id="">
                                                        <option value="1">Còn hàng</option>
                                                        <option value="0">Hết hàng</option>
                                                    </select>
                                                    @error('status')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Mô tả ngắn</label>
                                                    <textarea name="short_description" class="form-control" id="">{{ old('short_description') }}</textarea>
                                                    @error('short_description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Mô tả dài</label>
                                                    <textarea name="long_description" class="form-control summernote" id="">{{ old('long_description') }}</textarea>
                                                    @error('long_description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                                            Quay Lại</a>
                                        <button type="submit" class="btn btn-success">Thêm Mới</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                    .replace(/-+$/, ''); // Xóa dấu gạch nối
            });
        });
    </script>
@endsection

