@extends('admin.layouts.master')

@section('title')
    Danh Sách Sản Phẩm - Pizzato
@endsection

@section('content')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    @if (Session::has('success'))
        <div class="alert alert-success solid alert-dismissible fade show">
            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                        class="mdi mdi-close"></i></span>
            </button>
            <strong>Hoàn Tất!</strong> {{ Session::get('success') }}.
        </div>
    @endif

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h5 class="card-title mb-0">Danh Sách Sản Phẩm</h5>
                                <a href="{{ route('admin.products.create') }}" class="btn btn-success ms-auto">Thêm Mới</a>
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
                            <div class="card-body">
                                <table id="example"
                                    class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 10px;">
                                                <div class="form-check">
                                                    <input class="form-check-input fs-15" type="checkbox" id="checkAll"
                                                        value="option">
                                                </div>
                                            </th>

                                            <th>ID</th>
                                            <th>Hình ảnh</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Danh mục</th>
                                            <th>Giá</th>
                                            <th>Giá khuyến mãi </th>
                                            <th>Số lượng</th>
                                            <th>Hiển thị </th>
                                            <th>Trạng thái</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input fs-15" type="checkbox"
                                                            name="checkAll" value="option1">
                                                    </div>
                                                </th>
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
                                                {{-- <td>{{ $item->category->name }}</td> --}}
                                                <td>{{ $item->category->name }}</td>
                                                {{-- <td>{{ $item->price }}</td> --}}
                                                <td>{{ number_format($item->price, 0, ',', '.') }}₫</td>
                                                {{-- <td>{{ $item->offer_price }}</td> --}}
                                                <td>{{ number_format($item->offer_price, 0, ',', '.') }}₫</td>
                                                <td>{{ $item->qty }}</td>

                                                <td>{!! $item->show_at_home
                                                    ? '<span class="badge bg-primary">Yes</span>'
                                                    : '<span class="badge bg-danger">No</span>' !!}</td>

                                                <td>{!! $item->status
                                                    ? '<span class="badge bg-primary">Active</span>'
                                                    : '<span class="badge bg-danger">Inactive</span>' !!}</td>
                                                <td>
                                                    @if (!$item->trashed())
                                                        <a class="btn btn-info"
                                                            href="{{ route('admin.products.show', $item->id) }}"><i
                                                                class="fa fa-info-circle"></i></a>

                                                        <a class="btn btn-warning"
                                                            href="{{ route('admin.products.edit', $item->id) }}"><i
                                                                class="fa fa-edit"> </i></a>
                                                    @endif

                                                    <!--  Xóa mềm -->
                                                    @if (!$item->trashed())
                                                        <form action="{{ route('admin.products.destroy', $item->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button
                                                                onclick='return confirm("Bạn có chắc là muốn xóa không?")'
                                                                type="submit" class="btn btn-danger"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </form>
                                                    @endif

                                                    <!-- Nút Khôi phục -->
                                                    @if ($item->trashed())
                                                    <span class="badge bg-danger">Đã xoá</span>

                                                        <form action="{{ route('admin.products.restore', $item->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button
                                                                onclick='return confirm("Bạn có chắc là muốn khôi phục không?")'
                                                                type="submit" class="btn btn-success">
                                                                <i class="fa fa-recycle"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="/velzon/assets/js/pages/datatables.init.js"></script>
@endsection
