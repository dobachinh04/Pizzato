<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Sign In | Velzon - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/velzon/assets/images/favicon.ico">

    <!-- Layout config Js -->
    <script src="/velzon/assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="/velzon/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="/velzon/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="/velzon/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="/velzon/assets/css/custom.min.css" rel="stylesheet" type="text/css" />

    <style>
        .ml-10 {
            margin-right: 15px;
        }
    </style>
</head>

<body>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="{{ route('admin.login') }}" class="d-inline-block auth-logo">
                                    {{-- <img src="/velzon/assets/images/logo-light.png" alt="" height="20"> --}}
                                    <img src="/velzon/images/logo-pizzato-3.png" alt="" height="300"
                                        width="300">

                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium"></p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Chào mừng trở lại</h5>
                                    <p class="text-muted">Đăng nhập để tiếp tục đến trang quản trị.</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <form action="{{ route('admin.login') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                id="email" placeholder="Nhập email" value="{{ old('email') }}">

                                            @error('email')
                                                <span class="text-danger error-message"> * {{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="mb-3">
                                            {{-- <div class="float-end">
                                                <a href="auth-pass-reset-basic.html" class="text-muted">Forgot password?</a>
                                            </div> --}}
                                            <label class="form-label" for="password-input">Mật khẩu</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password"
                                                    class="form-control pe-5 password-input @error('password') is-invalid @enderror"
                                                    placeholder="Nhập mật khẩu" id="password-input" name="password">
                                                <button
                                                    class="ml-10 btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                    type="button" id="password-addon"><i
                                                        class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                            @error('password')
                                                <span class="text-danger error-message"> * {{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Ghi nhớ</label>
                                        </div> --}}

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">Đăng nhập</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        {{-- <div class="mt-4 text-center">
                            <p class="mb-0">Không có tài khoản? chuyển khoản 100k admin để được cấp tài khoản<a
                                    href="https://www.facebook.com/profile.php?id=100040455924045"
                                    class="fw-semibold text-primary text-decoration-underline"> Liên hệ </a> </p>
                        </div> --}}

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> Pizzato. Design by <i class="mdi mdi-heart text-danger"></i>
                                by Linh Chu
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->
    <script>
        < script >
            if (window.history && window.history.pushState) {
                window.history.pushState(null, null, window.location.href);
                window.onpopstate = function() {
                    window.history.pushState(null, null, window.location.href);
                };
            }
    </script>
    </script>
    <!-- JAVASCRIPT -->
    <script src="/velzon/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/velzon/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="/velzon/assets/libs/node-waves/waves.min.js"></script>
    <script src="/velzon/assets/libs/feather-icons/feather.min.js"></script>
    <script src="/velzon/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="/velzon/assets/js/plugins.js"></script>

    <!-- particles js -->
    <script src="/velzon/assets/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="/velzon/assets/js/pages/particles.app.js"></script>
    <!-- password-addon init -->
    <script src="/velzon/assets/js/pages/password-addon.init.js"></script>
</body>

</html>
