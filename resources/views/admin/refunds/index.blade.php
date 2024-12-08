@extends('admin.layouts.master')

@section('title')
    Yêu Cầu Hoàn Tiền - Pizzato
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
                                <h5 class="card-title mb-0">Danh Sách Yêu Cầu Hoàn Tiền</h5>
                            </div>

                            <div class="card-body">
                                <table class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Mã Hóa Đơn</th>
                                            <th>Tên Khách Hàng</th>
                                            <th>Email</th>
                                            <th>Số Tiền</th>
                                            <th>Trạng Thái</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($refunds as $refund)
                                            <tr>
                                                <td>{{ $refund->id }}</td>
                                                <td>{{ $refund->invoice_id }}</td>
                                                <td>{{ $refund->name }}</td>
                                                <td>{{ $refund->email }}</td>
                                                <td>{{ number_format($refund->refund_amount, 0, ',', '.') }}₫</td>
                                                <td>
                                                    @if ($refund->status === 'pending')
                                                        <span class="badge bg-warning">Chờ Xác Nhận</span>
                                                    @elseif($refund->status === 'approved')
                                                        <span class="badge bg-success">Đã Duyệt</span>
                                                    @elseif($refund->status === 'rejected')
                                                        <span class="badge bg-danger">Bị Từ Chối</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ $refund->status }}</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($refund->refund_status == 'rejected')
                                                        {{-- Nếu trạng thái là "rejected", chỉ hiển thị badge --}}
                                                        <span class="badge bg-danger text-dark">Bị Từ Chối</span>
                                                    @else
                                                        {{-- Nếu trạng thái không phải "rejected", hiển thị dropdown select --}}
                                                        <form action="{{ route('admin.refunds.update_status', $refund) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            {{-- Dropdown cho các trạng thái khác --}}
                                                            <select class="form-select form-select-sm refund-status-select"
                                                                name="refund_status" {{-- Disable select nếu trạng thái là "approved" hoặc "rejected" --}}
                                                                {{ in_array($refund->refund_status, ['approved', 'rejected']) ? 'disabled' : '' }}
                                                                onchange="this.className='form-select form-select-sm refund-status-select ' + this.options[this.selectedIndex].className; this.form.submit();">

                                                                {{-- Hiển thị option "pending" nếu trạng thái không phải "processing" hoặc "approved" --}}
                                                                @if ($refund->refund_status != 'approved')
                                                                    <option value="pending" class="bg-warning text-dark"
                                                                        {{ $refund->refund_status == 'pending' ? 'selected' : '' }}>
                                                                        Chờ Xác Nhận
                                                                    </option>
                                                                @endif

                                                                {{-- Hiển thị option "approved" nếu trạng thái không phải "rejected" --}}
                                                                @if ($refund->refund_status != 'rejected')
                                                                    <option value="approved" class="bg-success text-white"
                                                                        {{ $refund->refund_status == 'approved' ? 'selected' : '' }}>
                                                                        Đã Duyệt
                                                                    </option>
                                                                @endif
                                                            </select>
                                                        </form>
                                                    @endif
                                                </td>

                                                <td>
                                                    <a class="btn btn-info"
                                                        href="{{ route('admin.refunds.edit', $refund->id) }}">Chi Tiết</a>
                                                    <form action="{{ route('admin.refunds.destroy', $refund->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa yêu cầu hoàn tiền này?');"
                                                            type="submit" class="btn btn-danger">Hủy Yêu Cầu</button>
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
