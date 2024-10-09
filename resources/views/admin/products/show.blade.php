@extends('admin.layouts.master')

@section('title')
    Chi Tiết Tin - Pizzato
@endsection

@section('content')
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
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Tin Tức</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Chi Tiết Tin Tức</a></li>
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
                    <div class="card ">
                        <div class="card-body row">
                            <div class="col-md-6">
                                <h1>Detail Product: {{ $product->id }}</h1>
                                <h3>Tiêu Đề: {{ $product->title }}</h3>

                                @if ($product->image)
                                    <img src="{{ Storage::url($product->image) }}" style="width: 100%; max-width: 250px;"
                                        alt="Image">
                                @endif

                                <div class="mt-3">
                                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Quay Lại</a>
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">Sửa</a>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <table>
                                    <tr>
                                        <th>Field name</th>
                                        <th>Value</th>
                                    </tr>
                                    <tbody>
                                        @foreach ($product->toArray() as $field => $value)
                                            <tr>
                                                <td>
                                                    @if ($field == 'category_id')
                                                        Category
                                                    @else
                                                        {{ Str::ucfirst(str_replace('_', ' ', $field)) }}
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($field == 'thumb_image')
                                                        <img src="{{ Storage::url($value) }}" alt="" width="50px">
                                                    @elseif (Str::contains($field, 'show_at_home'))
                                                        <span class="badge {{ $value ? 'bg-primary' : 'bg-danger' }}">
                                                            {{ $value ? 'YES' : 'NO' }}
                                                        </span>
                                                    @elseif (Str::contains($field, 'status'))
                                                        <span class="badge {{ $value ? 'bg-primary' : 'bg-danger' }}">
                                                            {{ $value ? 'YES' : 'NO' }}
                                                        </span>
                                                    @elseif ($field == 'category_id')
                                                        {{ $product->category->name }}
                                                    @else
                                                        {{ $value }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
