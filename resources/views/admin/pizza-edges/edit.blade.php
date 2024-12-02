@extends('admin.layouts.master')

@section('title')
    Cập Nhật Kích thước bánh - Pizzato
@endsection

@section('content')
    {{-- @if (Session::has('success'))
        <div class="alert alert-success solid alert-dismissible fade show">
            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                        class="mdi mdi-close"></i></span>
            </button>
            <strong>Success!</strong> {{ Session::get('success') }}.
        </div>
    @endif --}}
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
                                <h4 class="card-title">Cập Nhật Viền Pizza</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{ route('admin.pizza-edges.update', $pizzaEdge->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- Tên Viền -->
                                        <div class="form-group">
                                            <label>Tên Viền</label>
                                            <input type="text" name="name"
                                                class="form-control input-default @error('name') is-invalid @enderror"
                                                placeholder="Tên Viền (VD: Viền Phô Mai, Viền Xúc Xích)"
                                                value="{{ old('name', $pizzaEdge->name) }}">
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
                                                placeholder="Nhập Giá (VD: 100000)"
                                                value="{{ old('price', $pizzaEdge->price) }}">

                                            @error('price')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                            <br>
                                        </div>

                                        <!-- Hình Ảnh -->
                                        <div class="form-group">
                                            <label>Hình Ảnh</label>
                                            <input type="file" name="image" class="form-control input-default" id="image">

                                            @php
                                                // Xử lý đường dẫn ảnh
                                                $imageUrl = $pizzaEdge->image;
                                                if (!\Str::contains($imageUrl, 'http')) {
                                                    $imageUrl = \Storage::url($imageUrl);
                                                }
                                            @endphp

                                            <!-- Hiển thị hình ảnh -->
                                            @if (!empty($imageUrl))
                                                <img src="{{ $imageUrl }}" width="100px" height="100px" alt="Hình ảnh viền pizza">
                                            @endif

                                            @error('image')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Nút Hành Động -->
                                        <a href="{{ route('admin.pizza-edges.index') }}" class="btn btn-secondary">
                                            Quay Lại
                                        </a>
                                        <button type="submit" class="btn btn-success">Cập Nhật</button>
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
