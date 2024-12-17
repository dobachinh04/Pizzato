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
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
            {{ Session::get('error') }}
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
                                <table id="example"
                                    class="table table-bordered dt-responsive nowrap table-striped align-middle"
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
                                                                name="refund_status"
                                                                {{ in_array($refund->refund_status, ['approved', 'rejected']) ? 'disabled' : '' }}
                                                                onchange="this.className='form-select form-select-sm refund-status-select ' + this.options[this.selectedIndex].className; this.form.submit();">
                                                                <option value="pending" class="bg-warning text-dark"
                                                                    {{ $refund->refund_status == 'pending' ? 'selected' : '' }}>
                                                                    Chờ Xác Nhận
                                                                </option>
                                                                <option value="approved" class="bg-success text-white"
                                                                    {{ $refund->refund_status == 'approved' ? 'selected' : '' }}>
                                                                    Đã Duyệt
                                                                </option>
                                                                <option value="rejected" class="bg-danger text-white"
                                                                    {{ $refund->refund_status == 'rejected' ? 'selected' : '' }}>
                                                                    Bị Từ Chối
                                                                </option>
                                                            </select>
                                                        </form>
                                                    @endif
                                                </td>

                                                <td>
                                                    <a href="{{ route('admin.refunds.edit', $refund->id) }}"
                                                        class="btn btn-info"><i class="fa fa-info-circle"></i></a>

                                                    @if (!in_array($refund->order_status, ['canceled', 'processing', 'completed']))
                                                        {{-- <a href="{{ route('admin.orders.edit', $refund) }}"
                                                            class="btn btn-warning"><i class="fa fa-edit"></i></a> --}}

                                                        {{-- Form hủy đơn hàng --}}
                                                        <form action="{{ route('admin.orders.cancel', $refund) }}"
                                                            method="POST" style="display: inline;"
                                                            onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-danger"> <i
                                                                    class="fas fa-times-circle"></i></button>
                                                        </form>
                                                    @elseif (in_array($refund->order_status, ['canceled']))
                                                        <button class="btn btn-warning notify-btn"
                                                            data-id="{{ $refund->id }}"
                                                            data-invoice="{{ $refund->id }}">
                                                            <i class="fa-regular fa-bell fa-lg"></i>
                                                        </button>
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

    <script>
        document.querySelectorAll('.refund-status-select').forEach(function(select) {
            const selectedOption = select.options[select.selectedIndex];
            select.className = 'form-select form-select-sm refund-status-select ' + selectedOption.className;
        });
    </script>

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
