@extends('admin.layouts.master')

@section('title')
    Chi Tiết Đánh Giá Sản Phẩm - Pizzato
@endsection

@section('style')
<style>
    .mr-5 {
        margin-right: 10px;
    }

    /* .star-rating .fa {
        font-size: 18px;
    } */
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
                            <h5 class="card-title mb-0 mr-5">Chi Tiết Đánh Giá Sản Phẩm: {{ $productReview->product->name  }}</h5>

                            <div class="d-flex justify-content-center">
                                <a href="{{ route('admin.product-reviews.index') }}" class="btn btn-secondary me-1">Quay Lại</a>
                                <form action="{{ route('admin.product-reviews.destroy', $productReview->id) }}"
                                    method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick='return confirm("Bạn có chắc là muốn xóa không?")' type="submit"
                                        class="btn btn-danger">Xoá đánh giá này</button>
                                </form>
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
                                        <img src="{{ $url }}" class="img-fluid rounded" style="width: 100%; max-width: 250px;" alt="Image">
                                    @else
                                        <p class="text-muted">Không có hình ảnh</p>
                                    @endif
                                </div>

                                <div class="col-md-8">
                                    <h4>Thông Tin Đánh Giá Sản Phẩm</h4>
                                    <table class="table table-bordered table-striped table-hover">
                                        <tbody>
                                            <tr>
                                                <th>Sản phẩm đánh giá</th>
                                                <td>{{ $productReview->product->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Người Đánh Giá</th>
                                                <td>{{ $productReview->user->name ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Đánh Giá</th>
                                                <td>
                                                    <div class="star-rating">
                                                        @php
                                                            $fullStars = floor($productReview->rating); // Số sao đầy đủ
                                                            $halfStar = ($productReview->rating - $fullStars) >= 0.5 ? true : false; // Kiểm tra có nửa sao không
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
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Nội Dung Đánh Giá</th>
                                                <td>{{ $productReview->review }}</td>
                                            </tr>
                                            <tr>
                                                <th>Ngày Tạo</th>
                                                <td>{{ $productReview->created_at }}</td>
                                            </tr>
                                            <tr>
                                                <th>Ngày Cập Nhật</th>
                                                <td>{{ $productReview->updated_at }}</td>
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
@endsection
