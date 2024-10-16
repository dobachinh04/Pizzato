@extends('admin.layouts.master')

@section('title')
Thêm Mới Địa Chỉ Đơn Hàng - Pizzato
@endsection

@section('content')
@if (Session::has('success'))
<div class="alert alert-success solid alert-dismissible fade show">
    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close">
        <span><i class="mdi mdi-close"></i></span>
    </button>
    <strong>Success!</strong> {{ Session::get('success') }}.
</div>
@endif

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Chào Mừng, hãy thêm một địa chỉ giao hàng mới!</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Địa Chỉ Giao Hàng</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Thêm Mới Địa Chỉ Giao Hàng</a></li>
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

        <!-- Form thêm mới địa chỉ -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Thêm Mới Địa Chỉ Giao Hàng</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ route('admin.delivery_areas.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="area_name">Area Name</label>
                                    <input type="text" class="form-control" name="area_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="min_delivery_time">Min Delivery Time</label>
                                    <input type="text" class="form-control" name="min_delivery_time" required>
                                </div>
                                <div class="form-group">
                                    <label for="max_delivery_time">Max Delivery Time</label>
                                    <input type="text" class="form-control" name="max_delivery_time" required>
                                </div>
                                <div class="form-group">
                                    <label for="delivery_fee">Delivery Fee</label>
                                    <input type="number" class="form-control" name="delivery_fee" required>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="1" selected>Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <!-- Button Quay Lại và Thêm Mới -->
                                <a href="{{ route('admin.delivery_areas.index') }}" class="btn btn-secondary">Quay Lại</a>
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