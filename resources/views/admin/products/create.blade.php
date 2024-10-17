@extends('admin.layouts.master')

@section('title')
    Thêm Mới Sản Phẩm - Pizzato
@endsection

@section('content')

{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

<div class="section-header">
    <h1>Product</h1>
</div>

<div class="card card-primary">
    <div class="card-header">
        <h4>Create Product</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            {{-- <div class="form-group">
                <label>Slug</label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
                @error('slug')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div> --}}

            <div class="form-group">
                <label>Slug</label>
                <input type="text" name="slug" class="form-control"
                    value="{{ old('slug', isset($product) ? $product->slug : $slug) }}" readonly>
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
                <input type="text" name="sku" class="form-control" value="{{ old('sku') }}">
                @error('sku')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div> --}}
            <div class="form-group">
                <label>Sku</label>
                <input type="text" name="sku" class="form-control" value="{{ old('sku', $sku) }}" readonly>
                @error('sku')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="category_id" class="form-label">Catalogue</label>
                <select type="text" class="form-select" id="category_id" name="category_id">
                    @foreach ($categories as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            {{-- <div class="form-group">
                <label>View</label>
                <input type="text" name="view" class="form-control" value="{{ old('view') }}">
                @error('view')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div> --}}

            <div class="form-group">
                <label>Price</label>
                <input type="text" name="price" class="form-control" value="{{ old('price') }}">
                @error('price')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Offer Price</label>
                <input type="text" name="offer_price" class="form-control" value="{{ old('offer_price') }}">
                @error('offer_price')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Quantity</label>
                <input type="text" name="qty" class="form-control" value="{{ old('qty') }}">
                @error('qty')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Short Description</label>
                <textarea name="short_description" class="form-control" id="">{{ old('short_description') }}</textarea>
                @error('short_description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Long Description</label>
                <textarea name="long_description" class="form-control summernote" id="">{{ old('long_description') }}</textarea>
                @error('long_description')
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
                <label>Status</label>
                <select name="status" class="form-control" id="">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
                @error('status')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
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
    // demoo branch
</script>

