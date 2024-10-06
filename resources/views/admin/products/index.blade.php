@extends('admin.layouts.master')

@section('title')
    Danh Sách Sản Phẩm - Pizzato
@endsection

@section('content')

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

        {{-- <!-- Required vendors -->
        <script src="/focus-2/vendor/global/global.min.js"></script>
        <script src="/focus-2/js/quixnav-init.js"></script>
        <script src="/focus-2/js/custom.min.js"></script>

        <!-- Datatable -->
        <script src="/focus-2/vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="/focus-2/js/plugins-init/datatables.init.js"></script> --}}
    </body>
@endsection
