@extends('admin.layouts.master')

@section('title')
    Thêm Mới Đơn Hàng - Pizzato
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
            <strong>Success!</strong> {{ Session::get('success') }}.
        </div>
    @endif
    <form action="{{ route('admin.orders.create') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="main-content">
            <div class="page-content mb-0 pb-0">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12 col-xxl-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title m-0 p-0">Thêm Mới Đơn Hàng</h4>
                                    <div>
                                        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                                            Quay Lại
                                        </a>
                                        <button type="submit" class="btn btn-success">Thêm Mới</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-content">
            <div class="page-content my-0 py-0">
                <div class="container-fluid">
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
                            <div class="card">

                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="accordion custom-accordionwithicon-plus" id="accordionWithplusicon">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="accordionwithplusExample1">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#accor_plusExamplecollapse1" aria-expanded="true"
                                                        aria-controls="accor_plusExamplecollapse1">
                                                        Thông Tin Cơ Bản
                                                    </button>
                                                </h2>

                                                <div id="accor_plusExamplecollapse1"
                                                    class="accordion-collapse collapse show"
                                                    aria-labelledby="accordionwithplusExample1"
                                                    data-bs-parent="#accordionWithplusicon">
                                                    <div class="accordion-body">

                                                        <div class="basic-form">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <h3>Thông Tin Đơn Hàng</h3>

                                                                    <div class="form-group">
                                                                        <label for="basiInput" class="form-label">Khách
                                                                            Hàng</label>
                                                                        <select
                                                                            class="form-control mb-3 @error('user_id') is-invalid @enderror"
                                                                            name="user_id" value="{{ old('user_id') }}">
                                                                            <option selected disabled>Nhấn để chọn</option>

                                                                        </select>
                                                                        @error('user_id')
                                                                            <p>{{ $message }}</p>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group mb-3">
                                                                        <label>Địa Chỉ</label>
                                                                        <input type="text" name="address"
                                                                            class="form-control"
                                                                            value="{{ old('address') }}">
                                                                        @error('address')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group mb-3">
                                                                        <label>Mã Giảm Giá</label>
                                                                        <input type="text" name="coupon_info"
                                                                            class="form-control"
                                                                            value="{{ old('coupon_info') }}">
                                                                        @error('coupon_info')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group mb-3">
                                                                        <label>Số Tiền Được Giảm Giá</label>
                                                                        <input type="text" name="discount"
                                                                            class="form-control"
                                                                            value="{{ old('discount') }}">
                                                                        @error('discount')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="basiInput" class="form-label">Phương
                                                                            Thức Vận Chuyển</label>
                                                                        <select
                                                                            class="form-control mb-3 @error('delivery_charge') is-invalid @enderror"
                                                                            name="delivery_charge"
                                                                            value="{{ old('delivery_charge') }}">
                                                                            <option selected disabled>Nhấn để chọn</option>

                                                                        </select>
                                                                        @error('delivery_charge')
                                                                            <p>{{ $message }}</p>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group mb-3">
                                                                        <label>Đặt Ngày</label>
                                                                        <input type="date" name="created_at"
                                                                            class="form-control"
                                                                            value="{{ old('created_at') }}">
                                                                        @error('created_at')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-6">
                                                                    <h3>Thông Tin Thanh Toán</h3>

                                                                    <div class="form-group">
                                                                        <label for="basiInput" class="form-label">Phương
                                                                            Thức Thanh Toán</label>
                                                                        <select
                                                                            class="form-control mb-3 @error('payment_method') is-invalid @enderror"
                                                                            name="payment_method"
                                                                            value="{{ old('payment_method') }}">
                                                                            <option selected disabled>Nhấn để chọn</option>

                                                                        </select>
                                                                        @error('payment_method')
                                                                            <p>{{ $message }}</p>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="basiInput" class="form-label">Đơn Vị
                                                                            Tiền Tệ</label>
                                                                        <select disabled
                                                                            class="form-control mb-3 @error('currency_name') is-invalid @enderror"
                                                                            name="currency_name"
                                                                            value="{{ old('currency_name') }}">
                                                                            <option selected disabled value="VND">VND
                                                                            </option>
                                                                        </select>
                                                                        @error('currency_name')
                                                                            <p>{{ $message }}</p>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="basiInput" class="form-label">Trạng
                                                                            Thái Thanh Toán</label>
                                                                        <select
                                                                            class="form-control mb-3 @error('payment_status') is-invalid @enderror"
                                                                            name="payment_status"
                                                                            value="{{ old('payment_status') }}">
                                                                            <option selected disabled>Nhấn để chọn</option>

                                                                        </select>
                                                                        @error('payment_status')
                                                                            <p>{{ $message }}</p>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="basiInput" class="form-label">Trạng
                                                                            Thái Giao Hàng</label>
                                                                        <select
                                                                            class="form-control mb-3 @error('order_status') is-invalid @enderror"
                                                                            name="order_status"
                                                                            value="{{ old('order_status') }}">
                                                                            <option selected disabled>Nhấn để chọn</option>

                                                                        </select>
                                                                        @error('order_status')
                                                                            <p>{{ $message }}</p>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group mb-3">
                                                                        <label>Ngày Thanh Toán</label>
                                                                        <input type="date" name="payment_approve_date"
                                                                            class="form-control"
                                                                            value="{{ old('payment_approve_date') }}">
                                                                        @error('payment_approve_date')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Accordions with Plus Icon</h4>
                                </div><!-- end card header --> --}}
                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="accordion custom-accordionwithicon-plus" id="accordionWithplusicon">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="accordionwithplusExample2">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#accor_plusExamplecollapse2" aria-expanded="true"
                                                        aria-controls="accor_plusExamplecollapse2">
                                                        Thông Tin Sản Phẩm
                                                    </button>
                                                </h2>

                                                <div id="accor_plusExamplecollapse2"
                                                    class="accordion-collapse collapse show"
                                                    aria-labelledby="accordionwithplusExample2"
                                                    data-bs-parent="#accordionWithplusicon">
                                                    <div class="accordion-body">
                                                        <div class="basic-form">
                                                            <h3>Thông Tin Sản Phẩm</h3>
                                                            <table id="example"
                                                                class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                                                style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col" style="width: 10px;">
                                                                            <div class="form-check">
                                                                                <input class="form-check-input fs-15"
                                                                                    type="checkbox" id="checkAll"
                                                                                    value="option">
                                                                            </div>
                                                                        </th>
                                                                        {{-- <th data-ordering="false">SR No.</th> --}}
                                                                        <th>ID</th>
                                                                        <th>Image</th>
                                                                        <th>Name</th>
                                                                        <th>Category</th>
                                                                        <th>Price</th>
                                                                        <th>Offer Price</th>
                                                                        <th>Quantity</th>
                                                                        <th>Show At Home</th>
                                                                        <th>Status</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($data as $item)
                                                                        <tr>
                                                                            <th scope="row">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input fs-15"
                                                                                        type="checkbox" name="checkAll"
                                                                                        value="option1">
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
                                                                                <img src="{{ $url }}"
                                                                                    alt="" width="100px">
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
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>

                                                            <hr>
                                                            <h5 class="my-1">Tổng Tiền Gốc: </h5>
                                                            <h5 class="my-1">Số Tiền Được Giảm: </h5>
                                                            <h2 class="m-0">Tổng tiền: </h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

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
