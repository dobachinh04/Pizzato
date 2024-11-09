@extends('admin.layouts.master')

@section('title')
Cập Nhật Danh Mục - Pizzato
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
                            <h4 class="card-title">Cập nhật Danh Mục</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ route('admin.categories.update', $categories->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    @method('PUT')

                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control input-default "
                                            placeholder="Tên Danh Mục" value="{{ $categories->name }}">
                                        @error('name')
                                        <p style="color: red">{{ $message }}</p>
                                        @enderror
                                        <br>
                                    </div>

                                    <div class="form-group">
                                        <label>Slug</label>
                                        <input type="text" name="slug" class="form-control input-default "
                                            placeholder="VD: danh-muc-1" value="{{ $categories->slug }}">
                                        @error('slug')
                                        <p style="color: red">{{ $message }}</p>
                                        @enderror
                                        <br>
                                    </div>

                                    <div class="form-group">
                                        <label>Trạng Thái</label>
                                        <select name="status" class="form-control input-default">
                                            {{-- $categories->status và $categories->show_at_home để lấy giá
                                            trị hiện tại từ database.
                                            - is_null() để xác định giá trị mặc định cho trường. --}}
                                            <option value="" disabled {{ is_null($categories->status) ? 'selected' : ''
                                                }}>Chọn Trạng Thái</option>
                                            <option value="1" {{ $categories->status == 1 ? 'selected' : '' }}>Còn hàng
                                            </option>
                                            <option value="0" {{ $categories->status == 0 ? 'selected' : '' }}>Hết hàng
                                            </option>
                                        </select>
                                        <br>
                                    </div>

                                    <div class="form-group">
                                        <label>Hiển thị ở trang chủ</label>
                                        <select name="show_at_home" class="form-control input-default">
                                            <option value="" disabled {{ is_null($categories->show_at_home) ? 'selected'  : '' }}>Chọn Trạng Thái</option>
                                            <option value="1" {{ $categories->show_at_home == 1 ? 'selected' : '' }}>Hiển thị</option>
                                            <option value="0" {{ $categories->show_at_home == 0 ? 'selected' : '' }}>Ẩn
                                            </option>
                                        </select>
                                        <br>
                                    </div>

                                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
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