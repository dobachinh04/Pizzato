{{-- @extends('admin.layouts.master')

@section('title')
    Thêm Mới Tin - Pizzato
@endsection

@section('content') --}}
<div class="section-header">
    <h1>Product</h1>
</div>

<div class="card card-primary">
    <div class="card-header">
        <h4>Create Procut</h4>

    </div>
    <div class="card-body">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label>Slug</label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
            </div>
            <div class="mt-3">
                <label for="thumb_image" class="form-label">Image</label>
                <input type="file" class="form-control" id="thumb_image" name="thumb_image">
            </div>
            <div class="form-group">
                <label>Sku</label>
                <input type="text" name="sku" class="form-control" value="{{ old('sku') }}">
            </div>
            <div class="form-group">
                <label for="category_id" class="form-label">Catalogue</label>
                <select type="text" class="form-select" id="category_id" name="category_id">
                    @foreach ($categories as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>View</label>
                <input type="text" name="view" class="form-control" value="{{ old('view') }}">
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="text" name="price" class="form-control" value="{{ old('price') }}">
            </div>

            <div class="form-group">
                <label>Offer Price</label>
                <input type="text" name="offer_price" class="form-control" value="{{ old('offer_price') }}">
            </div>

            <div class="form-group">
                <label>Quantity</label>
                <input type="text" name="qty" class="form-control" value="{{ old('qty') }}">
            </div>

            <div class="form-group">
                <label>Short Description</label>
                <textarea name="short_description" class="form-control" id="">{{ old('short_description') }}</textarea>
            </div>

            <div class="form-group">
                <label>Long Description</label>
                <textarea name="long_description" class="form-control summernote" id="">{{ old('long_description') }}</textarea>
            </div>

            <div class="form-group">
                <label>Show at Home</label>
                <select name="show_at_home" class="form-control" id="">
                    <option value="1">Yes</option>
                    <option selected value="0">No</option>
                </select>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control" id="">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</div>
<a href="{{ route('admin.products.index') }}" class="btn btn-primary">Back</a>
{{-- @endsection --}}
