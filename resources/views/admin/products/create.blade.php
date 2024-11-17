@extends('admin.layouts.master')

@section('title')
    Thêm Mới Sản Phẩm - Pizzato
@endsection

@section('content')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
          

<<<<<<< Updated upstream
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Thêm Mới Sản Phẩm</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{ route('admin.products.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Tên sản phẩm</label>
                                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                                        value="{{ old('name') }}" placeholder="Tên sản phẩm">
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
=======
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
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
>>>>>>> Stashed changes

                                                <div id="accor_plusExamplecollapse1"
                                                    class="accordion-collapse collapse show"
                                                    aria-labelledby="accordionwithplusExample1"
                                                    data-bs-parent="#accordionWithplusicon">
                                                    <div class="accordion-body">

<<<<<<< Updated upstream
                                                <div class="mt-3">
                                                    <label for="thumb_image" class="form-label">Hình ảnh</label>
                                                    <input type="file" class="form-control" id="thumb_image"
                                                        name="thumb_image">
                                                    @error('thumb_image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Sku</label>
                                                    <input type="text" name="sku" class="form-control"
                                                        value="{{ old('sku', $sku) }}" readonly>
                                                    @error('sku')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="category_id" class="form-label">Danh mục</label>
                                                    <select type="text" class="form-select" id="category_id"
                                                        name="category_id">
                                                        @foreach ($categories as $id => $name)
                                                            <option value="{{ $id }}">{{ $name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>View</label>
                                                    <input type="text" name="view" class="form-control"
                                                        value="{{ old('view') }}" disabled placeholder="0">
                                                    @error('view')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
=======
                                                        <div class="card-body">
                                                            <div class="basic-form">
>>>>>>> Stashed changes


                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Name</label>
                                                                            <input type="text" name="name"
                                                                                class="form-control"
                                                                                value="{{ old('name') }}">
                                                                            @error('name')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>

<<<<<<< Updated upstream
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Giá</label>
                                                    <input type="text" name="price" class="form-control @error('price') is-invalid @enderror"
                                                        value="{{ old('price') }}" placeholder="Nhập giá">
                                                    @error('price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Giá khuyến mãi</label>
                                                    <input type="text" name="offer_price" class="form-control @error('offer_price') is-invalid @enderror"
                                                        value="{{ old('offer_price') }}" placeholder="Nhập giá khuyến mãi">
                                                    @error('offer_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Số lượng</label>
                                                    <input type="text" name="qty" class="form-control @error('qty') is-invalid @enderror"
                                                        value="{{ old('qty') }}" placeholder="Nhập số lượng">
                                                    @error('qty')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
=======
                                                                        <div class="form-group">
                                                                            <label>Slug</label>
                                                                            <input type="text" name="slug"
                                                                                class="form-control"
                                                                                value="{{ old('slug', isset($product) ? $product->slug : $slug) }}"
                                                                                readonly>
                                                                        </div>

                                                                        <div class="mt-3">
                                                                            <label for="thumb_image"
                                                                                class="form-label">Image</label>
                                                                            <input type="file" class="form-control"
                                                                                id="thumb_image" name="thumb_image">
                                                                            @error('thumb_image')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label>Sku</label>
                                                                            <input type="text" name="sku"
                                                                                class="form-control"
                                                                                value="{{ old('sku', $sku) }}" readonly>
                                                                            @error('sku')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
>>>>>>> Stashed changes

                                                                        <div class="form-group">
                                                                            <label for="category_id"
                                                                                class="form-label">Catalogue</label>
                                                                            <select type="text" class="form-select"
                                                                                id="category_id" name="category_id">
                                                                                @foreach ($categories as $id => $name)
                                                                                    <option value="{{ $id }}">
                                                                                        {{ $name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('category_id')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>

<<<<<<< Updated upstream
                                                <div class="form-group">
                                                    <label>Trạng thái</label>
                                                    <select name="status" class="form-control" id="">
                                                        <option value="1">Còn hàng</option>
                                                        <option value="0">Hết hàng</option>
                                                    </select>
                                                    @error('status')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Mô tả ngắn</label>
                                                    <textarea name="short_description" class="form-control" id="">{{ old('short_description') }}</textarea>
                                                    @error('short_description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Mô tả dài</label>
                                                    <textarea name="long_description" class="form-control summernote" id="">{{ old('long_description') }}</textarea>
                                                    @error('long_description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
=======
                                                                        <div class="form-group">
                                                                            <label>View</label>
                                                                            <input type="text" name="view"
                                                                                class="form-control"
                                                                                value="{{ old('view') }}" disabled
                                                                                placeholder="0">
                                                                            @error('view')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>


                                                                    </div>

                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Price</label>
                                                                            <input type="text" name="price"
                                                                                class="form-control"
                                                                                value="{{ old('price') }}">
                                                                            @error('price')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label>Offer Price</label>
                                                                            <input type="text" name="offer_price"
                                                                                class="form-control"
                                                                                value="{{ old('offer_price') }}">
                                                                            @error('offer_price')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label>Quantity</label>
                                                                            <input type="text" name="qty"
                                                                                class="form-control"
                                                                                value="{{ old('qty') }}">
                                                                            @error('qty')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label>Show at Home</label>
                                                                            <select name="show_at_home"
                                                                                class="form-control" id="">
                                                                                <option value="1">Yes</option>
                                                                                <option selected value="0">No</option>
                                                                            </select>
                                                                            @error('show_at_home')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label>Status</label>
                                                                            <select name="status" class="form-control"
                                                                                id="">
                                                                                <option value="1">Active</option>
                                                                                <option value="0">Inactive</option>
                                                                            </select>
                                                                            @error('status')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label>Short Description</label>
                                                                            <textarea name="short_description" class="form-control" id="">{{ old('short_description') }}</textarea>
                                                                            @error('short_description')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label>Long Description</label>
                                                                            <textarea name="long_description" class="form-control summernote" id="">{{ old('long_description') }}</textarea>
                                                                            @error('long_description')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <a href="{{ route('admin.products.index') }}"
                                                                    class="btn btn-secondary">
                                                                    Quay Lại</a>
                                                                <button type="submit" class="btn btn-success">Thêm
                                                                    Mới</button>
                                                            </div>
                                                        </div>
                                                    </div>
>>>>>>> Stashed changes
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="accordion custom-accordionwithicon-plus" id="accordionWithplusicon">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="accordionwithplusExample2">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#accor_plusExamplecollapse2" aria-expanded="true"
                                                        aria-controls="accor_plusExamplecollapse2">
                                                        Biến Thể Sản Phẩm
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
                                                                                    type="checkbox" id="checkAll">
                                                                            </div>
                                                                        </th>
                                                                        <th>ID</th>
                                                                        <th>Image</th>
                                                                        <th>Name</th>
                                                                        <th>Category</th>
                                                                        <th>Price</th>
                                                                        <th>Offer Price</th>
                                                                        <th>Quantity in Stock</th>
                                                                        <th>Quantity</th> <!-- Cột nhập số lượng cần mua -->
                                                                        <th>Show At Home</th>
                                                                        <th>Status</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <th scope="row">
                                                                            <div class="form-check">
                                                                                <input
                                                                                    class="form-check-input fs-15 product-checkbox"
                                                                                    type="checkbox" name="products[]"
                                                                                    value="test">
                                                                            </div>
                                                                        </th>
                                                                        <td>test</td>
                                                                        <td>

                                                                            <img src="test" alt=""
                                                                                width="100px">
                                                                        </td>
                                                                        <td>test</td>
                                                                        <td>test</td>
                                                                        <td>test</td>
                                                                        <td>test</td>
                                                                        <td>test</td>
                                                                        <td>
                                                                            <input type="number"
                                                                                class="form-control product-quantity"
                                                                                name="quantities[test]" min="1"
                                                                                max=test" value="1" data-stock="test"
                                                                                disabled>
                                                                        </td>
                                                                        <td>test</td>
                                                                        <td>test</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
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
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nameInput = document.querySelector('input[name="name"]');
            const slugInput = document.querySelector('input[name="slug"]');

            nameInput.addEventListener('input', function() {
                slugInput.value = nameInput.value
                    .toLowerCase()
                    .trim()
                    .replace(/[\s]+/g, '-') // Thay thế khoảng trắng bằng dấu -
                    .replace(/[^\w\-]+/g, '') // Xóa ký tự không phải chữ, số hoặc dấu -
                    .replace(/\-\-+/g, '-') // Xóa dấu gạch nối kép
                    .replace(/^-+/, '') // Xóa dấu gạch nối đầu
                    .replace(/-+$/, ''); // Xóa dấu gạch nối
            });
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
