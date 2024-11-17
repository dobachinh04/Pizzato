<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>404 Error Cover | Velzon - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

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

</head>

<body>

    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100">

        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden p-0">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="text-center">
                            <img src="/velzon/assets/images/error403-circle.png" alt="error img" class="img-fluid ">
                            <div class="mt-3">
                                <h3 class="text-uppercase"> Bạn không có quyền truy cập vào trang này 😭</h3>
                                {{-- <p class="text-muted mb-4">The page you are looking for not available!</p> --}}
                                <p class="text-muted mb-4">Lêu lêu cái đồ không có quyền 😛😛</p>
                                <p class="text-muted mb-4">Bạn tức không? chuyển khoản 100k cho admin để được cấp tài khoản vipro max vv nhé <a class="fw-semibold text-primary text-decoration-underline" href="https://www.facebook.com/profile.php?id=100040455924045">Liên hệ</a></p>
                                <a href="{{route('admin.login')}}" class="btn btn-success"><i class="mdi mdi-home me-1"></i>Quay trở lại</a>
                            </div>
                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth-page content -->
    </div>
    <!-- end auth-page-wrapper -->

</body>

</html>
