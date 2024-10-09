@extends('admin.layouts.master')

@section('title')
    Danh Sách Địa Chỉ Đơn Hàng - Pizzato
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
                            <h4>Chào Mừng Với Danh Sách Địa Chỉ Đơn Hàng</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Danh Sách Địa Chỉ Đơn Hàng</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Danh Sách Địa Chỉ Đơn Hàng</a></li>
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
                                <h4 class="card-title">Danh Sách Địa Chỉ Đơn Hàng</h4>
                                <a href="{{ route('admin.addresses.create') }}" class="btn btn-success">Thêm Mới</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>ID Người Dùng</th>
                                                <th>ID Khu Vực Giao Hàng</th>
                                                <th>Họ</th>
                                                <th>Tên</th>
                                                <th>Email</th>
                                                <th>Số Điện Thoại</th>
                                                <th>Loại Địa Chỉ</th>
                                                <th>Ngày Tạo</th>
                                                <th>Ngày Cập Nhật</th>
                                                <th>Thao Tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($addresses as $address)
                                                <tr>
                                                    <td>{{ $address->id }}</td>
                                                    <td>{{ $address->user_id }}</td>
                                                    <td>{{ $address->delivery_area_id }}</td>
                                                    <td>{{ $address->first_name }}</td>
                                                    <td>{{ $address->last_name }}</td>
                                                    <td>{{ $address->email }}</td>
                                                    <td>{{ $address->phone }}</td>
                                                    <td>{{ $address->type }}</td>
                                                    <td>{{ $address->created_at ? $address->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                                    <td>{{ $address->updated_at ? $address->updated_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.addresses.update', $address) }}" class="btn btn-warning">Sửa</a>
                                                        <form action="" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Xóa</button>
                                                        </form>
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

        <!-- Các thư viện cần thiết -->
        <script src="/focus-2/vendor/global/global.min.js"></script>
        <script src="/focus-2/js/quixnav-init.js"></script>
        <script src="/focus-2/js/custom.min.js"></script>

        <!-- Datatable -->
        <script src="/focus-2/vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="/focus-2/js/plugins-init/datatables.init.js"></script>
    </body>
@endsection
