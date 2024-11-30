@extends('admin.layouts.master')

@section('title')
    Thêm Mới Đế Bánh
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
                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}

                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Thêm Đế Bánh</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{ route('admin.pizza-bases.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <!-- Tên Pizza Base -->
                                        <div class="form-group">
                                            <label>Tên Đế Bánh</label>
                                            <input type="text" name="name"
                                                class="form-control input-default @error('name') is-invalid @enderror"
                                                placeholder="Tên Pizza Base (VD: Đế mỏng, đế dày)"
                                                value="{{ old('name') }}">

                                            @error('name')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                            <br>
                                        </div>

                                        <!-- Giá -->
                                        <div class="form-group">
                                            <label>Giá</label>
                                            <input type="number" name="price"
                                                class="form-control input-default @error('price') is-invalid @enderror"
                                                placeholder="Nhập Giá (VD: 50000)"
                                                value="{{ old('price') }}">
                                            @error('price')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                            <br>
                                        </div>

                                        <!-- Hình Ảnh -->
                                        <div class="form-group">
                                            <label>Hình Ảnh</label>
                                            <input type="file" name="image" class="form-control input-default" id="image">
                                            @error('image')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                            <br>
                                        </div>

                                        <!-- Nút Hành Động -->
                                        <a href="{{ route('admin.pizza-bases.index') }}" class="btn btn-secondary">
                                            Quay Lại
                                        </a>
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
