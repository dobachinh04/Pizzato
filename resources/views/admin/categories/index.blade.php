@extends('admin.layouts.master')

@section('title')
    Danh Sách danh mục
@endsection

@section('content')
    <!-- Datatable -->
    <link href="/focus-2/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="/focus-2/css/style.css" rel="stylesheet">

    <body>
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Chào Mừng Trở Lại Danh Mục...</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Danh Mục</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Danh Mục Danh Mục</a></li>
                        </ol>
                    </div>
                </div>

                @if (Session::has('success'))
                    <div class="alert alert-success solid alert-dismissible fade show">
                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                                    class="mdi mdi-close"></i></span>
                        </button>
                        <strong>Hoàn Tất!</strong> {{ Session::get('success') }}.
                    </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Danh Mục Danh Mục</h4>
                                <a href="{{ route('admin.categories.create') }}" class="btn btn-success">Thêm Mới</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <!-- <th>ID</th> -->
                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th>Status</th>
                                                <th>Show at home</th>
                                                <!-- <th>Lần Cuối Cập Nhật</th> -->
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- Ví dụ cho hiển thị Categories --}}
                                            @foreach ($categories as $category)
                                                <tr>
                                                    {{-- <td>{{ $category->id }}</td> --}}
                                                    <td>{{ $category->name }}</td>
                                                    <td>{{ $category->slug }}</td>
                                                    <td>{{ $category->status == 1 ? 'Còn hàng' : 'Hết hàng' }}</td>
                                                    <td>{{ $category->show_at_home == 0 ? 'Ẩn' : 'Hiển thị' }}</td>
                                                    {{-- <td>{{ $category->created_at->format('d/m/Y H:i') }}</td>
                                                    <td>{{ $category->updated_at->format('d/m/Y H:i') }}</td>  --}}
                                                    <td>
                                                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                            class="btn btn-warning">Sửa</a>
                                                        <form action="{{ route('admin.categories.destroy', $category) }}"
                                                            method="POST" style="display:inline;"
                                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Xóa</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach 
                                        </tbody>
                                        <tfoot>
                                            <!-- <tr>
                                                <th>ID</th>
                                                <th>Tên</th>
                                                <th>Tạo Ngày</th>
                                                <th>Lần Cuối Cập Nhật</th>
                                                <th>Hành Động</th>
                                            </tr> -->
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Required vendors -->
        <script src="/focus-2/vendor/global/global.min.js"></script>
        <script src="/focus-2/js/quixnav-init.js"></script>
        <script src="/focus-2/js/custom.min.js"></script>

        <!-- Datatable -->
        <script src="/focus-2/vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="/focus-2/js/plugins-init/datatables.init.js"></script>
    </body>
@endsection
