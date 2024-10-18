@extends('admin.layouts.master')

@section('title')
    Thêm Mới Sản Phẩm - Pizzato
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
                                <h4 class="card-title">Thêm Mới Sản Phẩm</h4>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4>Update Product</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name', $product->name) }}">
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
                                            <label for="thumb_image" class="form-label">Image</label>
                                            <input type="file" class="form-control" id="thumb_image" name="thumb_image">
                                            @error('thumb_image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- <div class="form-group">
                                            <label>Sku</label>
                                            <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku) }}">
                                            @error('sku')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div> --}}


                                        <div class="form-group">
                                            <label>Sku</label>
                                            <input type="text" name="sku" class="form-control"
                                                value="{{ old('sku', $product->sku) }}" readonly>
                                            @error('sku')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="category_id" class="form-label">Category</label>
                                            <select class="form-select" id="category_id" name="category_id">
                                                @foreach ($categories as $id => $name)
                                                    <option value="{{ $id }}"
                                                        {{ $product->category_id == $id ? 'selected' : '' }}>
                                                        {{ $name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- <div class="form-group">
                                            <label>View</label>
                                            <input type="text" name="view" class="form-control" value="{{ old('view', $product->view) }}">
                                            @error('view')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div> --}}

                                        <div class="form-group">
                                            <label>Price</label>
                                            <input type="text" name="price" class="form-control"
                                                value="{{ old('price', $product->price) }}">
                                            @error('price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Offer Price</label>
                                            <input type="text" name="offer_price" class="form-control"
                                                value="{{ old('offer_price', $product->offer_price) }}">
                                            @error('offer_price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <input type="text" name="qty" class="form-control"
                                                value="{{ old('qty', $product->qty) }}">
                                            @error('qty')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Short Description</label>
                                            <textarea name="short_description" class="form-control">{{ old('short_description', $product->short_description) }}</textarea>
                                            @error('short_description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Long Description</label>
                                            <textarea name="long_description" class="form-control summernote">{{ old('long_description', $product->long_description) }}</textarea>
                                            @error('long_description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Show at Home</label>
                                            <select name="show_at_home" class="form-control">
                                                <option value="1" {{ $product->show_at_home == 1 ? 'selected' : '' }}>
                                                    Yes</option>
                                                <option value="0" {{ $product->show_at_home == 0 ? 'selected' : '' }}>
                                                    No</option>
                                            </select>
                                            @error('show_at_home')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>
                                                    Inactive</option>
                                            </select>
                                            @error('status')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary">Edit</button>
                                    </form>
                                </div>
                            </div>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Back</a>

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
@endsection
