{{-- @extends('admin.layouts.master')

@section('title')
    Thêm Mới Sản phẩm
@endsection

@section('content') --}}
<div class="section-header">
    <h1>Product</h1>
</div>

<div class="card card-primary">
    <div class="card-header">
        <h4>Update Product</h4>

    </div>
    <div class="card-body">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}">
            </div>

            <div class="form-group">
                <label>Slug</label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug', $product->slug) }}">
            </div>
            <div class="mt-3">
                <label for="thumb_image" class="form-label">Image</label>
                <input type="file" class="form-control" id="thumb_image" name="thumb_image">
            </div>
            <div class="form-group">
                <label>Sku</label>
                <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku) }}">
            </div>
            <div class="form-group">
                <label for="category_id" class="form-label">Catalogue</label>
                <select type="text" class="form-select" id="category_id" name="category_id">
                    @foreach ($categories as $id => $name)
                        <option value="{{ $id }}" {{ $product->category_id == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>View</label>
                <input type="text" name="view" class="form-control" value="{{ old('view', $product->view) }}">
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="text" name="price" class="form-control" value="{{ old('price', $product->price) }}">
            </div>

            <div class="form-group">
                <label>Offer Price</label>
                <input type="text" name="offer_price" class="form-control"
                    value="{{ old('offer_price', $product->offer_price) }}">
            </div>

            <div class="form-group">
                <label>Quantity</label>
                <input type="text" name="qty" class="form-control" value="{{ old('qty', $product->qty) }}">
            </div>

            <div class="form-group">
                <label>Short Description</label>
                <textarea name="short_description" class="form-control" id="">{{ old('short_description', $product->short_description) }}</textarea>
            </div>

            <div class="form-group">
                <label>Long Description</label>
                <textarea name="long_description" class="form-control summernote" id="">{{ old('long_description', $product->long_description) }}</textarea>
            </div>

            <div class="form-group">
                <label>Show at Home</label>
                <select name="show_at_home" class="form-control" id="">
                    <option value="1" {{ $product->show_at_home == 1 ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ $product->show_at_home == 0 ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control" id="">
                    <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>
</div>
<a href="{{ route('admin.products.index') }}" class="btn btn-primary">Back</a>
{{-- @endsection --}}
