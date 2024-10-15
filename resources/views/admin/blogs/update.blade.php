@extends('admin.layouts.master')

@section('title')
    Cập Nhật Blog - Pizzato
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
                                <h4 class="card-title">Cập Nhật Người Dùng</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT') <!-- Thêm phương thức PUT để cập nhật -->
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="user_id">User</label>
                                                    <select name="user_id" id="user_id" required>
                                                        <option value="">Chọn người dùng</option>
                                                        @foreach($users as $user)
                                                            <option value="{{ $user->id }}" {{ $user->id == $blog->user_id ? 'selected' : '' }}>
                                                                {{ $user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                    
                                                <div class="form-group">
                                                    <label for="category_id">Danh mục</label>
                                                    <select name="category_id" id="category_id" required>
                                                        <option value="">Chọn danh mục</option>
                                                        @foreach($blogCategories as $category)
                                                            <option value="{{ $category->id }}" {{ $category->id == $blog->category_id ? 'selected' : '' }}>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                    
                                            <div class="form-group mb-3">
                                                <label for="formFile" class="form-label">Image</label>
                                                <input class="form-control @error('image') is-invalid @enderror" type="file" id="formFile" name="image" accept="image/*">
                                                @if($blog->image)
                                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="Current Image" class="img-thumbnail mt-2" width="150">
                                                @endif
                                                @error('image')
                                                    <p>{{ $message }}</p>
                                                @enderror
                                            </div>
                                    
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="title">Title</label>
                                                    <input type="text" name="title" id="title" value="{{ old('title', $blog->title) }}">
                                                </div>
                                    
                                                <div class="form-group">
                                                    <label for="slug">Slug</label>
                                                    <input type="text" name="slug" id="slug" value="{{ old('slug', $blog->slug) }}">
                                                </div>
                                    
                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <textarea name="description" id="description">{{ old('description', $blog->description) }}</textarea>
                                                </div>
                                    
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <select name="status" id="status">
                                                        <option value="">Chọn trạng thái</option>
                                                        <option value="1" {{ $blog->status == 1 ? 'selected' : '' }}>Active</option>
                                                        <option value="0" {{ $blog->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                    
                                            <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Quay Lại</a>
                                            <button type="submit" class="btn btn-success">Cập Nhật</button>
                                        </div>
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
