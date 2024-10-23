@extends('admin.layouts.master')

@section('title')
Thêm Mới Địa Chỉ Giao Hàng - Pizzato
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
                            <h4 class="card-title">Thêm Mới Thêm Mới Địa Chỉ Giao Hàng</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                            <form action="{{ route('admin.delivery_areas.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="area_name">Tên khu vực</label>
                                    <input type="text" name="area_name" class="form-control @error('area_name') is-invalid @enderror" value="{{ old('area_name', $area->area_name ?? '') }}">
                                    @error('area_name')
                                        <div class="invalid-feedback">{{ $errors->first('area_name') }}</div>
                                    @enderror
                                    <br>
                                </div>
                            
                                <div class="form-group">
                                    <label for="min_delivery_time">Thời gian giao hàng tối thiểu</label>
                                    <input type="text" name="min_delivery_time" class="form-control @error('min_delivery_time') is-invalid @enderror" value="{{ old('min_delivery_time', $area->min_delivery_time ?? '') }}">
                                    @error('min_delivery_time')
                                        <div class="invalid-feedback">{{ $errors->first('min_delivery_time') }}</div>
                                    @enderror
                                    <br>
                                </div>
                            
                                <div class="form-group">
                                    <label for="max_delivery_time">Thời gian giao hàng tối đa</label>
                                    <input type="text" name="max_delivery_time" class="form-control @error('max_delivery_time') is-invalid @enderror" value="{{ old('max_delivery_time', $area->max_delivery_time ?? '') }}">
                                    @error('max_delivery_time')
                                        <div class="invalid-feedback">{{ $errors->first('max_delivery_time') }}</div>
                                    @enderror
                                    <br>
                                </div>
                            
                                <div class="form-group">
                                    <label for="delivery_fee">Phí giao hàng</label>
                                    <input type="number" name="delivery_fee" class="form-control @error('delivery_fee') is-invalid @enderror" value="{{ old('delivery_fee', $area->delivery_fee ?? '') }}">
                                    @error('delivery_fee')
                                        <div class="invalid-feedback">{{ $errors->first('delivery_fee') }}</div>
                                    @enderror
                                    <br>
                                </div>
                            
                                <div class="form-group">
                                    <label for="status">Trạng thái</label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                        <option value="1" {{ old('status', $area->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $area->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                                    @enderror
                                    <br>
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
</div>
@endsection