@extends('admin.layouts.master')

@section('title')
    Danh sách Đơn Hàng - Pizzato
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

    <style>
        .bg-warning {
            background-color: #ffc107 !important;
            color: #212529 !important;
        }

        .bg-warning:hover {
            background-color: #e0a800 !important;
            color: #ffffff !important;
            cursor: pointer;
        }

        .bg-primary {
            background-color: #007bff !important;
            color: #ffffff !important;
        }

        .bg-primary:hover {
            background-color: #0056b3 !important;
            color: #ffffff !important;
            cursor: pointer;
        }

        .bg-success {
            background-color: #28a745 !important;
            color: #ffffff !important;
        }

        .bg-success:hover {
            background-color: #218838 !important;
            color: #ffffff !important;
            cursor: pointer;
        }

        .bg-danger {
            background-color: #dc3545 !important;
            color: #ffffff !important;
        }

        .bg-danger:hover {
            background-color: #bd2130 !important;
            color: #ffffff !important;
            cursor: pointer;
        }
    </style>

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h5 class="card-title mb-0">Danh Mục Đơn Hàng</h5>
                                {{-- <a href="{{ route('admin.orders.create') }}" class="btn btn-success ms-auto">Thêm Mới</a> --}}
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
                                            <th>ID Hóa Đơn</th>
                                            <th>Khách Hàng</th>
                                            <th>Địa Chỉ</th>
                                            <th>Phí Vận Chuyển</th>
                                            <th>Tổng Tiền</th>
                                            <th>Trạng Thái Thanh Toán</th>
                                            <th>Ngày Đặt Hàng</th>
                                            <th>Trạng Thái đơn hàng</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $item => $order)
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input fs-15" type="checkbox"
                                                            name="checkAll" value="option1">
                                                    </div>
                                                </th>
                                                <td>{{ $order->invoice_id }}</td>
                                                <td>{{ $order->user_id }}</td>
                                                <td>{{ $order->address_id }}</td>
                                                <td>{{ $order->delivery_charge }}</td>
                                                <td>{{ $order->grand_total }}</td>
                                                <td>
                                                    @if ($order->payment_status === 'completed')
                                                        <span class="badge bg-success">Hoàn
                                                            thành</span>
                                                    @elseif($order->payment_status === 'pending')
                                                        <span class="badge bg-warning">Đang
                                                            chờ</span>
                                                    @elseif($order->payment_status === 'failed')
                                                        <span class="badge bg-danger">Thất
                                                            bại</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ $order->payment_status }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $order->created_at }}</td>

                                                <td>
                                                    {{-- Kiểm tra trạng thái đơn hàng --}}
                                                    @if ($order->order_status == 'canceled')
                                                        {{-- Nếu trạng thái là "canceled", chỉ hiển thị badge --}}
                                                        <span class="badge bg-danger text-dark">Đã Bị Hủy</span>
                                                    @else
                                                        {{-- Nếu trạng thái không phải "canceled", hiển thị dropdown select --}}
                                                        <form action="{{ route('admin.orders.update_status', $order) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            {{-- Dropdown cho các trạng thái khác --}}
                                                            <select class="form-select form-select-sm order-status-select"
                                                                name="order_status" {{-- Disable select nếu trạng thái là "completed" --}}
                                                                {{ $order->order_status == 'completed' ? 'disabled' : '' }}
                                                                onchange="this.className='form-select form-select-sm order-status-select ' + this.options[this.selectedIndex].className; this.form.submit();">

                                                                {{-- Hiển thị option "pending" nếu trạng thái không phải "processing" hoặc "completed" --}}
                                                                @if ($order->order_status != 'processing' && $order->order_status != 'completed')
                                                                    <option value="pending" class="bg-warning text-dark"
                                                                        {{ $order->order_status == 'pending' ? 'selected' : '' }}>
                                                                        Chờ Xác Nhận
                                                                    </option>
                                                                @endif

                                                                {{-- Hiển thị option "processing" nếu trạng thái không phải "completed" --}}
                                                                @if ($order->order_status != 'completed')
                                                                    <option value="processing" class="bg-primary text-white"
                                                                        {{ $order->order_status == 'processing' ? 'selected' : '' }}>
                                                                        Đang Giao
                                                                    </option>
                                                                @endif

                                                                {{-- Hiển thị option "completed" nếu trạng thái không phải "canceled" hoặc "processing" --}}
                                                                @if ($order->order_status != 'canceled')
                                                                    <option value="completed" class="bg-success text-white"
                                                                        {{ $order->order_status == 'completed' ? 'selected' : '' }}>
                                                                        Hoàn Thành
                                                                    </option>
                                                                @endif
                                                            </select>
                                                        </form>
                                                    @endif
                                                </td>

                                                <td>
                                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                                        class="btn btn-info"><i class="fa fa-info-circle"></i></a>

                                                    @if (!in_array($order->order_status, ['canceled', 'processing', 'completed']))
                                                        {{-- <a href="{{ route('admin.orders.edit', $order) }}"
                                                            class="btn btn-warning"><i class="fa fa-edit"></i></a> --}}

                                                        {{-- Form hủy đơn hàng --}}
                                                        <form action="{{ route('admin.orders.cancel', $order) }}"
                                                            method="POST" style="display: inline;"
                                                            onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-danger"> <i
                                                                    class="fas fa-times-circle"></i></button>
                                                        </form>
                                                    @elseif (in_array($order->order_status, ['canceled']))
                                                        <button class="btn btn-warning notify-btn"
                                                            data-id="{{ $order->id }}"
                                                            data-invoice="{{ $order->invoice_id }}">
                                                            <i class="fa-regular fa-bell fa-lg"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{-- popup thông báo --}}
                                <div class="modal fade" id="notifyModal" tabindex="-1" aria-labelledby="notifyModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="notifyModalLabel">Thông báo
                                                    đơn hàng</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="notifyForm" class="needs-validation"
                                                    action="{{ route('admin.notify.order') }}" method="POST" novalidate>
                                                    @csrf
                                                    <input type="hidden" id="order_id" name="order_id">
                                                    <input type="hidden" id="invoice_id" name="invoice_id">

                                                    <!-- Nội dung thông báo -->
                                                    <div class="mb-3">
                                                        <label for="message" class="form-label">Nội dung
                                                            thông báo</label>
                                                        <select class="form-control" id="message-select" name="message"
                                                            required>
                                                            <option value="" disabled selected>Chọn
                                                                nội dung thông báo</option>
                                                            <option value="Đơn hàng chưa được thanh toán">
                                                                Đơn hàng chưa được thanh toán</option>
                                                            <option value="Đơn hàng đã bị trễ">Đơn hàng đã
                                                                bị trễ</option>
                                                            <option value="Hãy kiểm tra lại thông tin">Hãy
                                                                kiểm tra lại thông tin</option>
                                                            <option value="Khác">Khác</option>
                                                        </select>
                                                        <textarea class="form-control mt-2 d-none" id="message-input" name="message_custom" rows="3"
                                                            placeholder="Nhập nội dung thông báo"></textarea>
                                                        <div class="invalid-feedback">Hãy nhập lý do</div>
                                                    </div>

                                                    <!-- Cách giải quyết -->
                                                    <div class="mb-3">
                                                        <label for="solution" class="form-label">Cách giải
                                                            quyết</label>
                                                        <select class="form-control" id="solution-select" name="solution"
                                                            required>
                                                            <option value="" disabled selected>Chọn
                                                                cách giải quyết</option>
                                                            <option value="Liên hệ khách hàng">Liên hệ
                                                                khách hàng</option>
                                                            <option value="Hủy đơn hàng">Hủy đơn hàng
                                                            </option>
                                                            <option value="Giao hàng ngay">Giao hàng ngay
                                                            </option>
                                                            <option value="Khác">Khác</option>
                                                        </select>
                                                        <textarea type="text" class="form-control mt-2 d-none" id="solution-input" name="solution_custom"
                                                            placeholder="Nhập hoặc chỉnh sửa cách giải quyết"></textarea>
                                                        <div class="invalid-feedback">Hãy nhập cách giải
                                                            quyết</div>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">Gửi
                                                        thông báo</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.order-status-select').forEach(function(select) {
            const selectedOption = select.options[select.selectedIndex];
            select.className = 'form-select form-select-sm order-status-select ' + selectedOption.className;
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

@section('script')
    <script>
        // THông báo order quá hạn
        $(document).ready(function() {
            // Khi thay đổi chọn nội dung thông báo
            $('#message-select').on('change', function() {
                var selected = $(this).val();
                if (selected === 'Khác') {
                    $('#message-input').removeClass('d-none').attr('required', true);
                } else {
                    $('#message-input').addClass('d-none').removeAttr('required');
                }
            });
            // Khi thay đổi chọn cách giải quyết
            $('#solution-select').on('change', function() {
                var selected = $(this).val();
                if (selected === 'Khác') {
                    $('#solution-input').removeClass('d-none').attr('required', true);
                } else {
                    $('#solution-input').addClass('d-none').removeAttr('required');
                }
            });

            // Khi nhấn nút Thông báo
            $(document).on('click', '.notify-btn', function() {
                var orderId = $(this).data('id');
                var invoiceId = $(this).data('invoice');

                // Gán giá trị vào các trường ẩn
                $('#order_id').val(orderId);
                $('#invoice_id').val(invoiceId);

                // Hiển thị modal
                $('#notifyModal').modal('show');
            });
        });

        // Tuỳ chỉnh textarea
        $(document).ready(function() {
            const solutions = {
                "Liên hệ khách hàng": "Liên hệ với khách hàng để xác nhận đơn hàng và xử lý các vấn đề phát sinh.",
                "Hủy đơn hàng": "Hủy đơn hàng trong hệ thống và thông báo cho khách hàng qua email hoặc SMS.",
                "Giao hàng ngay": "Chuẩn bị đơn hàng và giao ngay trong vòng 1 giờ để đảm bảo thời gian giao hàng đúng hạn.",
                "Khác": ""
            };

            // Khi thay đổi chọn cách giải quyết
            $('#solution-select').on('change', function() {
                const selected = $(this).val();

                if (selected === "Khác") {
                    $('#solution-input')
                        .removeClass('d-none')
                        .val("")
                        .attr('placeholder', 'Nhập cách giải quyết');
                } else {
                    const solutionText = solutions[selected];
                    $('#solution-input')
                        .removeClass('d-none')
                        .val(solutionText) // Điền nội dung mặc định
                        .removeAttr('placeholder');
                }
            });

            // Cập nhật khi sửa văn bản trong textarea
            $('#solution-input').on('input', function() {
                const selectedSolution = $('#solution-select').val();
                const customSolution = $(this).val();

                // Cập nhật lại giải pháp nếu người dùng sửa nội dung trong textarea
                if (selectedSolution === "Khác") {
                    solutions[selectedSolution] = customSolution; // Lưu nội dung sửa đổi
                } else {
                    // Lưu lại nội dung sửa đổi vào solutions đối với các lựa chọn khác
                    solutions[selectedSolution] = customSolution;
                }
            });

            // Khi submit form, đảm bảo giá trị được gửi đúng
            $('#notifyForm').on('submit', function() {
                const selectedSolution = $('#solution-select').val();
                const customSolution = $('#solution-input').val();

                // Nếu chọn "Khác", lấy giá trị sửa trong textarea
                if (selectedSolution === "Khác") {
                    $('#solution-input').val(customSolution); // Đảm bảo lấy giá trị sửa đổi
                } else {
                    // Nếu chọn giải pháp khác, đảm bảo giữ nguyên giá trị đã chọn
                    $('#solution-input').val(solutions[selectedSolution]);
                }
            });
        });


        // validate form order notify
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('notifyForm');
            const messageSelect = document.getElementById('message-select');
            const messageInput = document.getElementById('message-input');
            const solutionSelect = document.getElementById('solution-select');
            const solutionInput = document.getElementById('solution-input');

            // Hiển thị các input tùy chỉnh khi chọn "Khác"
            messageSelect.addEventListener('change', function() {
                if (messageSelect.value === 'Khác') {
                    messageInput.classList.remove('d-none');
                    messageInput.required = true;
                } else {
                    messageInput.classList.add('d-none');
                    messageInput.required = false;
                }
            });

            solutionSelect.addEventListener('change', function() {
                if (solutionSelect.value === 'Khác') {
                    solutionInput.classList.remove('d-none');
                    solutionInput.required = true;
                } else {
                    solutionInput.classList.add('d-none');
                    solutionInput.required = false;
                }
            });

            // Xử lý submit form
            form.addEventListener('submit', function(event) {
                // Nếu form không hợp lệ, ngăn chặn gửi form
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                // Thêm class 'was-validated' để kích hoạt hiển thị lỗi
                form.classList.add('was-validated');
            });
        });
    </script>
@endsection
