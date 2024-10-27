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
                                <h4 class="card-title">Thêm Mới Địa Chị Đơn Hàng</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{ route('admin.addresses.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <!-- Select Người Dùng -->
                                        <div class="form-group">
                                            <label for="user_id">Người Dùng</label>
                                            <select name="user_id" class="form-control input-default">
                                                <option value="" disabled selected>Chọn Người Dùng</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Select Khu Vực Giao Hàng -->
                                        <div class="form-group">
                                            <label for="delivery_area_id">Khu Vực Giao Hàng</label>
                                            <select name="delivery_area_id" class="form-control input-default">
                                                <option value="" disabled selected>Chọn Khu Vực Giao Hàng</option>
                                                @foreach ($delivery_areas as $area)
                                                    <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Tên Đệm -->
                                        <div class="form-group">
                                            <label for="first_name">Tên Đệm</label>
                                            <input type="text" name="first_name" class="form-control input-default"
                                                placeholder="Nhập tên đệm" required>
                                        </div>

                                        <!-- Tên -->
                                        <div class="form-group">
                                            <label for="last_name">Tên</label>
                                            <input type="text" name="last_name" class="form-control input-default"
                                                placeholder="Nhập tên" required>
                                        </div>

                                        <!-- Email -->
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" class="form-control input-default"
                                                placeholder="Nhập email" required>
                                        </div>

                                        <!-- Số Điện Thoại -->
                                        <div class="form-group">
                                            <label for="phone">Số Điện Thoại</label>
                                            <input type="text" name="phone" class="form-control input-default"
                                                placeholder="Nhập số điện thoại" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="address">Địa chỉ</label>
                                            <input type="text" name="address" class="form-control" placeholder="Địa chỉ">
                                        </div>
                                        <!-- Loại -->
                                        <div class="form-group">
                                            <label for="type">Loại</label>
                                            <input type="text" name="type" class="form-control input-default"
                                                placeholder="Nhập loại địa chỉ (ví dụ: nhà riêng, công ty)" required>
                                        </div>

                                        <!-- Button Quay Lại và Thêm Mới -->
                                        <a href="{{ route('admin.addresses.index') }}" class="btn btn-secondary">Quay
                                            Lại</a>
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
