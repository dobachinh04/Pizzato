<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Trang Admin</li>
            <li>
                <a class="" href="{{ route('admin.dashboard') }}" aria-expanded="false"><i
                        class="fa-solid fa-cube"></i><span class="nav-text">Bảng Điều Khiển</span></a>
            </li>

            <li class="nav-label">Biểu Đồ Quản Lý</li>
            <li>
                <a class="" href="{{ route('admin.chart') }}" aria-expanded="false"><i
                        class="fa-solid fa-chart-line"></i><span class="nav-text">Thống Kê Doanh Thu</span></a>
            </li>

            <li class="nav-label">Quản Lý Website</li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="fa-solid fa-folder-open"></i><span class="nav-text">Danh Mục Sản Phẩm</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.categories.index') }}">Danh Sách Danh Mục</a></li>
                    <li><a href="{{ route('admin.categories.create') }}">Thêm Danh Mục</a></li>
                </ul>
            </li>

            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="fa-solid fa-pizza-slice"></i><span class="nav-text">Sản Phẩm</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.products.index') }}">Danh Sách Sản Phẩm</a></li>
                    <li><a href="{{ route('admin.products.create') }}">Thêm Sản Phẩm</a></li>
                    <li><a href="{{ route('admin.products.index') }}">Danh Sách Size</a></li>
                    <li><a href="{{ route('admin.products.create') }}">Thêm Size</a></li>
                </ul>
            </li>

            {{-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="fa-solid fa-tags"></i><span class="nav-text">Thẻ</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.tags.index') }}">Danh Sách Thẻ</a></li>
                    <li><a href="{{ route('admin.tags.create') }}">Thêm Thẻ</a></li>
                </ul>
            </li> --}}

            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="fa-solid fa-cart-shopping"></i><span class="nav-text">Đơn Hàng</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.orders.index') }}">Danh Sách Đơn Hàng</a></li>
                    <li><a href="{{ route('admin.orders.create') }}">Thêm Đơn Hàng</a></li>
                </ul>
            </li>

            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="fa-solid fa-user-group"></i><span class="nav-text">Người Dùng</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.users.index') }}">Danh Sách Người Dùng</a></li>
                    <li><a href="{{ route('admin.users.create') }}">Thêm Người Dùng</a></li>
                </ul>
            </li>

            <li class="nav-label">Quản Lý Phương Thức</li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="fa-solid fa-truck-fast"></i><span class="nav-text">Vận Chuyển</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.shipping.index') }}">Danh Sách Vận Chuyển</a></li>
                    <li><a href="{{ route('admin.shipping.create') }}">Thêm Vận Chuyển</a></li>
                </ul>
            </li>

            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="fa-regular fa-credit-card"></i><span class="nav-text">Thanh Toán</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.payment.index') }}">Danh Sách Thanh Toán</a></li>
                    <li><a href="{{ route('admin.payment.create') }}">Thêm Thanh Toán</a></li>
                </ul>
            </li>

            <li class="nav-label">Điều Hướng</li>
            <li>
                <a class="" href="{{ route('client.home') }}" aria-expanded="false"><i
                        class="fa-solid fa-door-open"></i><span class="nav-text">Quay Về Trang Chủ</span></a>
            </li>
        </ul>
    </div>
</div>
