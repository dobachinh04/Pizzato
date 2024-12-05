@extends('admin.layouts.master')

@section('title')
    Chi Tiết Sản Phẩm - Pizzato
@endsection
@section('style')
    <style>
        .mr-5 {
            margin-right: 10px;
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
                            <div class="card-header d-flex align-items-center">
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
                                                // Kiểm tra nếu URL không chứa 'http' thì sử dụng Storage::url
                                                if (!\Str::contains($url, 'http')) {
                                                    $url = \Storage::url($url);
                                                }
                                            @endphp
                                            <img src="{{ $url }}" class="img-fluid rounded"
                                                style="width: 100%; max-width: 250px;" alt="Image">
                                        @else
                                            <p class="text-muted">Không có hình ảnh</p>
                                        @endif
                                    </div>

                                    <!-- <div class="col-md-8">
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
                                        @endphp
                                        <table class="table table-bordered table-striped table-hover">
                                            <tbody>

                                                <tr>
                                                    <th>Trường</th>
                                                    <th>Giá trị</th>
                                                </tr>
                                                @foreach ($product->toArray() as $field => $value)
                                                    <tr>
                                                        <th>{{ $fieldNames[$field] ?? Str::ucfirst(str_replace('_', ' ', $field)) }}
                                                        </th>
                                                        <td>
                                                            @if (is_array($value))
                                                                {{ json_encode($value, JSON_UNESCAPED_UNICODE) }}
                                                            @elseif ($value instanceof Illuminate\Support\Collection)
                                                                {{ $value->implode(', ') }}
                                                            @elseif (is_object($value))
                                                                {{ method_exists($value, '__toString') ? $value->__toString() : json_encode($value, JSON_UNESCAPED_UNICODE) }}
                                                            @elseif ($field == 'thumb_image')
                                                                @php
                                                                    if (!\Str::contains($value, 'http')) {
                                                                        $value = \Storage::url($value);
                                                                    }
                                                                @endphp
                                                                <img src="{{ $value }}" alt="Hình ảnh sản phẩm"
                                                                    width="50px">
                                                            @elseif (Str::contains($field, 'show_at_home') || Str::contains($field, 'status'))
                                                                <span
                                                                    class="badge {{ $value ? 'bg-primary' : 'bg-danger' }}">
                                                                    {{ $value ? 'Có' : 'Không' }}
                                                                </span>
                                                            @else
                                                                {{ $value }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                {{-- Product Galleries --}}
                                                <h4>Hình ảnh chi tiết</h4>
                                                @if ($product->productGalleries->isNotEmpty())
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>STT</th>
                                                                <th>Hình ảnh</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($product->productGalleries as $index => $gallery)
                                                                <tr>
                                                                    <td>{{ $index + 1 }}</td>
                                                                    <td>
                                                                        @php
                                                                            $imageUrl = \Str::contains(
                                                                                $gallery->image,
                                                                                'http',
                                                                            )
                                                                                ? $gallery->image
                                                                                : \Storage::url($gallery->image);
                                                                        @endphp
                                                                        <img src="{{ $imageUrl }}" alt="Gallery Image"
                                                                            width="50">
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <p class="text-muted">Không có hình ảnh chi tiết.</p>
                                                @endif

                                                {{-- Pizza Edges --}}
                                                <h4>Viền bánh</h4>
                                                @if ( $product->pizzaEdges->isNotEmpty())
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Tên viền</th>
                                                                <th>Giá</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ( $product->pizzaEdges as $edge)
                                                                <tr>
                                                                    <td>{{ $edge->name }}</td>
                                                                    <td>{{ number_format($edge->pivot->price, 0, ',', '.') }}
                                                                        VND</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <p class="text-muted">Không có viền bánh.</p>
                                                @endif

                                                {{-- Pizza Bases --}}
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
                                                                        VND</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <p class="text-muted">Không có đế bánh.</p>
                                                @endif

                                                <h4>Kích thước sản phẩm</h4>
                                                @if ($product->productSizes->isNotEmpty())
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Tên kích thước</th>
                                                                <th>Giá</th>
                                                                <th>Hình ảnh</th>
                                                                <th>Giá riêng (pivot)</th>
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
                                                                    <td>{{ number_format($size->pivot->price, 0, ',', '.') }}
                                                                        VND</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <p class="text-muted">Không có kích thước.</p>
                                                @endif
                                            </tbody>
                                        </table>

                                    </div> -->
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
                                            $fieldsToDisplay = ['id', 'name', 'thumb_image','category', 'price', 'offer_price', 'qty', 'status', 'view', 'created_at', 'updated_at'];
                                        @endphp

                                        <table class="table table-bordered table-striped table-hover">
                                            <tbody>
                                                <tr>
                                                    <th>Trường</th>
                                                    <th>Giá trị</th>
                                                </tr>
                                                @foreach ($fieldsToDisplay as $field)
                                                    <tr>
                                                        <th>{{ $fieldNames[$field] ?? Str::ucfirst(str_replace('_', ' ', $field)) }}</th>
                                                        <td>
                                                            @if ($field == 'thumb_image')
                                                                @php
                                                                    // Hiển thị hình ảnh nếu trường là "thumb_image"
                                                                    $imageUrl = \Str::contains($product->$field, 'http') ? $product->$field : \Storage::url($product->$field);
                                                                @endphp
                                                                <img src="{{ $imageUrl }}" alt="{{ $product->name }}" width="50">
                                                                @elseif ($field == 'category' && $product->category)
                                                                {{ $product->category->name }}
                                                            @elseif (in_array($field, ['show_at_home', 'status']))
                                                                <span class="badge {{ $product->$field ? 'bg-primary' : 'bg-danger' }}">
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

                                        {{-- Product Galleries --}}
                                        <h4>Hình ảnh chi tiết</h4>
                                        @if ($product->productGalleries->isNotEmpty())
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>STT</th>
                                                        <th>Hình ảnh</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($product->productGalleries as $index => $gallery)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>
                                                                @php
                                                                    $imageUrl = \Str::contains($gallery->image, 'http') ? $gallery->image : \Storage::url($gallery->image);
                                                                @endphp
                                                                <img src="{{ $imageUrl }}" alt="Gallery Image" width="50">
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <p class="text-muted">Không có hình ảnh chi tiết.</p>
                                        @endif

                                        {{-- Pizza Edges --}}
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
                                                            <td>{{ number_format($edge->pivot->price, 0, ',', '.') }} VND</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <p class="text-muted">Không có viền bánh.</p>
                                        @endif

                                        {{-- Pizza Bases --}}
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
                                                            <td>{{ number_format($base->pivot->price, 0, ',', '.') }} VND</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <p class="text-muted">Không có đế bánh.</p>
                                        @endif

                                        {{-- Product Sizes --}}
                                        <h4>Kích thước sản phẩm</h4>
                                        @if ($product->productSizes->isNotEmpty())
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Tên kích thước</th>
                                                        <th>Giá</th>
                                                        <th>Hình ảnh</th>
                                                        <th>Giá riêng (pivot)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($product->productSizes as $size)
                                                        <tr>
                                                            <td>{{ $size->name }}</td>
                                                            <td>{{ number_format($size->price, 0, ',', '.') }} VND</td>
                                                            <td>
                                                                @if ($size->image)
                                                                    @php
                                                                        $imageUrl = \Str::contains($size->image, 'http') ? $size->image : \Storage::url($size->image);
                                                                    @endphp
                                                                    <img src="{{ $imageUrl }}" alt="{{ $size->name }}" width="50">
                                                                @else
                                                                    <p class="text-muted">Không có hình ảnh</p>
                                                                @endif
                                                            </td>
                                                            <td>{{ number_format($size->pivot->price, 0, ',', '.') }} VND</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <p class="text-muted">Không có kích thước.</p>
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
