@extends('admin.layouts.master')

@section('title')
    Sửa Địa Chỉ Đơn Hàng - Pizzato
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
                        <h4>Sửa Địa Chỉ Đơn Hàng</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Địa Chỉ Đơn Hàng</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Sửa Địa Chỉ Đơn Hàng</a></li>
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

            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Sửa Địa Chỉ Đơn Hàng</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ route('admin.addresses.update', $address->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Chọn Người Dùng -->
                                    <div class="form-group">
                                        <label for="user_id">Người Dùng</label>
                                        <select name="user_id" id="user_id" class="form-control">
                                            <option value="">Chọn người dùng</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}" {{ $address->user_id == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <!-- Chọn Khu Vực Giao Hàng -->
                                    <div class="form-group">
                                        <label for="delivery_area_id">Khu Vực Giao Hàng</label>
                                        <select name="delivery_area_id" id="delivery_area_id" class="form-control">
                                            <option value="">Chọn khu vực giao hàng</option>
                                            @foreach ($delivery_areas as $area)
                                                <option value="{{ $area->id }}" {{ $address->delivery_area_id == $area->id ? 'selected' : '' }}>
                                                    {{ $area->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Tên Đệm -->
                                    <div class="form-group">
                                        <label for="first_name">Tên Đệm</label>
                                        <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Tên Đệm"
                                            value="{{ $address->first_name }}">
                                    </div>

                                    <!-- Tên -->
                                    <div class="form-group">
                                        <label for="last_name">Tên</label>
                                        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Tên"
                                            value="{{ $address->last_name }}">
                                    </div>

                                    <!-- Email -->
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                                            value="{{ $address->email }}">
                                    </div>

                                    <!-- Số Điện Thoại -->
                                    <div class="form-group">
                                        <label for="phone">Số Điện Thoại</label>
                                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Số Điện Thoại"
                                            value="{{ $address->phone }}">
                                    </div>

                                    <!-- Địa Chỉ -->
                                    <div class="form-group">
                                        <label for="address">Địa Chỉ</label>
                                        <input type="text" name="address" id="address" class="form-control" placeholder="Địa chỉ"
                                            value="{{ $address->address }}">
                                    </div>

                                    <!-- Loại -->
                                    <div class="form-group">
                                        <label for="type">Loại Địa Chỉ</label>
                                        <input type="text" name="type" id="type" class="form-control" placeholder="Loại"
                                            value="{{ $address->type }}">
                                    </div>

                                    <a href="{{ route('admin.addresses.index') }}" class="btn btn-secondary">Quay Lại</a>
                                    <button type="submit" class="btn btn-success">Cập Nhật</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
