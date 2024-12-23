@extends('admin.layouts.master')

@section('title')
    Danh Sách Đánh Giá Sản Phẩm - Pizzato
@endsection

@section('style')
<style>
    .star-rating {
    display: inline-block;
}

.star-rating .fa-star,
.star-rating .fa-star-half-alt {
    font-size: 20px;
    margin-right: 2px;
}

</style>

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
                                <h5 class="card-title mb-0">Danh Sách Đánh Giá Sản Phẩm</h5>
                            </div>

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
                                            <th>Tên Người Dùng</th>
                                            <th>Tên Sản Phẩm</th>
                                            <th>Điểm Đánh Giá</th>
                                            <th>Nội Dung Đánh Giá</th>
                                            <th>Trạng Thái</th>
                                            <th>Thời Gian Duyệt</th>
                                            <th>Hành Động</th>
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
                                                <td>{{ $item->user->name }}</td> <!-- Hiển thị tên người dùng -->
                                                <td>{{ $item->product->name }}</td> <!-- Hiển thị tên sản phẩm -->
                                                <td>
                                                    <div class="star-rating">
                                                        @php
                                                            $fullStars = floor($item->rating); // Số sao đầy đủ (1, 2, 3, 4, ...)
                                                            $halfStar = ($item->rating - $fullStars) >= 0.5 ? true : false; // Kiểm tra có nửa sao không
                                                        @endphp

                                                        <!-- Hiển thị sao đầy -->
                                                        @for ($i = 1; $i <= $fullStars; $i++)
                                                            <span class="fa fa-star" style="color: gold;"></span> <!-- Sao vàng đầy -->
                                                        @endfor

                                                        <!-- Hiển thị nửa sao nếu có -->
                                                        @if ($halfStar)
                                                            <span class="fa fa-star-half-alt" style="color: gold;"></span> <!-- Nửa sao vàng -->
                                                        @endif

                                                        <!-- Hiển thị sao trống cho các sao còn lại -->
                                                        @for ($i = $fullStars + ($halfStar ? 1 : 0); $i < 5; $i++)
                                                            <span class="fa fa-star" style="color: lightgray;"></span> <!-- Sao trống -->
                                                        @endfor
                                                    </div>
                                                </td> <!-- Hiển thị điểm đánh giá -->
                                                <td>{{ $item->review }}</td> <!-- Hiển thị nội dung đánh giá -->
                                                <td>{!! $item->status
                                                    ? '<span class="badge bg-primary">Đã duyệt</span>'
                                                    : '<span class="badge bg-danger">Chưa duyệt</span>' !!}</td>
                                                <td>
                                                    @if($item->approved_at)
                                                        {{ $item->approved_at->format('d/m/Y H:i') }}
                                                    @else
                                                        Chưa duyệt
                                                    @endif
                                                </td>
                                                <td>
                                                    {{-- <a href="{{ route('admin.reviews.edit', $review->id) }}"
                                                        class="btn btn-warning">Sửa</a> --}}
                                                        <form action="{{ route('admin.product-reviews.destroy', $item->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button onclick='return confirm("Bạn có chắc là muốn xóa không?")' type="submit"
                                                                class="btn btn-danger">Xóa</button>
                                                        </form>
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
