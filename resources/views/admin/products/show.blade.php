@extends('admin.layouts.master')

@section('title')
    Chi Tiết Sản Phẩm - Pizzato
@endsection
@section('style')
    <style>
        .mr-5 {
            margin-right: 10px;
        }

        .btn-prev {
            color: black;
            background-color: black;
            border-radius: 50%;
        }

        .btn-next {
            color: black;
            background-color: black;
            border-radius: 50%;

        }

        .img-fixed-height {
            width: 100%;
            height: 500px;
            object-fit: contain;
            background-color: #f8f9fa;
            /* Tùy chọn để thêm màu nền */
        }
    </style>
@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center" style="justify-content: space-between">
                                <h5 class="card-title mb-0 mr-5">Chi Tiết Sản Phẩm: {{ $product->name }}</h5>

                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary me-1">Quay
                                        Lại</a>
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                        class="btn btn-warning me-1">Sửa</a>
                                    <a href="{{ route('admin.products.create') }}" class="btn btn-success">Thêm
                                        Mới</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <h4>Hình Ảnh Sản Phẩm</h4>
                                        @if ($product->thumb_image)
                                            @php
                                                $url = $product->thumb_image;
                                                if (!\Str::contains($url, 'http')) {
                                                    $url = \Storage::url($url);
                                                }
                                            @endphp

                                            <img id="mainImage" src="{{ $url }}"
                                                class="img-fluid rounded mb-3 img-fixed-height" alt="Image">
                                        @else
                                            <p class="text-muted">Không có hình ảnh</p>
                                        @endif

                                        <!-- Carousel -->
                                        <h4>Hình ảnh chi tiết</h4>
                                        <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                @php
                                                    $images = collect([$url])->merge(
                                                        $product->productGalleries
                                                            ->pluck('galleries')
                                                            ->map(function ($gallery) {
                                                                return \Str::contains($gallery, 'http')
                                                                    ? $gallery
                                                                    : \Storage::url($gallery);
                                                            }),
                                                    );
                                                    $chunks = $images->chunk(4); // Chia ảnh thành từng nhóm 4 cái
                                                @endphp

                                                @foreach ($chunks as $chunkIndex => $chunk)
                                                    <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                                                        <div class="d-flex justify-content-center">
                                                            @foreach ($chunk as $thumbUrl)
                                                                <img src="{{ $thumbUrl }}"
                                                                    class="img-thumbnail m-1 gallery-image"
                                                                    alt="Hình chi tiết"
                                                                    style="width: 80px; cursor: pointer;"
                                                                    onclick="changeMainImage(this)">
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <!-- Indicators -->
                                            {{-- <div class="carousel-indicators">
                                                @foreach ($chunks as $chunkIndex => $chunk)
                                                    <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="{{ $chunkIndex }}"
                                                        class="{{ $chunkIndex == 0 ? 'active' : '' }}"></button>
                                                @endforeach
                                            </div> --}}

                                            <!-- Controls -->
                                            <button class="carousel-control-prev " type="button"
                                                data-bs-target="#productCarousel" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon btn-prev"></span>
                                            </button>
                                            <button class="carousel-control-next " type="button"
                                                data-bs-target="#productCarousel" data-bs-slide="next">
                                                <span class="carousel-control-next-icon btn-next"></span>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <h4>Thông Tin Chi Tiết</h4>
                                        @php
                                            $fieldNames = [
                                                'id' => 'ID',
                                                'name' => 'Tên sản phẩm',
                                                'thumb_image' => 'Hình ảnh',
                                                'category' => 'Danh mục',
                                                'price' => 'Giá',
                                                'offer_price' => 'Giá khuyến mãi',
                                                'qty' => 'Số lượng',
                                                'show_at_home' => 'Hiển thị',
                                                'status' => 'Trạng thái',
                                                'created_at' => 'Ngày tạo',
                                                'updated_at' => 'Ngày cập nhật',
                                                'view' => 'Lượt xem',
                                                'short_description' => 'Mô tả ngắn',
                                                'long_description' => 'Mô tả chi tiết',
                                            ];

                                            // Danh sách các trường cần hiển thị
                                            $fieldsToDisplay = [
                                                'id',
                                                'name',
                                                'thumb_image',
                                                'category',
                                                'price',
                                                'offer_price',
                                                'qty',
                                                'status',
                                                'view',
                                                'short_description',
                                                'long_description',
                                                'created_at',
                                                'updated_at',
                                            ];
                                        @endphp

                                        <table class="table table-bordered table-striped table-hover">
                                            <tbody>
                                                <tr>
                                                    <th>Trường</th>
                                                    <th>Giá trị</th>
                                                </tr>
                                                @foreach ($fieldsToDisplay as $field)
                                                    <tr>
                                                        <th>{{ $fieldNames[$field] ?? Str::ucfirst(str_replace('_', ' ', $field)) }}
                                                        </th>
                                                        <td>
                                                            @if ($field == 'thumb_image')
                                                                @php
                                                                    // Hiển thị hình ảnh nếu trường là "thumb_image"
                                                                    $imageUrl = \Str::contains($product->$field, 'http')
                                                                        ? $product->$field
                                                                        : \Storage::url($product->$field);
                                                                @endphp
                                                                <img src="{{ $imageUrl }}" alt="{{ $product->name }}"
                                                                    width="50">
                                                            @elseif ($field == 'category' && $product->category)
                                                                {{ $product->category->name }}
                                                            @elseif (in_array($field, ['show_at_home', 'status']))
                                                                <span
                                                                    class="badge {{ $product->$field ? 'bg-primary' : 'bg-danger' }}">
                                                                    {{ $product->$field ? 'Có' : 'Không' }}
                                                                </span>
                                                            @else
                                                                {{ $product->$field }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        @php
                                            $pizzaCategory = $product->category->name === 'Pizza';
                                        @endphp

                                        <div class="row">

                                            {{-- Pizza Bases --}}
                                            @if ($pizzaCategory)
                                                <div class="col-md-6">
                                                    <h4>Đế bánh</h4>
                                                    @if ($product->pizzaBases->isNotEmpty())
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Tên đế</th>
                                                                    <th>Giá</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($product->pizzaBases as $base)
                                                                    <tr>
                                                                        <td>{{ $base->name }}</td>
                                                                        <td>{{ number_format($base->pivot->price, 0, ',', '.') }}
                                                                            VND
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    @else
                                                        <p class="text-muted">Không có đế bánh.</p>
                                                    @endif
                                                </div>
                                            @endif
                                            {{-- Pizza Edges --}}
                                            @if ($pizzaCategory)
                                                <div class="col-md-6">
                                                    <h4>Viền bánh</h4>
                                                    @if ($product->pizzaEdges->isNotEmpty())
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Tên viền</th>
                                                                    <th>Giá</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($product->pizzaEdges as $edge)
                                                                    <tr>
                                                                        <td>{{ $edge->name }}</td>
                                                                        <td>{{ number_format($edge->pivot->price, 0, ',', '.') }}
                                                                            VND
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    @else
                                                        <p class="text-muted">Không có viền bánh.</p>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>



                                        {{-- Product Sizes --}}
                                        @if ($pizzaCategory)
                                            <div class="div">
                                                <h4>Kích thước sản phẩm</h4>
                                                @if ($product->productSizes->isNotEmpty())
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Tên kích thước</th>
                                                                <th>Giá</th>
                                                                <th>Hình ảnh</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($product->productSizes as $size)
                                                                <tr>
                                                                    <td>{{ $size->name }}</td>
                                                                    <td>{{ number_format($size->price, 0, ',', '.') }} VND
                                                                    </td>
                                                                    <td>
                                                                        @if ($size->image)
                                                                            @php
                                                                                $imageUrl = \Str::contains(
                                                                                    $size->image,
                                                                                    'http',
                                                                                )
                                                                                    ? $size->image
                                                                                    : \Storage::url($size->image);
                                                                            @endphp
                                                                            <img src="{{ $imageUrl }}"
                                                                                alt="{{ $size->name }}" width="50">
                                                                        @else
                                                                            <p class="text-muted">Không có hình ảnh</p>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <p class="text-muted">Không có kích thước.</p>
                                                @endif
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function changeMainImage(element) {
            const mainImage = document.getElementById('mainImage');
            mainImage.src = element.src;
        }

        // Thay đổi slide khi click vào ảnh nhỏ
        function showSlide(index) {
            const carousel = new bootstrap.Carousel(document.getElementById('productCarousel'));
            carousel.to(index); // Chuyển đến slide có chỉ số index
        }
    </script>
@endsection
