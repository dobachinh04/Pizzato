@extends('admin.layouts.master')

@section('title')
    Thêm Mới Người Dùng - Pizzato
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
                                <h4 class="card-title">Thêm Mới Người Dùng</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{ route('admin.users.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="basiInput" class="form-label">Họ và Tên</label>
                                                    <input type="text"
                                                        class="form-control input-default mb-3 @error('name') is-invalid @enderror"
                                                        placeholder="Nguyễn Văn A" name="name"
                                                        value="{{ old('name') }}">
                                                    @error('name')
                                                        <p>{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="basiInput" class="form-label">Mật Khẩu</label>
                                                    <input type="password"
                                                        class="form-control input-default mb-3 @error('password') is-invalid @enderror"
                                                        placeholder="Nhập Mật Khẩu" name="password"
                                                        value="{{ old('password') }}">
                                                    @error('password')
                                                        <p>{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="basiInput" class="form-label">Nhập Lại Mật Khẩu</label>
                                                    <input type="password"
                                                        class="form-control input-default mb-3 @error('password_confirmation') is-invalid @enderror"
                                                        name="password_confirmation" placeholder="Nhập Lại Mật Khẩu"
                                                        value="{{ old('password_confirmation') }}">
                                                    @error('password_confirmation')
                                                        <p>{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="basiInput" class="form-label">Email</label>
                                                    <input type="text"
                                                        class="form-control input-default mb-3 @error('email') is-invalid @enderror"
                                                        placeholder="abc@gmail.com" name="email"
                                                        value="{{ old('email') }}">
                                                    @error('email')
                                                        <p>{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="basiInput" class="form-label">Phân Quyền</label>
                                                    <select class="form-control mb-3 @error('role_id') is-invalid @enderror"
                                                        name="role_id" value="{{ old('role_id') }}">
                                                        <option selected disabled>Chọn Vai Trò</option>
                                                        @foreach ($roles as $role)
                                                            {{-- <option value="{{ $role->id }}">{{ $role->name }}</option> --}}

                                                            <option value="{{ $role->id }}"
                                                                {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                                                {{ $role->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                    @error('role_id')
                                                        <p>{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="formFile" class="form-label">Ảnh Đại Diện</label>
                                                    <input class="form-control @error('image') is-invalid @enderror"
                                                        type="file" id="formFile" name="image" accept="image/*"
                                                        value="{{ old('image') }}">
                                                </div>
                                                @error('image')
                                                    <p>{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
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
