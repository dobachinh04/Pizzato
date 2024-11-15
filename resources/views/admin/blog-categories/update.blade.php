@extends('admin.layouts.master')

@section('title')
Cập Nhật Danh Mục Blog - Pizzato
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
                            <h4 class="card-title">Cập nhật Danh Mục Blog</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ route('admin.blog-categories.update', $category_blog->id) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf

                                    @method('PUT')

                                    <div class="form-group">
                                        <label>Tên</label>
                                        <input type="text" name="name" class="form-control input-default "
                                            placeholder="Tên Danh Mục" value="{{ $category_blog->name }}">
                                        @error('name')
                                        <p style="color: red">{{ $message }}</p>
                                        @enderror
                                        <br>
                                    </div>

                                    <div class="form-group">
                                        <label>Slug</label>
                                        <input type="text" name="slug" class="form-control input-default "
                                            placeholder="VD: bai-viet-1" value="{{ $category_blog->slug }}">
                                        @error('slug')
                                        <p style="color: red">{{ $message }}</p>
                                        @enderror
                                        <br>
                                    </div>

                                    <div class="form-group">
                                        <label>Trạng Thái</label>
                                        <select name="status" class="form-control input-default"
                                            value="{{ $category_blog->status }}">
                                            <option disabled>Chọn Trạng Thái</option>
                                            <option value="1" {{ old('status', $category_blog->status) == 1 ? 'selected' : '' }}>Bật</option>
                                            <option value="0" {{ old('status', $category_blog->status) == 0 ? 'selected' : '' }}>Tắt</option>
                                        </select>
                                        <br>
                                    </div>

                                    <a href="{{ route('admin.blog-categories.index') }}" class="btn btn-secondary">
                                        Quay Lại</a>
                                    <button type="submit" class="btn btn-success">Cập nhật</button>
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