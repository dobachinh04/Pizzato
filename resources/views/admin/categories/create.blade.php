@extends('admin.layouts.master')

@section('title')
    Thêm Mới Danh Mục - Pizzato
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

    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Hi, welcome back!</h4>
                        <span class="ml-1">Element</span>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Danh Mục</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Thêm Mới Danh Mục</a></li>
                    </ol>
                </div>
            </div>

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
                                        <input type="text" name="name" class="form-control input-default "
                                            placeholder="Tên Danh Mục" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="slug" class="form-control input-default "
                                            placeholder="VD: danh-muc-1" required>
                                    </div>

                                    <div class="form-group">
                                        <select name="status" class="form-control input-default">
                                            <option disabled>Chọn Trạng Thái</option>
                                            <option value="1" selected>Còn hàng</option>
                                            <option value="0">Hết hàng</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <select name="show_at_home" class="form-control input-default">
                                            <option disabled>Chọn Trạng Thái</option>
                                            <option value="1">Hiển thị</option>
                                            <option value="0" selected>Ẩn</option>
                                        </select>
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
@endsection
