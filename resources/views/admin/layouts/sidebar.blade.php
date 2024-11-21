<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="/velzon/assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="/velzon/assets/images/logo-dark.png" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="/velzon/assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="/velzon/assets/images/logo-light.png" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Trang Admin</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.dashboard') }}" role="button"
                        aria-expanded="false" aria-controls="sidebarHome">
                        <i class="fa-solid fa-cube"></i> <span data-key="t-dashboards">Bảng Điều Khiển</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.chart') }}" role="button" aria-expanded="false"
                        aria-controls="sidebarHome">
                        <i class="fa-solid fa-chart-line"></i> <span data-key="t-dashboards">Doanh Thu Theo Tháng</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.source') }}" role="button" aria-expanded="false"
                        aria-controls="sidebarHome">
                        <i class="fa-solid fa-chart-pie"></i> <span data-key="t-dashboards">Doanh Thu Theo Nguồn</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Quản Lý Website</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCategories" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarCategories">
                        <i class="fa-solid fa-folder-open"></i> <span data-key="t-landing">Danh Mục</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCategories">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.categories.index') }}" class="nav-link"
                                    data-key="t-one-page">Danh Mục Sản Phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.categories.create') }}" class="nav-link"
                                    data-key="t-nft-landing">Thêm Danh Mục Sản Phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.blog-categories.index') }}" class="nav-link"
                                    data-key="t-nft-landing">Danh Mục Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.blog-categories.create') }}" class="nav-link"
                                    data-key="t-nft-landing">Thêm Danh Mục Blog</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarProducts" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarProducts">
                        <i class="fa-solid fa-pizza-slice"></i> <span data-key="t-landing">Sản Phẩm</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarProducts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.products.index') }}" class="nav-link"
                                    data-key="t-one-page">Danh Sách Sản Phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.products.create') }}" class="nav-link"
                                    data-key="t-nft-landing">Thêm Sản Phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.products.index') }}" class="nav-link"
                                    data-key="t-nft-landing">Danh Sách Size</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.products.create') }}" class="nav-link"
                                    data-key="t-nft-landing">Thêm Size</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="{{ route('admin.product-reviews.index') }}" class="nav-link"
                                    data-key="t-nft-landing">Đánh giá sản phẩm</a>
                            </li> --}}
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCoupons" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarCoupons">
                        <i class="fas fa-tags"></i><span data-key="t-landing">Phiếu Giảm Giá</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCoupons">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.coupons.index') }}" class="nav-link"
                                    data-key="t-one-page">Danh Sách Phiếu Giảm Giá</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.coupons.create') }}" class="nav-link"
                                    data-key="t-nft-landing">Thêm Phiếu Giảm Giá</a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarTags" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarTags">
                        <i class="fa-solid fa-tags"></i> <span data-key="t-landing">Thẻ</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarTags">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.tags.index') }}" class="nav-link" data-key="t-one-page">Danh
                                    Sách Thẻ</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.tags.create') }}" class="nav-link"
                                    data-key="t-nft-landing">Thêm Thẻ</a>
                            </li>
                        </ul>
                    </div>
                </li> --}}

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarOrders" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarOrders">
                        <i class="fa-solid fa-cart-shopping"></i> <span data-key="t-landing">Đơn Hàng</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarOrders">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.orders.index') }}" class="nav-link" data-key="t-one-page">Danh
                                    Sách Đơn Hàng</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.orders.create') }}" class="nav-link"
                                    data-key="t-nft-landing">Thêm Đơn Hàng</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.orders.deleted') }}" class="nav-link"
                                    data-key="t-nft-landing">Đơn Hàng Bị Hủy</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarBlogs" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarBlogs">
                        <i class="fa-solid fa-newspaper"></i> <span data-key="t-landing">Blogs</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarBlogs">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.blogs.index') }}" class="nav-link" data-key="t-one-page">Danh
                                    Sách Blogs</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.blogs.create') }}" class="nav-link"
                                    data-key="t-nft-landing">Thêm Blogs</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarUsers" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarUsers">
                        <i class="fa-solid fa-user-group"></i> <span data-key="t-landing">Người Dùng</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarUsers">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index') }}" class="nav-link" data-key="t-one-page">Danh
                                    Sách Người Dùng</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.users.create') }}" class="nav-link"
                                    data-key="t-nft-landing">Thêm Người Dùng</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarSliders" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarSliders">
                        <i class="fa-solid fa-images"></i> <span data-key="t-landing">Sliders</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarSliders">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.sliders.index') }}" class="nav-link" data-key="t-one-page">Danh
                                    Sách Sliders</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.sliders.create') }}" class="nav-link"
                                    data-key="t-nft-landing">Thêm Sliders</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('admin.chat.index')}}">
                        <i class="fas fa-comment-dots"></i> <span data-key="t-landing">Tin Nhắn</span>
                    </a>

                </li>


                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Quản Lý Phương
                        Thức</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDeliveryArea" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarDeliveryArea">
                        <i class="fa-solid fa-truck-fast"></i> <span data-key="t-landing">Vận Chuyển</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDeliveryArea">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.delivery_areas.index') }}" class="nav-link"
                                    data-key="t-one-page">Danh Sách Vận Chuyển</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.delivery_areas.create') }}" class="nav-link"
                                    data-key="t-nft-landing">Thêm Vận Chuyển</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebardelivery_areas" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebardelivery_areas">
                        <i class="fa-solid fa-map-location"></i> <span data-key="t-landing">Địa chỉ giao hàng</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebardelivery_areas">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.delivery_areas.index') }}" class="nav-link"
                                    data-key="t-one-page">Địa Chỉ Giao Hàng</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.delivery_areas.create') }}" class="nav-link"
                                    data-key="t-nft-landing">Thêm Địa chỉ giao hàng</a>
                            </li>
                    </div>


                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarPayment" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarPayment">
                        <i class="fa-regular fa-credit-card"></i> <span data-key="t-landing">Thanh Toán</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarPayment">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.payment.index') }}" class="nav-link" data-key="t-one-page">Danh
                                    Sách Thanh Toán</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.payment.create') }}" class="nav-link"
                                    data-key="t-nft-landing">Thêm Thanh Toán</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Điều Hướng</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="http://localhost:3000" role="button"
                        aria-expanded="false" aria-controls="sidebarHome">
                        <i class="fa-solid fa-door-open"></i> <span data-key="t-dashboards">Quay Về Trang Chủ</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
