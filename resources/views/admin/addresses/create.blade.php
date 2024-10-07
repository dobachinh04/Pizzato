@extends('admin.layouts.master')

@section('title')
    Thêm Mới Địa Chỉ Đơn Hàng - Pizzato
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
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Địa Chỉ Đơn Hàng</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Thêm Mới Địa Chỉ Đơn Hàng</a></li>
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
                            <h4 class="card-title">Thêm Mới Địa Chỉ Đơn Hàng</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control input-default "
                                            placeholder="ID người dùng">
                                            {{-- Làm Select --}}
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control input-default "
                                            placeholder="ID delivery_area">
                                            {{-- Làm Select --}}
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control input-default "
                                            placeholder="Tên Đệm">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control input-default "
                                            placeholder="Tên">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control input-default "
                                            placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control input-default "
                                            placeholder="Số Điện Thoại">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control input-default "
                                            placeholder="Loại">
                                    </div>

                                    <a href="{{ route('admin.addresses.index') }}" class="btn btn-secondary">
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
