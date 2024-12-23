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
                                                        Form Thêm Mới Sản Phẩm
                                                    </button>
                                                </h2>

                                                <div id="accor_plusExamplecollapse1"
                                                    class="accordion-collapse collapse show"
                                                    aria-labelledby="accordionwithplusExample1"
                                                    data-bs-parent="#accordionWithplusicon">
                                                    <div class="accordion-body">
                                                        <div class="card-body">
                                                            <div class="basic-form">
                                                                <div class="row">
                                                                    <h3>Thông Tin Sản Phẩm</h3>

                                                                    @if ($errors->any())
                                                                        <div class="alert alert-danger">
                                                                            <ul>
                                                                                @foreach ($errors->all() as $error)
                                                                                    <li>{{ $error }}</li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    @endif

                                                                    <div class="col-6">
                                                                        <div class="form-group mt-3">
                                                                            <label>Name</label>
                                                                            <input type="text" name="name"
                                                                                class="form-control @error('name') is-invalid @enderror"
                                                                                value="{{ old('name') }}">
                                                                            @error('name')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="form-group mt-3">
                                                                            <label>Slug</label>
                                                                            <div class="input-group">
                                                                                <input type="text" name="slug"
                                                                                    class="form-control @error('slug') is-invalid @enderror"
                                                                                    value="{{ old('slug', isset($product) ? $product->slug : $slug) }}">
                                                                                <button type="button" id="generate-slug"
                                                                                    class="btn btn-secondary">Tạo
                                                                                    slug</button>
                                                                            </div>
                                                                            @error('slug')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>

                                                                        {{-- <div class="form-group mt-3">
                                                                            <label>Sku</label>
                                                                            <input type="text" name="sku"
                                                                                class="form-control"
                                                                                value="{{ old('sku', $sku) }}" readonly>
                                                                            @error('sku')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div> --}}
                                                                        <div class="form-group">
                                                                            <label>Mã sản phẩm</label>
                                                                            <div class="input-group">
                                                                                <input type="text" id="sku"
                                                                                    name="sku"
                                                                                    class="form-control @error('sku') is-invalid @enderror"
                                                                                    value="{{ old('sku') }}"
                                                                                    placeholder="Nhập mã sản phẩm">
                                                                                <button type="button" id="generate-sku"
                                                                                    class="btn btn-secondary">Ngẫu
                                                                                    nhiên</button>
                                                                            </div>
                                                                            @error('sku')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="form-group mt-3">
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

                                                                        <div class="form-group mt-3">
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

                                                                        <div class="form-group mt-3">
                                                                            <label for="thumb_image" class="form-label">Ảnh
                                                                                Chính</label>
                                                                            <input type="file" class="form-control"
                                                                                id="thumb_image" name="thumb_image">
                                                                            @error('thumb_image')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="form-group mt-3">
                                                                            <label for="galleries" class="form-label">Các
                                                                                Ảnh Phụ</label>
                                                                            <input type="file" class="form-control"
                                                                                id="galleries" name="galleries[]" multiple>
                                                                            @error('galleries.*')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <div class="form-group mt-3">
                                                                            <label>Giá sản phẩm</label>
                                                                            <input type="number" name="price"
                                                                                class="form-control @error('price') is-invalid @enderror"
                                                                                value="{{ old('price') }}">
                                                                            @error('price')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="form-group mt-3">
                                                                            <label>Offer Price</label>
                                                                            <input type="number" name="offer_price"
                                                                                class="form-control"
                                                                                value="{{ old('offer_price') }}">
                                                                            @error('offer_price')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="form-group mt-3">
                                                                            <label>Số lượng</label>
                                                                            <input type="text" name="qty"
                                                                                class="form-control @error('qty') is-invalid @enderror"
                                                                                value="{{ old('qty') }}">
                                                                            @error('qty')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="form-group mt-3">
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

                                                                        <div class="form-group mt-3">
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

                                                                        <div class="form-group mt-3">
                                                                            <label>Short Description</label>
                                                                            <textarea name="short_description" class="form-control" id="">{{ old('short_description') }}</textarea>
                                                                            @error('short_description')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="form-group mt-3">
                                                                            <label>Long Description</label>
                                                                            <textarea name="long_description" class="form-control summernote" id="">{{ old('long_description') }}</textarea>
                                                                            @error('long_description')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <hr>

                                                                <div class="row" id="variantFields"
                                                                    style="display: none;">
                                                                    <h3>Biến Thể Sản Phẩm</h3>

                                                                    <!-- Size Bánh -->
                                                                    {{-- <div class="col-12">
                                                                        <div class="form-group mt-3">
                                                                            <div class="form-check form-switch form-switch-lg"
                                                                                dir="ltr">
                                                                                <input type="checkbox"
                                                                                    class="form-check-input toggle-input"
                                                                                    id="toggleSize">
                                                                                <label class="form-check-label"
                                                                                    for="toggleSize">Size Bánh</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row" id="sizeFieldsContainer"
                                                                            style="display: none;">
                                                                            <div class="col-6">
                                                                                <div class="form-group toggle-target"
                                                                                    id="inputSizeFields">
                                                                                    <label class="mt-3">Tên Size
                                                                                        Bánh</label>
                                                                                    <input type="text"
                                                                                        name="size_name[]"
                                                                                        class="form-control"
                                                                                        value="{{ old('size_name') }}">
                                                                                    @error('size_name')
                                                                                        <span
                                                                                            class="text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <div class="form-group toggle-target"
                                                                                    id="inputSizePrice">
                                                                                    <label class="mt-3">Giá Tiền</label>
                                                                                    <div class="input-group">
                                                                                        <span
                                                                                            class="input-group-text">VNĐ</span>
                                                                                        <input type="text"
                                                                                            name="size_price[]"
                                                                                            class="form-control"
                                                                                            value="{{ old('size_price') }}">
                                                                                        <span
                                                                                            class="input-group-text">.000</span>
                                                                                    </div>
                                                                                    @error('size_price')
                                                                                        <span
                                                                                            class="text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <button type="button" id="addSizeFields"
                                                                            class="btn btn-info mt-3"
                                                                            style="display: none;">Thêm Giá Trị</button>
                                                                    </div> --}}

                                                                    <div class="col-4">
                                                                        <div class="form-group mt-3">
                                                                            <div class="form-check form-switch form-switch-lg"
                                                                                dir="ltr">
                                                                                <input type="checkbox"
                                                                                    class="form-check-input toggle-input"
                                                                                    id="toggleSize">
                                                                                <label class="form-check-label"
                                                                                    for="toggleSize">Size Bánh</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group toggle-target"
                                                                            id="inputSizeFields" style="display: none;">
                                                                            <select class="form-select mt-3" multiple
                                                                                aria-label="multiple select example"
                                                                                name="sizes[]" id="sizeSelect">
                                                                                @foreach ($sizes as $size)
                                                                                    <option value="{{ $size->id }}">
                                                                                        {{ $size->name }} -
                                                                                        {{ number_format($size->price, 0, ',', '.') }}
                                                                                        VND
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>



                                                                    <div class="col-4">
                                                                        <div class="form-group mt-3">
                                                                            <div class="form-check form-switch form-switch-lg"
                                                                                dir="ltr">
                                                                                <input type="checkbox"
                                                                                    class="form-check-input toggle-input"
                                                                                    id="toggleEdge">
                                                                                <label class="form-check-label"
                                                                                    for="toggleEdge">Viền Bánh</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group toggle-target"
                                                                            id="inputEdgeFields" style="display: none;">
                                                                            <select class="form-select mt-3" multiple
                                                                                aria-label="multiple select example"
                                                                                name="edges[]">
                                                                                @foreach ($edges as $edge)
                                                                                    <option value="{{ $edge->id }}">
                                                                                        {{ $edge->name }} -
                                                                                        {{ number_format($edge->price, 0, ',', '.') }}
                                                                                        VND
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-4">
                                                                        <div class="form-group mt-3">
                                                                            <div class="form-check form-switch form-switch-lg"
                                                                                dir="ltr">
                                                                                <input type="checkbox"
                                                                                    class="form-check-input toggle-input"
                                                                                    id="toggleBase">
                                                                                <label class="form-check-label"
                                                                                    for="toggleBase">Đế Bánh</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group mt-3 toggle-target"
                                                                            id="inputBaseFields" style="display: none;">
                                                                            <select class="form-select mt-3" multiple
                                                                                aria-label="multiple select example"
                                                                                name="bases[]">
                                                                                @foreach ($bases as $base)
                                                                                    <option value="{{ $base->id }}">
                                                                                        {{ $base->name }} -
                                                                                        {{ number_format($base->price, 0, ',', '.') }}
                                                                                        VND
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    {{-- <div class="col-12">
                                                                        <div class="form-group mt-3">
                                                                            <div class="form-check form-switch form-switch-lg"
                                                                                dir="ltr">
                                                                                <input type="checkbox"
                                                                                    class="form-check-input toggle-input"
                                                                                    id="toggleEdge">
                                                                                <label class="form-check-label"
                                                                                    for="toggleEdge">Viền Bánh</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group toggle-target"
                                                                            id="inputEdgeFields" style="display: none;">
                                                                            <div class="row mt-3">
                                                                                <div class="col-4">
                                                                                    <label>Tên Viền Bánh</label>
                                                                                    <input type="text" name="edge_name"
                                                                                        class="form-control"
                                                                                        value="{{ old('edge_name') }}">
                                                                                    @error('edge_name')
                                                                                        <span
                                                                                            class="text-danger">{{ $message }}</span>
                                                                                    @enderror

                                                                                    <label class="mt-3">Tên Viền Bánh</label>
                                                                                    <input type="text" name="edge_name"
                                                                                        class="form-control"
                                                                                        value="{{ old('edge_name') }}">
                                                                                    @error('edge_name')
                                                                                        <span
                                                                                            class="text-danger">{{ $message }}</span>
                                                                                    @enderror

                                                                                    <label class="mt-3">Tên Viền Bánh</label>
                                                                                    <input type="text" name="edge_name"
                                                                                        class="form-control"
                                                                                        value="{{ old('edge_name') }}">
                                                                                    @error('edge_name')
                                                                                        <span
                                                                                            class="text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="col-4">
                                                                                    <label>Giá Tiền</label>
                                                                                    <div class="input-group">
                                                                                        <span
                                                                                            class="input-group-text">VNĐ</span>
                                                                                        <input type="text"
                                                                                            name="edge_price"
                                                                                            class="form-control"
                                                                                            value="{{ old('edge_price') }}">
                                                                                        <span
                                                                                            class="input-group-text">.000</span>
                                                                                    </div>
                                                                                    @error('edge_price')
                                                                                        <span
                                                                                            class="text-danger">{{ $message }}</span>
                                                                                    @enderror

                                                                                    <label class="mt-3">Giá Tiền</label>
                                                                                    <div class="input-group">
                                                                                        <span
                                                                                            class="input-group-text">VNĐ</span>
                                                                                        <input type="text"
                                                                                            name="edge_price"
                                                                                            class="form-control"
                                                                                            value="{{ old('edge_price') }}">
                                                                                        <span
                                                                                            class="input-group-text">.000</span>
                                                                                    </div>
                                                                                    @error('edge_price')
                                                                                        <span
                                                                                            class="text-danger">{{ $message }}</span>
                                                                                    @enderror

                                                                                    <label class="mt-3">Giá Tiền</label>
                                                                                    <div class="input-group">
                                                                                        <span
                                                                                            class="input-group-text">VNĐ</span>
                                                                                        <input type="text"
                                                                                            name="edge_price"
                                                                                            class="form-control"
                                                                                            value="{{ old('edge_price') }}">
                                                                                        <span
                                                                                            class="input-group-text">.000</span>
                                                                                    </div>
                                                                                    @error('edge_price')
                                                                                        <span
                                                                                            class="text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div> --}}

                                                                    {{-- <div class="col-12">
                                                                        <div class="form-group mt-3">
                                                                            <div class="form-check form-switch form-switch-lg"
                                                                                dir="ltr">
                                                                                <input type="checkbox"
                                                                                    class="form-check-input toggle-input"
                                                                                    id="toggleBase">
                                                                                <label class="form-check-label"
                                                                                    for="toggleBase">Đế Bánh</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group mt-3 toggle-target"
                                                                            id="inputBaseFields" style="display: none;">
                                                                            <div class="row mt-3">
                                                                                <div class="col-6">
                                                                                    <label>Tên Đế Bánh</label>
                                                                                    <input type="text" name="base_name"
                                                                                        class="form-control"
                                                                                        value="{{ old('base_name') }}">
                                                                                    @error('base_name')
                                                                                        <span
                                                                                            class="text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <label>Giá Tiền</label>
                                                                                    <div class="input-group">
                                                                                        <span
                                                                                            class="input-group-text">VNĐ</span>
                                                                                        <input type="text"
                                                                                            name="base_price"
                                                                                            class="form-control"
                                                                                            value="{{ old('base_price') }}">
                                                                                        <span
                                                                                            class="input-group-text">.000</span>
                                                                                    </div>
                                                                                    @error('base_price')
                                                                                        <span
                                                                                            class="text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div> --}}
                                                                </div>

                                                                <div class="mt-3">
                                                                    <a href="{{ route('admin.products.index') }}"
                                                                        class="btn btn-secondary">
                                                                        Quay Lại</a>
                                                                    <button type="submit" class="btn btn-success">Thêm
                                                                        Mới</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                </form>

                {{-- <div class="card-body">
                    <div class="live-preview">
                        <div class="accordion custom-accordionwithicon-plus" id="accordionWithplusicon">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="accordionwithplusExample2">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#accor_plusExamplecollapse2" aria-expanded="true"
                                        aria-controls="accor_plusExamplecollapse2">
                                        Bản Xem Trước
                                    </button>
                                </h2>

                                <div id="accor_plusExamplecollapse2" class="accordion-collapse collapse show"
                                    aria-labelledby="accordionwithplusExample2" data-bs-parent="#accordionWithplusicon">
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
                                                                <input class="form-check-input fs-15" type="checkbox"
                                                                    id="checkAll">
                                                            </div>
                                                        </th>
                                                        <th>ID</th>
                                                        <th>Image</th>
                                                        <th>Name</th>
                                                        <th>Slug</th>
                                                        <th>Category</th>
                                                        <th>Price</th>
                                                        <th>Offer Price</th>
                                                        <th>Quantity in Stock</th>
                                                        <th>Show At Home</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input fs-15 product-checkbox"
                                                                    type="checkbox" name="products[]" value="test">
                                                            </div>
                                                        </th>
                                                        <td id="preview-id"></td>
                                                        <td>

                                                            <img src="test" alt="" width="100px">
                                                        </td>
                                                        <td id="preview-name"></td>
                                                        <td id="preview-slug"></td>
                                                        <td id="preview-category"></td>
                                                        <td id="preview-price"></td>
                                                        <td id="preview-offer-price"></td>
                                                        <td id="preview-qty"></td>
                                                        {{-- <td>
                                                                            <input type="number"
                                                                                class="form-control product-quantity"
                                                                                name="quantities[test]" min="1"
                                                                                max=test" value="1" data-stock="test"
                                                                                disabled>
                                                                        </td> --}}
                {{-- <td id="preview-show-at-home"></td>
                                                        <td id="preview-status"></td> --}}
                {{-- </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>

    {{-- <script>
        // Lắng nghe sự kiện thay đổi trên các input
        document.addEventListener('DOMContentLoaded', function() {
            const fields = {
                name: 'preview-name',
                slug: 'preview-slug',
                price: 'preview-price',
                offer_price: 'preview-offer-price',
                qty: 'preview-qty',
                category_id: 'preview-category',
                status: 'preview-status',
                show_at_home: 'preview-show-at-home'
            };

            // Lắng nghe các trường input
            for (let key in fields) {
                const input = document.querySelector(`[name="${key}"]`);
                if (input) {
                    input.addEventListener('input', function() {
                        document.getElementById(fields[key]).textContent = input.value;
                    });
                }
            }

            // Xử lý đặc biệt với các select box
            document.querySelector(`[name="category_id"]`).addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex].text;
                document.getElementById('preview-category').textContent = selectedOption;
            });

            document.querySelector(`[name="status"]`).addEventListener('change', function() {
                const selectedOption = this.value == 1 ? 'Active' : 'Inactive';
                document.getElementById('preview-status').textContent = selectedOption;
            });

            document.querySelector(`[name="show_at_home"]`).addEventListener('change', function() {
                const selectedOption = this.value == 1 ? 'Yes' : 'No';
                document.getElementById('preview-show-at-home').textContent = selectedOption;
            });
        });
    </script> --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Lấy các phần tử cần thiết
            const categorySelect = document.getElementById("category_id");
            const variantFields = document.getElementById("variantFields");
            const selects = document.querySelectorAll(".toggle-target select");

            // Hàm kiểm tra và cập nhật hiển thị của variantFields
            function toggleVariantFields() {
                const selectedCategory = categorySelect.options[categorySelect.selectedIndex].text.trim();

                if (selectedCategory === "Pizza") {
                    variantFields.style.display = "flex"; // Giữ bố cục ngang
                } else {
                    variantFields.style.display = "none"; // Ẩn

                    // Hủy chọn tất cả các lựa chọn trong các select
                    selects.forEach(select => {
                        Array.from(select.options).forEach(option => {
                            option.selected = false;
                        });
                    });
                }
            }

            // Gọi hàm khi thay đổi danh mục
            categorySelect.addEventListener("change", toggleVariantFields);

            // Gọi hàm khi tải trang lần đầu
            toggleVariantFields();

            // Luôn chọn Size có id là 1 - Size nhỏ khi mà chọn các size khác
            document.getElementById('sizeSelect').addEventListener('click', function() {
                const sizeSelect = document.getElementById('sizeSelect');
                const optionToSelect = Array.from(sizeSelect.options).find(option => option.value == 1);

                if (optionToSelect && !optionToSelect.selected) {
                    optionToSelect.selected = true;
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            // Lấy tất cả các toggle inputs và liên kết với select
            const toggles = document.querySelectorAll(".toggle-input");

            toggles.forEach(toggle => {
                toggle.addEventListener("change", function() {
                    // Tìm các phần tử liên quan
                    const toggleTarget = this.closest(".col-4").querySelector(".toggle-target");
                    const multiSelect = toggleTarget.querySelector("select");

                    if (this.checked) {
                        toggleTarget.style.display = "block";
                    } else {
                        toggleTarget.style.display = "none";

                        // Hủy chọn tất cả các lựa chọn
                        if (multiSelect) {
                            Array.from(multiSelect.options).forEach(option => {
                                option.selected = false;
                            });
                        }
                    }
                });
            });
        });
    </script>

    <script>
        // Biến thể
        document.addEventListener('DOMContentLoaded', function() {
            // Lấy danh sách tất cả các nút switch
            const toggleInputs = document.querySelectorAll('.toggle-input');

            toggleInputs.forEach(toggleInput => {
                toggleInput.addEventListener('change', function() {
                    // Tìm div target tương ứng với id
                    const targetId = this.id.replace('toggle', 'input') + 'Fields';
                    const targetElement = document.getElementById(targetId);

                    if (targetElement) {
                        // Hiển thị hoặc ẩn div
                        targetElement.style.display = this.checked ? 'block' : 'none';
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const toggles = document.querySelectorAll('.toggle-input');
            const addSizeFieldsButton = document.getElementById('addSizeFields');
            const sizeFieldsContainer = document.getElementById('sizeFieldsContainer');

            toggles.forEach(function(toggle) {
                toggle.addEventListener('change', function() {
                    const targetFieldsId = this.id.replace('toggle', 'input') + 'Fields';
                    const targetFields = document.getElementById(targetFieldsId);
                    const priceFieldId = targetFieldsId.replace('Fields', 'Price');
                    const priceField = document.getElementById(priceFieldId);

                    // Khi kích hoạt checkbox
                    if (this.checked) {
                        sizeFieldsContainer.style.display = 'block';
                        addSizeFieldsButton.style.display = 'inline-block'; // Hiển thị nút thêm
                    } else {
                        sizeFieldsContainer.style.display = 'none';
                        addSizeFieldsButton.style.display = 'none'; // Ẩn nút thêm
                    }
                });
            });

            // Thêm cột input mới khi nhấn vào nút Thêm Giá Trị
            addSizeFieldsButton.addEventListener('click', function() {
                const newSizeFieldHTML = `
                    <div class="col-6">
                        <div class="form-group toggle-target">
                            <label class="mt-3">Tên Size Bánh</label>
                            <input type="text" name="size_name[]" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group toggle-target">
                            <label class="mt-3">Giá Tiền</label>
                            <div class="input-group">
                                <span class="input-group-text">VNĐ</span>
                                <input type="text" name="size_price[]" class="form-control" value="">
                                <span class="input-group-text">.000</span>
                            </div>
                        </div>
                    </div>
                `;
                const newRow = document.createElement('div');
                newRow.classList.add('row');
                newRow.innerHTML = newSizeFieldHTML;
                sizeFieldsContainer.appendChild(newRow);
            });
        });

        // Slug theo name
        // document.addEventListener('DOMContentLoaded', function() {
        //     const nameInput = document.querySelector('input[name="name"]');
        //     const slugInput = document.querySelector('input[name="slug"]');

        //     nameInput.addEventListener('input', function() {
        //         slugInput.value = nameInput.value
        //             .toLowerCase()
        //             .trim()
        //             .replace(/[\s]+/g, '-') // Thay thế khoảng trắng bằng dấu -
        //             .replace(/[^\w\-]+/g, '') // Xóa ký tự không phải chữ, số hoặc dấu -
        //             .replace(/\-\-+/g, '-') // Xóa dấu gạch nối kép
        //             .replace(/^-+/, '') // Xóa dấu gạch nối đầu
        //             .replace(/-+$/, ''); // Xóa dấu gạch nối
        //     });
        // });


        // Slug theo name
        document.addEventListener('DOMContentLoaded', function() {
            const nameInput = document.querySelector('input[name="name"]');
            const slugInput = document.querySelector('input[name="slug"]');
            const generateSlugButton = document.getElementById('generate-slug');

            //  chuyển đổi sang tieng viet khong dau
            function removeVietnameseTones(str) {
                return str
                    .normalize('NFD') // Chuẩn hóa chuỗi thành dạng ký tự tổ hợp
                    .replace(/[\u0300-\u036f]/g, '') // Xóa các dấu tổ hợp
                    .replace(/đ/g, 'd')
                    .replace(/Đ/g, 'D');
            }

            // chuyen doi slug->name
            function convertToSlug(text) {
                return removeVietnameseTones(text)
                    .toLowerCase()
                    .trim()
                    .replace(/[\s]+/g, '-') // Thay thế khoảng trắng bằng dấu -
                    .replace(/[^\w\-]+/g, '') // Xóa ký tự không phải chữ, số hoặc dấu -
                    .replace(/\-\-+/g, '-') // Xóa dấu gạch nối kép
                    .replace(/^-+/, '') // Xóa dấu gạch nối đầu
                    .replace(/-+$/, ''); // Xóa dấu gạch nối cuối
            }

            //  sự kiện thay đổi trên ô nhập "name"
            nameInput.addEventListener('input', function() {
                if (!slugInput.dataset.manual) {
                    slugInput.value = convertToSlug(nameInput.value);
                }
            });
            // event click button
            generateSlugButton.addEventListener('click', function() {
                // Generate slug từ trường "name"
                slugInput.value = convertToSlug(nameInput.value);
                slugInput.dataset.manual = false; // Đặt lại trạng thái tự động
            });

            // event nhap tren o input
            slugInput.addEventListener('input', function() {
                slugInput.dataset.manual = true; // Đánh dấu rằng người dùng đang tự nhập slug
            });
        });



        // Generate mã sản phẩm
        document.addEventListener('DOMContentLoaded', function() {
            const generateSkuButton = document.getElementById('generate-sku');
            const ProductSkuInput = document.getElementById('sku');

            generateSkuButton.addEventListener('click', function() {
                // Random mã sản phẩm (10 ký tự, chữ và số)
                const randomSku = Array.from({
                    length: 15
                }, () => {
                    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                    return chars[Math.floor(Math.random() * chars.length)];
                }).join('');

                // Gán mã vào ô input
                ProductSkuInput.value = randomSku;
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
