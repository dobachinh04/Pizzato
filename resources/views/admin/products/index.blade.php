@extends('admin.layouts.master')

@section('title')
    Danh sách sản phẩm
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Product Management</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Product Management</a></li>
                        <li class="breadcrumb-item active">List </li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    @if (Session::has('success'))
        <div class="alert alert-success solid alert-dismissible fade show">
            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                        class="mdi mdi-close"></i></span>
            </button>
            <strong>Hoàn Tất!</strong> {{ Session::get('success') }}.
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">List Product</h5>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">Thêm mới sản phẩm</a>

                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10px;">
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                    </div>
                                </th>
                                <th></th>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Offer Price</th>
                                <th>Quantity</th>
                                <th>Show At Home</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        @php
                                            $url = $item->thumb_image;
                                            if (!\Str::contains($url, 'http')) {
                                                $url = \Storage::url($url);
                                            }
                                        @endphp
                                        <img src="{{ $url }}" alt="" width="100px">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->offer_price }}</td>
                                    <td>{{ $item->qty }}</td>

                                    <td>{!! $item->show_at_home
                                        ? '<span class="badge bg-primary">Yes</span>'
                                        : '<span class="badge bg-danger">No</span>' !!}</td>

                                    <td>{!! $item->status
                                        ? '<span class="badge bg-primary">Active</span>'
                                        : '<span class="badge bg-danger">Inactive</span>' !!}</td>
                                    <td>
                                        <a href="{{ route('admin.products.show', $item->id) }}">Show</a>
                                        <a href="{{ route('admin.products.edit', $item->id) }}">Edit</a>

                                        <form action="{{ route('admin.products.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick='return confirm("R u sure?")' type="submit"
                                                class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->
@endsection

{{-- @section('content')

    <body>
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Sản phẩm</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Danh Sách Sản Phẩm</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->

                @if (Session::has('success'))
                    <div class="alert alert-success solid alert-dismissible fade show">
                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                                    class="mdi mdi-close"></i></span>
                        </button>
                        <strong>Hoàn Tất!</strong> {{ Session::get('success') }}.
                    </div>
                @endif

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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Danh Sách Bài Viết</h4>
                                <a href="{{ route('admin.products.create') }}" class="btn btn-success">Thêm Mới</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Price</th>
                                                <th>Offer Price</th>
                                                <th>Quantity</th>
                                                <th>Show At Home</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>
                                                        @php
                                                            $url = $item->thumb_image;
                                                            if (!\Str::contains($url, 'http')) {
                                                                $url = \Storage::url($url);
                                                            }
                                                        @endphp
                                                        <img src="{{ $url }}" alt="" width="100px">
                                                    </td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->category->name }}</td>
                                                    <td>{{ $item->price }}</td>
                                                    <td>{{ $item->offer_price }}</td>
                                                    <td>{{ $item->qty }}</td>

                                                    <td>{!! $item->show_at_home
                                                        ? '<span class="badge bg-primary">Yes</span>'
                                                        : '<span class="badge bg-danger">No</span>' !!}</td>

                                                    <td>{!! $item->status
                                                        ? '<span class="badge bg-primary">Active</span>'
                                                        : '<span class="badge bg-danger">Inactive</span>' !!}</td>
                                                    <td>
                                                        <a href="{{ route('admin.products.show', $item->id) }}">Show</a>
                                                        <a href="{{ route('admin.products.edit', $item->id) }}">Edit</a>

                                                        <form action="{{ route('admin.products.destroy', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button onclick='return confirm("R u sure?")' type="submit"
                                                                class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </td>
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
    </body>
@endsection --}}
