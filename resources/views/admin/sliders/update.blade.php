@extends('admin.layouts.master')

@section('title')
    Cập Nhật Slider - Pizzato
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
                                <h4 class="card-title">Cập Nhật Slider</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT') <!-- Thêm phương thức PUT cho việc cập nhật -->

                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="formFile" class="form-label">Image</label>
                                                <input class="form-control" type="file" id="formFile" name="image"
                                                    accept="image/*">
                                                @if ($slider->image)
                                                    <img src="{{ asset('storage/' . $slider->image) }}" alt="Current Image"
                                                        class="mt-2" style="max-width: 200px;">
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="offer">Offer</label>
                                                <input type="text" name="offer" id="offer" class="form-control"
                                                    value="{{ old('offer', $slider->offer) }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" name="title" id="title" class="form-control"
                                                    value="{{ old('title', $slider->title) }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="sub_title">Sub Title</label>
                                                <input type="text" name="sub_title" id="sub_title" class="form-control"
                                                    value="{{ old('sub_title', $slider->sub_title) }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="short_description">Short Description</label>
                                                <textarea name="short_description" id="short_description" class="form-control">{{ old('short_description', $slider->short_description) }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="button_link">Button Link</label>
                                                <input type="text" name="button_link" id="button_link"
                                                    class="form-control"
                                                    value="{{ old('button_link', $slider->button_link) }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="">Chọn trạng thái</option>
                                                    <option value="1"
                                                        {{ old('status', $slider->status) == '1' ? 'selected' : '' }}>Show
                                                    </option>
                                                    <option value="0"
                                                        {{ old('status', $slider->status) == '0' ? 'selected' : '' }}>Hidden
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">Quay Lại</a>
                                        <button type="submit" class="btn btn-success">Cập Nhật</button>
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
