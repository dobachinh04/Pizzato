@extends('admin.layouts.master')

@section('title')
    Cập Nhật Người Dùng - Pizzato
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
                                    <form action="{{ route('admin.users.update', $user) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group mb-3">
                                                    <label for="basiInput" class="form-label">Họ và Tên</label>
                                                    <input type="text"
                                                        class="form-control input-default @error('name') is-invalid @enderror"
                                                        placeholder="Nguyễn Văn A" name="name"
                                                        value="{{ old('name', $user->name) }}">
                                                    @error('name')
                                                        <p>{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="basiInput" class="form-label">Email</label>
                                                    <input type="text"
                                                        class="form-control input-default @error('email') is-invalid @enderror"
                                                        placeholder="abc@gmail.com" name="email"
                                                        value="{{ old('email', $user->email) }}">
                                                    @error('email')
                                                        <p>{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                {{-- <div class="form-group">
                                                    <label for="basiInput" class="form-label">Mật Khẩu</label>
                                                    <input type="password"
                                                        class="form-control input-default @error('password') is-invalid @enderror"
                                                        placeholder="" name="password" value="{{ old('password', $user->password) }}">
                                                    @error('password')
                                                        <p>{{ $message }}</p>
                                                    @enderror
                                                </div> --}}

                                                {{-- <div class="form-group">
                                                    <label for="basiInput" class="form-label">Nhập Lại Mật Khẩu</label>
                                                    <input type="password"
                                                        class="form-control input-default @error('password_confirmation') is-invalid @enderror"
                                                        name="password_confirmation"
                                                        value="{{ old('password_confirmation', $user->password_confirmation) }}">
                                                    @error('password_confirmation')
                                                        <p>{{ $message }}</p>
                                                    @enderror
                                                </div> --}}
                                                {{-- <div class="form-group">
                                                    <label for="basiInput" class="form-label">Mật Khẩu</label>
                                                    <input type="password"
                                                        class="form-control input-default @error('password') is-invalid @enderror"
                                                        placeholder="" name="password" value="{{ old('password') }}">
                                                    @error('password')
                                                        <p>{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="basiInput" class="form-label">Nhập Lại Mật Khẩu</label>
                                                    <input type="password"
                                                        class="form-control input-default @error('password_confirmation') is-invalid @enderror"
                                                        name="password_confirmation"
                                                        value="{{ old('password_confirmation') }}">
                                                    @error('password_confirmation')
                                                        <p>{{ $message }}</p>
                                                    @enderror
                                                </div> --}}
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group mb-3">
                                                    <label for="basiInput" class="form-label">Phân Quyền</label>
                                                    <select class="form-control @error('role_id') is-invalid @enderror"
                                                        name="role_id" value="{{ old('role_id') }}">
                                                        <option selected disabled>Chọn Vai Trò</option>
                                                        @foreach ($roles as $role)
                                                            {{-- <option value="{{ $role->id }}">{{ $role->name }}</option> --}}

                                                            {{-- Option vẫn giữ nguyên khi sửa --}}
                                                            <option value="{{ $role->id }}"
                                                                {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                                                {{ $role->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('role_id')
                                                        <p>{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-3">
                                                    <input type="file"
                                                        class="custom-file-input @error('image') is-invalid @enderror"
                                                        name="image" accept="image/*"
                                                        value="{{ old('image', $user->image) }}">
                                                    <label class="custom-file-label">Chọn Ảnh</label>


                                                </div>
                                                @error('image')
                                                    <p>{{ $message }}</p>
                                                @enderror
                                                @if ($user->image)
                                                    <img class="mb-3" src="{{ asset('storage/' . $user->image) }}"
                                                        style="width: 100px;" alt="Ảnh Cũ">
                                                @endif
                                            </div>
                                            @error('image')
                                                <p>{{ $message }}</p>
                                            @enderror
                                        </div>
                                </div>

                                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                    Quay Lại</a>
                                <button type="submit" class="btn btn-warning">Cập Nhật</button>
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
