@extends('admin.layouts.master')

@section('title')
    Thêm Mới Danh Mục
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
                                <h4 class="card-title">Thêm Mới Danh Mục</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{ route('admin.categories.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" class="form-control input-default "
                                                placeholder="Tên Danh Mục" required>
                                            <br>
                                        </div>

                                        <div class="form-group">
                                            <label>Slug</label>
                                            <input type="text" name="slug" class="form-control input-default "
                                                placeholder="VD: danh-muc-1" required>
                                            <br>
                                        </div>

                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control input-default">
                                                <option disabled>Chọn Trạng Thái</option>
                                                <option value="1" selected>Còn hàng</option>
                                                <option value="0">Hết hàng</option>
                                            </select>
                                            <br>
                                        </div>

                                        <div class="form-group">
                                            <label>Show_at_home</label>
                                            <select name="show_at_home" class="form-control input-default">
                                                <option disabled>Chọn Trạng Thái</option>
                                                <option value="1">Hiển thị</option>
                                                <option value="0" selected>Ẩn</option>
                                            </select>
                                            <br>
                                        </div>

                                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
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
