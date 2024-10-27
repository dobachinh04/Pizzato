@extends('admin.layouts.master')

@section('title')
    Thêm Mới Blogs - Pizzato
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
                                <h4 class="card-title">Thêm Mới Blogs</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{ route('admin.blogs.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="user_id">User</label>
                                                    <select name="user_id" id="user_id">
                                                        <option value="">Chọn người dùng</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="category_id">Danh mục</label>
                                                    <select name="category_id" id="category_id">
                                                        <option value="">Chọn danh mục</option>
                                                        @foreach ($blogCategories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="formFile" class="form-label">Image</label>
                                                <input class="form-control @error('image') is-invalid @enderror"
                                                    type="file" id="formFile" name="image" accept="image/*"
                                                    value="{{ old('image') }}">
                                            </div>
                                            @error('image')
                                                <p>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" name="title" id="title">
                                            </div>

                                            <div class="form-group">
                                                <label for="slug">Slug</label>
                                                <input type="text" name="slug" id="slug">
                                            </div>

                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea name="description" id="description"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select name="status" id="status">
                                                    <option value="">Chọn trạng thái</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>

                                        <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">
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
@endsection
